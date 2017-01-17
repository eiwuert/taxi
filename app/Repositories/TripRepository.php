<?php

namespace App\Repositories;

use DB;
use Auth;
use App\User;
use App\Trip;
use App\Driver;
use App\Status;
use App\Location;
use Carbon\Carbon;
use App\Events\RideAccepted;
use App\Http\Requests\TripRequest;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;

class TripRepository
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public function requestTaxi($tripRequest, $exclude = 0, $userId = null)
    {
        if (!isset($tripRequest['currency'])) {
            $tripRequest['currency'] = 'USD';
        }

        if (!isset($tripRequest['type'])) {
            $tripRequest['type'] = 'any';
        }

        if (! is_null($userId)) {
            $client = User::wherePhone(User::find($userId)->phone)
                        ->orderBy('id', 'desc')
                        ->first()->client()->first();
        } else {
            $client = User::wherePhone(Auth::user()->phone)
                        ->orderBy('id', 'desc')
                        ->first()->client()->first();
        }

        $clientDeviceToken = $client->device_token;
        if ($pending = $this->pendingRequestTaxi($userId)) {
            return $pending;
        }

        $matrix = getDistanceMatrix($tripRequest);
        $source = setLocation($tripRequest['s_lat'], $tripRequest['s_long'], $userId);
        $destination = setLocation($tripRequest['d_lat'], $tripRequest['d_long'], $userId);

        if (! @isset($matrix['duration']['text'])) {
            return ok([
                    'title'  => 'Not valid trip',
                    'detail' => 'You cannot trip there!'
                ]);
        }

        // 
        // REQUEST_TAXI
        // 
        $trip_id = DB::table('trips')->insertGetId([
                        'client_id'       => $client->id,
                        'status_id'       => Status::where('name', 'request_taxi')->firstOrFail()->value,
                        'source'          => $source->id,
                        'destination'     => $destination->id,
                        'eta_text'        => $matrix['duration']['text'],
                        'eta_value'       => $matrix['duration']['value'],
                        'distance_text'   => $matrix['distance']['text'],
                        'distance_value'  => $matrix['distance']['value'],
                        'created_at'      => Carbon::now(),
                        'updated_at'      => Carbon::now(),
                    ]);

        $trip = DB::table('trips')->where('id', $trip_id);

        /**
         * If there is one available driver within 1KM.
         * No driver found state happens here.
         * When there is a driver we send the requset to driver and wait for his/her response.
         */
        $foundDriver = nearby($tripRequest['s_lat'], $tripRequest['s_long'], $tripRequest['type'], 10, 1, $exclude)['result'];
        if (!empty($foundDriver)) {
            $foundDriver = $foundDriver[0];
            $driverToClient = getDistanceMatrix(['s_lat'  => $tripRequest['s_lat'],
                                       's_long' => $tripRequest['s_long'],
                                       'd_lat'  => $foundDriver->latitude,
                                       'd_long' => $foundDriver->longitude]);

            $driver = User::find($foundDriver->user_id)->driver()->first();
            $driverDeviceToken = $driver->device_token;
            $car = User::find($foundDriver->user_id)->car()->first();
            $carType = $car->type()->first();
            $driverInfo = [
                'first_name' => $driver->first_name,
                'last_name'  => $driver->last_name,
                'gender'  => $driver->gender,
                'picture'  => $driver->picture,
                'number'  => $car->number,
                'color'  => $car->color,
                'type'  => $carType->name,
                'phone' => User::find($foundDriver->user_id)->phone,
            ];

            // 
            // CLIENT_FOUND
            // 
            $trip->update([
                    'driver_id'              => $driver->id,
                    'status_id'              => Status::where('name', 'client_found')->firstOrFail()->value,
                    'etd_text'               => $driverToClient['duration']['text'],
                    'etd_value'              => $driverToClient['duration']['value'],
                    'driver_distance_text'   => $driverToClient['distance']['text'],
                    'driver_distance_value'  => $driverToClient['distance']['value'],
                    'driver_location'        => Location::where('user_id', $foundDriver->user_id)->orderBy('id', 'desc')->first()->id, // location
                    'updated_at'             => Carbon::now(),
                ]);

            $this->updateDriverAvailability($driver, false);

            dispatch(new SendClientNotification('wait_for_driver_to_accept_ride', '0', $clientDeviceToken));
            dispatch(new SendDriverNotification('new_client_found', '0', $driverDeviceToken));
            event(new RideAccepted(Trip::whereId($trip_id)->first(), $carType->name, $tripRequest['currency']));

            return ok([
                        'content'          => 'Trip request created successfully.',
                        'eta_text'         => $matrix['duration']['text'],
                        'eta_value'        => $matrix['duration']['value'],
                        'distance_text'    => $matrix['distance']['text'],
                        'distance_value'   => $matrix['distance']['value'],
                        'trip_status'      => 2,
                        'source_name'      => $source->name,
                        'destination_name' => $destination->name,
                        'driver'           => (object)$driverInfo,
                    ]);
        } else {
            //
            //  NO_DRIVER
            //  
            $trip->update([
                    'status_id'              => Status::where('name', 'no_driver')->firstOrFail()->value,
                    'updated_at'             => Carbon::now(),
                ]);

            dispatch(new SendClientNotification('no_driver_found', '1', $clientDeviceToken));

            return fail([
                'title'       => 'No driver available',
                'detail'      => 'There is no driver available in your area.',
                'trip_status' => 5,
            ], 404);
        }
    }

    /**
     * Check pending request for current client that is requesting a new taxi.
     * @return json
     */
    private function pendingRequestTaxi($userId)
    {
        /**
         * @todo add more state for pending request
         * @var QueryBuilder
         */
        if (! is_null($userId)) {
            $client = User::wherePhone(User::find($userId)->phone)
                        ->orderBy('id', 'desc')
                        ->first()->client()->first();
        } else {
            $client = User::wherePhone(Auth::user()->phone)
                        ->orderBy('id', 'desc')
                        ->first()->client()->first();
        }

        $pending = $client->trips()
                          ->where('status_id', Status::where('name', 'request_taxi')->firstOrFail()->value)
                          ->orWhere('status_id', Status::where('name', 'client_found')->firstOrFail()->value)
                          ->orWhere('status_id', Status::where('name', 'driver_onway')->firstOrFail()->value)
                          ->orWhere('status_id', Status::where('name', 'driver_arrived')->firstOrFail()->value)
                          ->orWhere('status_id', Status::where('name', 'trip_started')->firstOrFail()->value)
                          ->orWhere('status_id', Status::where('name', 'trip_ended')->firstOrFail()->value)
                          ->orWhere('status_id', Status::where('name', 'driver_rated')->firstOrFail()->value);

        if ($pending->count()) {
            if (env('APP_ENV', 'production') == 'local') {
                $this->updateDriverAvailability($pending->first()->driver, true);
                $this->updateStatus($pending->first(), 'reject_client_found');
                return false;
            }
            return fail([
                    'title' => 'You have pending request',
                    'detail'=> 'Please address your pending trip request at first',
                    'trips' => $pending->get(),
                ]);
        }

        return false;
    }

    /**
     * Update trip status.
     * @param  App\Trip $trip
     * @param  string $name status name
     * @return void
     */
    private function updateStatus($trip, $name)
    {
        $trip->update([
            'status_id' => Status::where('name', $name)->firstOrFail()->value,
        ]);
    }

    /**
     * Update driver availability.
     * @param  App\Driver $driver
     * @param  boolean $state
     * @return void
     */
    private function updateDriverAvailability($driver, $state)
    {
        $driver->available = $state;
        $driver->save();
    }

    /**
     * Exclude not responded drivers.
     * @param  integer $clientId
     * @return string
     */
    public function excludeDriver($clientId)
    {
        $exclude = Trip::orWhere('status_id', '<>', Status::where('name', 'trip_is_over')->firstOrFail()->value)
                        ->orWhere('status_id', '<>', Status::where('name', 'client_rated')->firstOrFail()->value)
                        ->orWhere('status_id', '<>', Status::where('name', 'driver_rated')->firstOrFail()->value)
                        ->orWhere('client_id', $clientId)
                        ->orWhere('created_at', '<', Carbon::now()->subMinutes(15)->toDateTimeString())
                        ->get(['driver_id'])->flatten();
        $toExclude = [];
        foreach ($exclude as $e) {
            if (! is_null($e->driver_id))
                $toExclude[] = $e->driver_id;
        }

        return [
                'count' => count($toExclude),
                'result' => implode(',', $toExclude)
            ];
    }

    /**
     * COunt of finished trips.
     * @return Numeric
     */
    public function countOfFinishedTrips()
    {
        $finishedCount = Trip::finishedCount();
        if (is_object($finishedCount)) {
            return 0;
        } else {
            return number_format($finishedCount, 2);
        }
    }

    /**
     * Count of cancelled trips.
     * @return Numeric
     */
    public function countOfCancelledTrips()
    {
        $canceledCount = Trip::canceledCount();
        if (is_object($canceledCount)) {
            return 0;
        } else {
            return number_format($canceledCount, 2);
        }
    }
}