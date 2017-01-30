<?php

namespace App\Repositories;

use DB;
use Log;
use Auth;
use App\User;
use App\Trip;
use Validator;
use App\Driver;
use App\Client;
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
    public static function requestTaxi($tripRequest, $exclude = 0, $userId = null)
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
        if ($pending = self::pendingRequestTaxi($userId)) {
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
        $trip_id = DB::table('trips')->insert([
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

        $trip = DB::table('trips')->where('client_id', $client->id)
                    ->whereStatusId(Status::where('name', 'request_taxi')->firstOrFail()->value)
                    ->orderBy('id', 'desc');
        $trip_id = $trip->first()->id;

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

            self::updateDriverAvailability($driver, false);

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
    private static function pendingRequestTaxi($userId)
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
                if (is_null($pending->first()->driver)) {
                    self::updateStatus($pending->first(), 'no_driver');
                } else {
                    self::updateDriverAvailability($pending->first()->driver, true);
                    self::updateStatus($pending->first(), 'reject_client_found');
                }
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
    private static function updateStatus($trip, $name)
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
    private static function updateDriverAvailability($driver, $state)
    {
        $driver->available = $state;
        $driver->save();
    }

    /**
     * Exclude not responded drivers.
     * @param  integer $clientId
     * @return string
     */
    public static function excludeDriver($clientId)
    {
        if (env('APP_ENV', 'production') == 'local') {
            $exclude = Trip::orWhere('status_id', '<>', Status::where('name', 'trip_is_over')->firstOrFail()->value)
                            ->orWhere('status_id', '<>', Status::where('name', 'client_rated')->firstOrFail()->value)
                            ->orWhere('status_id', '<>', Status::where('name', 'driver_rated')->firstOrFail()->value)
                            ->orWhere('client_id', $clientId);
            $exclude = $exclude->whereDate('created_at', '<=', Carbon::now())
                                ->whereDate('created_at', '>=', Carbon::now()->subMinutes(1)->toDateTimeString())
                                ->get(['driver_id'])->flatten();
        } else {
            $exclude = Trip::orWhere('status_id', '<>', Status::where('name', 'trip_is_over')->firstOrFail()->value)
                            ->orWhere('status_id', '<>', Status::where('name', 'client_rated')->firstOrFail()->value)
                            ->orWhere('status_id', '<>', Status::where('name', 'driver_rated')->firstOrFail()->value)
                            ->orWhere('client_id', $clientId);
            $exclude = $exclude->whereDate('created_at', '<=', Carbon::now())
                                ->whereDate('created_at', '>=', Carbon::now()->subMinutes(15)->toDateTimeString())
                                ->get(['driver_id'])->flatten();
        }
        $toExclude = [];
        foreach ($exclude as $e) {
            if (! is_null($e->driver_id))
                $toExclude[] = $e->driver_id;
        }

        Log::info('To exclude: ', $toExclude);

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

    /**
     * Calculate trips percentages for each status in current month.
     * @return array
     */
    public function calculateTripPercentages()
    {
        $count = DB::table('trips')
                    ->select('status_id', DB::raw('count(*) as total'))
                    ->whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])
                    ->groupby('status_id')
                    ->get();
        $total = Trip::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])
                    ->count();
        $status = [];
        foreach ($count as $c) {
            $status[$c->status_id] = $c->total;
        }

        foreach (range(1, 17) as $i) {
            if (array_key_exists($i, $status)) {
                continue;
            } else {
                $status[$i] = 0;
            }
        }
        $status['total'] = $total;
        return $status;
    }

    /**
     * Count of each day of month finished trip to draw on the chart.
     * @param  String $filter apply filter on returned chart
     * @return array
     */
    public function dailyFinishedTripsOnMonth($filter = null)
    {
        // Goes to start of month
        $startOfMonth = Carbon::now()->startOfMonth()->month;
        $dailyFinishedTripsOnMonth = [];
        // Loop through days
        $add = 1;
        while(Carbon::now()->month == $startOfMonth) {
            if (is_null($filter)) {
                $total = Trip::whereBetween('created_at', [Carbon::now()->startOfMonth()->addDay($add++), Carbon::now()->startOfMonth()->addDay($add)])
                            ->count();
            } else {
                $total = Trip::whereBetween('created_at', [Carbon::now()->startOfMonth()->addDay($add++), Carbon::now()->startOfMonth()->addDay($add)])
                            ->whereStatusId(Status::whereName($filter)->first()->id)
                            ->count();
            }
            $dailyFinishedTripsOnMonth[] = [Carbon::now()->startOfDay()->addDay($add)->day, $total];
            $startOfMonth = Carbon::now()->startOfMonth()->addDay($add)->month;
        }
        return $dailyFinishedTripsOnMonth;
    }

    /**
     * Cancel trip.
     * @return json
     */
    public static function cancelTrip()
    {
        if (Auth::user()->role == 'client') {
            $client = User::wherePhone(Auth::user()->phone)
                            ->orderBy('id', 'desc')
                            ->first()->client()->first();
            $trip   = $client->trips()->orderBy('id', 'desc')->first();
            if (! is_null($trip->driver_id)) {
                $driver = Driver::whereId($trip->driver_id)->first();
            }
            if (! is_null($trip->status_id)) {
                $status = $trip->status_id;
            } else {
                $status = 0;
            }
            /**
             * Cancel by CLIENT
             */
            switch ($status) {
                //
                // REQUEST_TAXI
                // NO_RESPONSE
                // REJECT_CLIENT_FOUND
                //
                case '1':
                    self::updateStatus($trip, 'cancel_request_taxi');

                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from ' . $status . ' to 10',
                        ]);
                    break;
                case '3':
                case '4':
                    self::updateStatus($trip, 'cancel_request_taxi');
                    self::updateDriverAvailability($driver, true);

                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from ' . $status . ' to 10',
                        ]);
                    break;

                //
                // CLIENT_FOUND
                //
                case '2':
                    self::updateStatus($trip, 'cancel_request_taxi');
                    self::updateDriverAvailability($driver, true);
                    dispatch(new SendDriverNotification('trip_cancelled_by_client', '1', Driver::whereId($trip->driver_id)->first()->device_token));
                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from 2 to 10',
                        ]);
                    break;

                //
                // DRIVER_ONWAY
                //
                case '7':
                    self::updateStatus($trip, 'cancel_onway_driver');
                    self::updateDriverAvailability($driver, true);
                    dispatch(new SendDriverNotification('client_cancelled_onway_driver', '2', Driver::whereId($trip->driver_id)->first()->device_token));
                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from 7 to 11',
                        ]);
                    break;

                //
                // DRIVER_ARRIVED
                //
                case '12':
                    self::updateStatus($trip, 'client_canceled_arrived_driver');
                    self::updateDriverAvailability($driver, true);
                    dispatch(new SendDriverNotification('client_canceled_arrived_driver', '3', Driver::whereId($trip->driver_id)->first()->device_token));
                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from 12 to 13',
                        ]);
                    break;

                //
                // CANCEL FAIL
                //
                default:
                    return fail([
                            'title'  => 'You cannot do this.',
                            'detail' => 'You cannot cancel your ride on this status.',
                        ]);
                    break;
            }
        } else if (Auth::user()->role == 'driver') {
            $driver = Auth::user()->driver()->first();
            $trip   = $driver->trips()->orderBy('id', 'desc')->first();
            if (! is_null($trip)) {
                $status = $trip->status_id;
            } else {
                $status = 0;
            }
            //
            // Cancel by DRIVER
            //
            switch ($status) {
                //
                // TRIP_STARTED
                //
                case '6':
                    self::updateStatus($trip, 'driver_reject_started_trip');
                    self::updateDriverAvailability($driver, true);
                    dispatch(new SendClientNotification('started_trip_cancelled_by_driver', '2', Client::whereId($trip->client_id)->first()->device_token));
                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from 6 to 8',
                        ]);
                    break;

                //
                // DRIVER_ONWAY
                //
                case '7':
                    self::updateStatus($trip, 'cancel_onway_driver');
                    self::updateDriverAvailability($driver, true);
                    dispatch(new SendClientNotification('new_clinet_cancelled_by_driver', '3', Client::whereId($trip->client_id)->first()->device_token));
                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from 7 to 11',
                        ]);
                    break;

                //
                // CLIENT_FOUND
                //
                case '2':
                    self::updateStatus($trip, 'reject_client_found');
                    self::updateDriverAvailability($driver, true);
                    dispatch(new SendClientNotification('new_clinet_cancelled_by_driver', '3', Client::whereId($trip->client_id)->first()->device_token));
                    $tripRepository = new TripRepository();
                    $tripRequest = [
                        's_lat'  => $trip->source()->first()->latitude,
                        's_long' => $trip->source()->first()->longitude,
                        'd_lat'  => $trip->destination()->first()->latitude,
                        'd_long' => $trip->destination()->first()->longitude,
                    ];
                    $exclude = $tripRepository->excludeDriver($trip->client_id);
                    if ($exclude['count'] < 10) {
                        $tripRepository->requestTaxi($tripRequest, $exclude['result'], Client::find($trip->client_id)->user->id);
                    } else {
                        self::updateStatus($trip, 'no_driver');
                        dispatch(new SendClientNotification('no_driver_found', '1', Client::where('id', $trip->client_id)->firstOrFail()->device_token));
                    }
                    return ok([
                            'title'  => 'Trip rejected.',
                            'detail' => 'Trip status changed from 2 to 4',
                        ]);
                    break;

                //
                // DRIVER_ARRIVED
                //
                case '12':
                    self::updateStatus($trip, 'driver_cancel_arrived_status');
                    self::updateDriverAvailability($driver, true);
                    dispatch(new SendClientNotification('arrived_driver_cancelled_trip', '4', Client::whereId($trip->client_id)->first()->device_token));
                    return ok([
                            'title'  => 'Trip rejected.',
                            'detail' => 'Trip status changed from 12 to 14',
                        ]);
                    break;
                
                //
                // CANCEL FAIL
                //
                default:
                    return fail([
                            'title'  => 'You cannot do this.',
                            'detail' => 'You cannot cancel your ride on this status.',
                        ]);
                    break;
            }
        } else {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'Fail',
                ]);
        }
    }

    /**
     * Cancel a trip by admin.
     * @return boolean
     */
    public static function hardCancel($trip)
    {
        if (!Trip::whereId($trip)->exists()) {
            return back();
        }
        $trip = Trip::find($trip);
        self::updateStatus($trip, 'trip_is_over_by_admin');
        if(! is_null($trip->driver)) {
            self::updateDriverAvailability($trip->driver, true);
            dispatch(new SendDriverNotification('trip_is_over_by_admin', '5', $trip->driver->device_token));
        }
        dispatch(new SendClientNotification('trip_is_over_by_admin', '9', $trip->client->device_token));
        return back();
    }
}
