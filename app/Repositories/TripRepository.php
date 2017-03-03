<?php

namespace App\Repositories;

use DB;
use Log;
use Auth;
use App\Car;
use App\Trip;
use App\User;
use App\Client;
use App\Driver;
use App\Status;
use App\Payment;
use App\Location;
use Carbon\Carbon;
use App\Events\TripEnded;
use App\Events\TripInitiated;
use App\Http\Requests\TripRequest;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;
use App\Repositories\LocationRepository;
use App\Repositories\TransactionRepository;

class TripRepository
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public static function requestTaxi($tripRequest, $exclude = 0, $userId = null)
    {
        /*        if (isset($tripRequest['s_lng'])) {
            $tripRequest['s_long'] = $tripRequest['s_lng'];
            $tripRequest['d_long'] = $tripRequest['d_lng'];
        }

        if (!isset($tripRequest['currency'])) {
            $tripRequest['currency'] = 'USD';
        }

        if (!isset($tripRequest['type'])) {
            $tripRequest['type'] = 'any';
        }

        if (!isset($tripRequest['payment'])) {
            $tripRequest['payment'] = 'cash';
        }*/

/*        if (! is_null($userId)) {
            $client = User::wherePhone(User::find($userId)->phone)
                        ->orderBy('id', 'desc')
                        ->first()->client()->first();
        } else {
            $client = User::wherePhone(Auth::user()->phone)
                        ->orderBy('id', 'desc')
                        ->first()->client()->first();
        }
*/

/*        $clientDeviceToken = $client->device_token;
        if ($pending = self::pendingRequestTaxi($userId)) {
            return $pending;
        }*/
        // Create::this($trip)->for('auth')->exclude($drivers)->now();

/*        $matrix = getDistanceMatrix($tripRequest);
        $source = LocationRepository::set($tripRequest['s_lat'], $tripRequest['s_long'], $userId);
        $destination = LocationRepository::set($tripRequest['d_lat'], $tripRequest['d_long'], $userId);*/

/*        if (! @isset($matrix['duration']['text'])) {
            return ok([
                    'title'  => 'Not valid trip',
                    'detail' => 'You cannot trip there!'
                ]);
        }*/

        return \App\Repositories\Trip\CreateRepository::this($tripRequest)->for('auth')->now();
        //
        // REQUEST_TAXI
        //
        $trip = Trip::forceCreate([
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

        $trip_id = $trip->id;

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

            $driver->updateDriverAvailability(false);

            dispatch(new SendClientNotification('wait_for_driver_to_accept_ride', '0', $clientDeviceToken));
            dispatch(new SendDriverNotification('new_client_found', '0', $driverDeviceToken));
            event(new TripInitiated(Trip::whereId($trip_id)->first(), $carType->name, $tripRequest['currency']));
            if ($tripRequest['payment'] == 'cash') {
                Payment::forceCreate([
                    'trip_id' => $trip_id,
                    'client_id' => $client->id,
                    'paid' => true,
                    'type' => 'cash',
                    'ref'  => '0000',
                ]);
            } elseif ($tripRequest['payment'] == 'wallet') {
                if ($client->balance > $trip->transaction->total) {
                    $client->updateBalance((int)$trip->transaction->total * (-1));
                } else {
                    dispatch(new SendClientNotification('switched_to_cash', '12', $clientDeviceToken));
                    Payment::forceCreate([
                        'trip_id' => $trip_id,
                        'client_id' => $client->id,
                        'paid' => true,
                        'type' => 'cash',
                        'ref'  => '0000',
                    ]);
                }
            }
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

        $pending = Trip::where('client_id', $client->id)
                        ->where('driver_id', '<>', null)
                        ->whereIn('status_id', Trip::$pending);

        // TODO
        if ($pending->count()) {
            if (env('APP_ENV', 'production') == 'local') {
                if (is_null($pending->first()->driver)) {
                    $pending->first()->updateStatusTo('no_driver');
                } else {
                    $pending = $pending->first();
                    if (!is_null($pending->next)) {
                        $pending->updateStatusTo('trip_is_over_by_admin');
                        $tripToCancel = Trip::find($pending->next);
                        while (!is_null($tripToCancel->next)) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        $tripToCancel->updateStatusTo('next_trip_halt');
                    } else {
                        $pending->updateStatusTo('trip_is_over_by_admin');
                    }
                    $pending->driver->updateDriverAvailability(true);
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
     * Exclude not responded drivers.
     * @param  integer $clientId
     * @return string
     */
    public static function excludeDriver($clientId)
    {
        if (env('APP_ENV', 'production') == 'local') {
            $exclude = Trip::whereNotIn('status_id', [15, 16, 17])
                            ->where('client_id', $clientId)
                            ->where('created_at', '>', Carbon::now()->subMinutes(1)->toDateTimeString())
                            ->get(['driver_id'])->flatten();
        } else {
            $exclude = Trip::whereNotIn('status_id', [15, 16, 17])
                            ->where('client_id', $clientId)
                            ->whereDate('created_at', '>', Carbon::now()->subMinutes(15)->toDateTimeString())
                            ->get(['driver_id'])->flatten();
        }
        $toExclude = [];
        foreach ($exclude as $e) {
            if (! is_null($e->driver_id)) {
                $toExclude[] = $e->driver_id;
            }
        }
        //$toExclude = array_unique($toExclude);
        Log::info('To exclude: ', $toExclude);
        if (empty($toExclude)) {
            $toExclude = [0];
        }

        return [
                'count' => count($toExclude),
                'result' => implode(',', $toExclude)
            ];
    }

    /**
     * Calculate trips percentages for each status in current month.
     * @return array
     */
    public static function calculateTripPercentages()
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

        foreach (range(1, 27) as $i) {
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
        $add = 0;
        while (Carbon::now()->month == $startOfMonth) {
            // When there is no filter.
            if (is_null($filter)) {
                $total = Trip::whereBetween('created_at', [Carbon::now()->startOfMonth()->addDay($add++),
                                                           Carbon::now()->startOfMonth()->addDay($add)])
                            ->count();
            } else {
                // When there is and active filter.
                $total = Trip::whereBetween('created_at', [Carbon::now()->startOfMonth()->addDay($add++),
                                                           Carbon::now()->startOfMonth()->addDay($add)])
                            ->whereStatusId(Status::whereName($filter)->first()->id)
                            ->count();
            }
            $dailyFinishedTripsOnMonth[] = [Carbon::now()->startOfDay()->addDay($add)->day, $total];
            $startOfMonth = Carbon::now()->startOfMonth()->addDay($add)->month;
        }
        // Sort data.
        asort($dailyFinishedTripsOnMonth);
        
        // return only values.
        return array_values($dailyFinishedTripsOnMonth);
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
            $trip   = $client->trips()->where('driver_id', '<>', null)->orderBy('id', 'desc')->first();

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
                    if (!is_null($trip->next)) {
                        $tripToCancel = Trip::find($trip->next);
                        while (!is_null($tripToCancel->next)) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        $this->tripToCancel->updateStatusTo('next_trip_halt');
                    }
                    $this->trip->updateStatusTo('cancel_request_taxi');

                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from ' . $status . ' to 10',
                        ]);
                    break;
                case '3':
                case '4':
                    $trip->updateStatusTo('cancel_request_taxi');
                    if (!is_null($trip->next)) {
                        $tripToCancel = Trip::find($trip->next);
                        while (!is_null($tripToCancel->next)) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        $tripToCancel->updateStatusTo('next_trip_halt');
                    }
                    $driver->updateDriverAvailability(true);

                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from ' . $status . ' to 10',
                        ]);
                    break;

                //
                // CLIENT_FOUND
                //
                case '2':
                    $trip->updateStatusTo('cancel_request_taxi');
                    if (!is_null($trip->next)) {
                        $tripToCancel = Trip::find($trip->next);
                        while (!is_null($tripToCancel->next)) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        $tripToCancel->updateStatusTo('next_trip_halt');
                    }
                    $driver->updateDriverAvailability(true);
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
                    $trip->updateStatusTo('cancel_onway_driver');
                    if (!is_null($trip->next)) {
                        $tripToCancel = Trip::find($trip->next);
                        while (!is_null($tripToCancel->next)) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        $tripToCancel->updateStatusTo('next_trip_halt');
                    }
                    $driver->updateDriverAvailability(true);
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
                    $trip->updateStatusTo('client_canceled_arrived_driver');
                    if (!is_null($trip->next)) {
                        $tripToCancel = Trip::find($trip->next);
                        while (!is_null($tripToCancel->next)) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        $tripToCancel->updateStatusTo('next_trip_halt');
                    }
                    $driver->updateDriverAvailability(true);
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
        } elseif (Auth::user()->role == 'driver') {
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
                    if (!is_null($trip->next)) {
                        $trip->updateStatusTo('on_next_trip_canceled');
                        $tripToCancel = Trip::find($trip->next);
                        while (!is_null($tripToCancel->next)) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        $tripToCancel->updateStatusTo('next_trip_halt');
                    } else {
                        $trip->updateStatusTo('driver_reject_started_trip');
                    }
                    $driver->updateDriverAvailability(true);
                    dispatch(new SendClientNotification('started_trip_cancelled_by_driver', '2', Client::whereId($trip->client_id)->first()->device_token));
                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from 6 to 8',
                        ]);
                    break;

                //
                // DRIVER_ONWAY
                // TO arrive and ON TIRP
                // @todo: these 2 status shall be separated and have their vary
                // own cases.
                //
                case '7':
                case '20':
                    if (!is_null($trip->next)) {
                        $trip->updateStatusTo('on_next_trip_canceled');
                        $tripToCancel = Trip::find($trip->next);
                        while (!is_null($tripToCancel->next)) {
                            if ($tripToCancel->status_id == 27) {
                                $tripToCancel->updateStatusTo('next_trip_halt');
                            }
                            if ($tripToCancel->status_id == 22 || $tripToCancel->status_id == 24) {
                                $tripToCancel->updateStatusTo('next_trip_cancel');
                            }
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        if ($tripToCancel->status_id == 27) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                        }
                    } else {
                        $trip->updateStatusTo('cancel_onway_driver');
                    }
                    $driver->updateDriverAvailability(true);
                    dispatch(new SendClientNotification('arrived_driver_cancelled_trip', '4', Client::whereId($trip->client_id)->first()->device_token));
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
                    if (!is_null($trip->next)) {
                        $trip->updateStatusTo('on_next_trip_canceled');
                        $tripToCancel = Trip::find($trip->next);
                        while (!is_null($tripToCancel->next)) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        $tripToCancel->updateStatusTo('next_trip_halt');
                    } else {
                        $trip->updateStatusTo('reject_client_found');
                    }
                    $driver->updateDriverAvailability(true);
                    dispatch(new SendClientNotification('new_clinet_cancelled_by_driver', '3', Client::whereId($trip->client_id)->first()->device_token));
                    dispatch(new SendClientNotification('new_clinet_cancelled_by_driver', '3', Client::whereId($trip->client_id)->first()->device_token));
                    // Request new taxi
                    if (is_null($trip->next)) {
                        $tripRepository = new TripRepository();
                        $tripRequest = [
                                's_lat'  => $trip->source()->first()->latitude,
                                's_long' => $trip->source()->first()->longitude,
                                'd_lat'  => $trip->destination()->first()->latitude,
                                'd_long' => $trip->destination()->first()->longitude,
                            ];
                        $exclude = $tripRepository->excludeDriver($trip->client_id);
                        if ($exclude['count'] < 10) {
                            Create::this($tripRequest)->for(Client::find($trip->client_id)->user->id)->exclude($exclude['result'])->now();
                        } else {
                            $trip->updateStatusTo('no_driver');
                            dispatch(new SendClientNotification('no_driver_found', '1', Client::where('id', $trip->client_id)->firstOrFail()->device_token));
                        }
                    } else {
                        $prevTrip = Trip::find($trip->id);
                        $locations = [];
                        while (!is_null($prevTrip->next)) {
                            $locations[] = $prevTrip->source;
                            $prevTrip = Trip::find($prevTrip->next);
                        }
                        $locations[] = $prevTrip->source;
                        $locations[] = $prevTrip->destination;

                        $tripRequest = [];
                        foreach ($locations as $index => $location) {
                            if ($index == 0) {
                                $latLng = Location::find($location);
                                $tripRequest[] = [
                                    's_lat' => $latLng->latitude,
                                    's_long' => $latLng->longitude,
                                ];
                                continue;
                            }

                            $latLng = Location::find($location);
                            $tripRequest[] = [
                                'd_lat' => $latLng->latitude,
                                'd_long' => $latLng->longitude,
                            ];
                        }
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
                    if (!is_null($trip->next)) {
                        $trip->updateStatusTo('on_next_trip_canceled');
                        $tripToCancel = Trip::find($trip->next);
                        while (!is_null($tripToCancel->next)) {
                            $tripToCancel->updateStatusTo('next_trip_halt');
                            $tripToCancel = Trip::find($tripToCancel->next);
                        }
                        $tripToCancel->updateStatusTo('next_trip_halt');
                    } else {
                        $trip->updateStatusTo('driver_cancel_arrived_status');
                    }
                    $driver->updateDriverAvailability(true);
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
        $trip->updateStatusTo('trip_is_over_by_admin');
        if (! is_null($trip->driver)) {
            $trip->driver->updateDriverAvailability(true);
            dispatch(new SendDriverNotification('trip_is_over_by_admin', '5', $trip->driver->device_token));
        }
        dispatch(new SendClientNotification('trip_is_over_by_admin', '9', $trip->client->device_token));
        return back();
    }

    /**
     * Calculate distance and cost between 2 points.
     * @return json
     */
    public static function calculate($tripRequest)
    {
        // API V2
        if (isset($tripRequest->s_lng)) {
            $tripRequest->s_long = $tripRequest->s_lng;
            $tripRequest->d_long = $tripRequest->d_lng;
        }
        $source = LocationRepository::getGeocoding($tripRequest->s_lat, $tripRequest->s_long);
        $destination = LocationRepository::getGeocoding($tripRequest->d_lat, $tripRequest->d_long);
        $distanceMatrix = getDistanceMatrix((array)$tripRequest); // 'distance', 'duration'
        if (!isset($distanceMatrix['distance'])) {
            return fail([
                    'title'  => 'Failed',
                    'detail' => 'Failed to interact with Google Maps'
                ]);
        }
        $transactions = (new TransactionRepository())->calculate($tripRequest->s_lat, $tripRequest->s_long,
                                             $distanceMatrix['distance']['value'],
                                             $distanceMatrix['duration']['value'], 'USD');
        return ok([
                'source'       => $source,
                'destination'  => $destination,
                'distance'     => $distanceMatrix['distance'],
                'duration'     => $distanceMatrix['duration'],
                'transactions' => $transactions,
            ]);
    }

    /**
     * Accept trip.
     * @return boolean
     */
    public static function accept()
    {
        $driver = Auth::user()->driver()->first();
        $trip = $driver->trips()->where('prev', null)->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return false;
        }
        if ($trip->status_id == 2) {
            $trip->updateStatusTo('driver_onway');
            $driver->updateDriverAvailability(false);
            dispatch(new SendClientNotification('driver_onway', '5', Client::whereId($trip->client_id)->first()->device_token));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Start trip.
     * @return boolean
     */
    public static function start()
    {
        $driver = Auth::user()->driver()->first();
        $trip = $driver->trips()->whereIn('status_id', ['12', '20'])->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return false;
        }

        //
        // DRIVER_ARRIVED
        //
        if ($trip->status_id == 12) {
            $trip->updateStatusTo('trip_started');
            dispatch(new SendClientNotification('trip_started', '6', Client::whereId($trip->client_id)->first()->device_token));
            return true;
        } elseif ($trip->status_id == 20) {
            $tripToStart = $trip;
            while ($tripToStart->status_id != 24) {
                $tripToStart = Trip::find($tripToStart->next);
                if ($tripToStart->status_id == 22) {
                    return false;
                }
                if (is_null($tripToStart->next)) {
                    break;
                }
            }
            $tripToStart->updateStatusTo('next_trip_start');
            dispatch(new SendClientNotification('trip_started', '6', Client::whereId($trip->client_id)->first()->device_token));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Driver arrived.
     * @return boolean
     */
    public static function arrived()
    {
        $driver = Auth::user()->driver()->first();
        $trip = $driver->trips()->where('prev', null)->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return false;
        }
        if ($trip->status_id == 7) {
            $trip->updateStatusTo('driver_arrived');
            dispatch(new SendClientNotification('driver_arrived', '8', Client::whereId($trip->client_id)->first()->device_token));
            return true;
        } else {
            return false;
        }
    }

    /**
     * End trip.
     * @return boolean
     */
    public static function end()
    {
        $driver = Auth::user()->driver()->first();
        $trip = $driver->trips()->whereIn('status_id', ['6', '20'])->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return false;
        }

        // If trip has been paid it can be end.
        if (! $trip->payments()->paid()->exists()) {
            return fail([
                'title'  => 'trip is not paid',
                'detail' => 'Please ask the client to pay for the trip.'
            ]);
        }

        // Single trip ended
        if ($trip->status_id == 6) {
            if (is_null($trip->next)) {
                $trip->updateStatusTo('trip_ended');
                dispatch(new SendClientNotification('trip_ended', '7', Client::whereId($trip->client_id)->first()->device_token));
                event(new TripEnded($trip));
                return true;
            } else {
                $trip->updateStatusTo('on_next_trip');
                Trip::find($trip->next)->updateStatusTo('next_trip_wait');
                dispatch(new SendClientNotification('trip_ended', '7', Client::whereId($trip->client_id)->first()->device_token));
                return true;
            }
        }
        // Multi route trip ended
        elseif ($trip->status_id == 20) {
            $mainTrip = $tripToEnd = $trip;
            while ($tripToEnd->status_id != 22) {
                $tripToEnd = Trip::find($tripToEnd->next);
                if ($tripToEnd->status_id == 23) {
                    // Time to ignore.
                    return false;
                }
                if (is_null($tripToEnd->next)) {
                    // Time to break.
                    break;
                }
            }
            if (is_null($tripToEnd->next)) {
                $tripToEnd->updateStatusTo('next_trip_end');
                $mainTrip->updateStatusTo('trip_ended');
                dispatch(new SendClientNotification('trip_ended', '7', Client::whereId($mainTrip->client_id)->first()->device_token));
                event(new TripEnded($mainTrip));
                return true;
            } else {
                $tripToEnd->updateStatusTo('next_trip_end');
                Trip::find($tripToEnd->next)->updateStatusTo('next_trip_wait');
                dispatch(new SendClientNotification('trip_ended', '7', Client::whereId($tripToEnd->client_id)->first()->device_token));
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Current state of the trip.
     * @return json
     */
    public static function trip()
    {
        if (Auth::user()->role == 'client') {
            $client = User::wherePhone(Auth::user()->phone)
                            ->orderBy('id', 'desc')
                            ->first()->client()->first();
            $trip = $client->trips()->where('prev', null)->orderBy('id', 'desc')->first();
            if (self::notOnTrip($trip)) {
                return false;
            }

            $driver = Driver::where('id', $trip->driver_id)->first(['first_name', 'last_name', 'email', 'gender', 'picture', 'user_id']);
            if (is_null($driver)) {
                return false;
            }
            $driver->phone = $driver->user->phone;
            $car = Car::whereUserId($driver->user_id)->first(['number', 'color', 'type_id']);
            $carType = $car->type()->first(['name']);
            $source = $trip->source()->first(['latitude', 'longitude', 'name']);
            // It's multi trip
            if (!is_null($trip->next)) {
                $tripTemp = $trip;
                $listOfDestinations = [];
                while (!is_null($tripTemp->next)) {
                    $listOfDestinations[] = $trip->destination()->first(['latitude', 'longitude', 'name']);
                    $tripTemp = Trip::find($tripTemp->next);
                }
                $listOfDestinations[] = $tripTemp->destination()->first(['latitude', 'longitude', 'name']);
                $destination = $listOfDestinations;
            } else {
                $destination = $trip->destination()->first(['latitude', 'longitude', 'name']);
            }
            $status = Status::whereValue($trip->status_id)->first(['name', 'value']);
            // $driverLocation = $trip->driverLocation()->orderBy('id', 'acs')->first(['latitude', 'longitude', 'name']);
            $driverLocation = Location::whereUserId($trip->driver()->first()->user_id)
                                        ->orderBy('id', 'desc')
                                        ->first(['latitude', 'longitude', 'name']);
            // On multi trip the trip prev to the trip_to_happen is the current trip.
            if (!is_null($trip->next)) {
                $tripTemp = $trip;
                $nextTripStatus = Trip::find($tripTemp->next)->status_id;
                while (!is_null($tripTemp->next) && $nextTripStatus != 27) {
                    $tripTemp = Trip::find($tripTemp->next);
                }
                $trip = $tripTemp;
            }
            unset($driver->user_id, $trip->next, $trip->prev, $trip->client_id, $trip->driver_id, $trip->status_id, $trip->source, $trip->destination,
                $trip->created_at, $trip->updated_at, $trip->transaction_id, $trip->rate_id, $trip->driver_location, $driver->user);

            if (is_null($trip->payments()->first())) {
                return false;
            }

            return [
                    'paid' => $trip->payments()->paid()->exists(),
                    'payment' => $trip->payments()->first()->type,
                    'driver' => $driver,
                    'trip'   => $trip,
                    'status' => $status,
                    'car'    => $car,
                    'type'   => $carType,
                    'source' => $source,
                    'destination' => $destination,
                    'driver_location' => $driverLocation,
                    'total' => $trip->transaction()->first()->total,
                ];
        } elseif (Auth::user()->role == 'driver') {
            $driver = Auth::user()->driver()->first();
            $trip = $driver->trips()->orderBy('id', 'desc')->first();
            $paid = $trip->payments()->paid()->exists();
            $total = $trip->transaction()->first()->total;
            if (self::notOnTrip($trip)) {
                return false;
            }
            $client = Client::whereId($trip->client_id)->first(['first_name', 'last_name', 'gender', 'picture', 'user_id']);
            $client->phone = $client->user->phone;
            $source = $trip->source()->first(['latitude', 'longitude', 'name']);
            // It's multi trip
            if (!is_null($trip->next)) {
                $tripTemp = $trip;
                $listOfDestinations = [];
                while (!is_null($tripTemp->next)) {
                    $listOfDestinations[] = $trip->destination()->first(['latitude', 'longitude', 'name']);
                    $tripTemp = Trip::find($tripTemp->next);
                }
                $listOfDestinations[] = $tripTemp->destination()->first(['latitude', 'longitude', 'name']);
                $destination = $listOfDestinations;
            } else {
                $destination = $trip->destination()->first(['latitude', 'longitude', 'name']);
            }
            $status = Status::whereValue($trip->status_id)->first(['name', 'value']);
            // On multi trip the trip prev to the trip_to_happen is the current trip.
            if (!is_null($trip->next)) {
                $tripTemp = $trip;
                $nextTripStatus = Trip::find($tripTemp->next)->status_id;
                while (!is_null($tripTemp->next) && $nextTripStatus != 27) {
                    $tripTemp = Trip::find($tripTemp->next);
                }
                $trip = $tripTemp;
            }
            unset($client->user_id, $trip->id, $trip->next, $trip->prev, $trip->client_id, $trip->driver_id, $trip->status_id, $trip->source, $trip->destination,
                $trip->created_at, $trip->updated_at, $trip->transaction_id, $trip->rate_id, $trip->driver_location, $client->user);
            return [
                    'paid' => $paid,
                    'client' => $client,
                    'trip'   => $trip,
                    'status' => $status,
                    'source' => $source,
                    'destination' => $destination,
                    'total' => $total,
                ];
        }
    }

    /**
     * If current driver or client on a trip.
     * @param  App\Trip $trip
     * @return boolean
     */
    private static function notOnTrip($trip)
    {
        if (is_null($trip)) {
            return true;
        }

        if (Auth::user()->role == 'client' &&
            // DRIVER_RATED
            $trip->status_id   ==  16) {
            return true;
        }

        if (Auth::user()->role == 'driver' &&
            // DRIVER_RATED
            $trip->status_id   ==  15) {
            return true;
        }

        if ($trip->status_id == 10 ||
            $trip->status_id == 5  ||
            $trip->status_id == 4  ||
            $trip->status_id == 11 ||
            $trip->status_id == 8  ||
            $trip->status_id == 13 ||
            $trip->status_id == 14 ||
            $trip->status_id == 17 ||
            $trip->status_id == 3) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get nearby drivers.
     * @param App\Http\Requests\NearbyRequest $request
     * @return array
     */
    public static function nearby($request)
    {
        // API V2
        if (isset($request->lng)) {
            $request->long = $request->lng;
        }

        if (is_null($request->limit)) {
            $request->limit = 5;
        }

        if (is_null($request->distance)) {
            $request->distance = 1;
        }

        if (is_null($request->type)) {
            $request->type = 'any';
        }

        return nearby($request->lat,
                                $request->long,
                                $request->type,
                                $request->distance,
                                $request->limit)['result'];
    }

    /**
     * Check max multi trip limit.
     * @param array $route list of routes to navigate.
     * @return boolean
     */
    public static function maxMultiTripLimit($route)
    {
        return (count($route) > config('taxi.multi.max'));
    }

    /**
     * Check min multi trip limit.
     * @param array $route list of routes to navigate.
     * @return boolean
     */
    public static function minMultiTripLimit($route)
    {
        return (count($route) < config('taxi.multi.min'));
    }

    /**
     * test to see if the given object contains s_lat and s_long.
     * @param  object  $param
     * @return boolean
     */
    public static function isSlatAndSlong($param)
    {
        return (!isset($param->s_lat) || !isset($param->s_long));
    }

    /**
     * Is d_lat and d_long set.
     * @param  object  $param
     * @return boolean
     */
    public static function isDlatAndDlong($param)
    {
        return (!isset($param->d_lat) || !isset($param->d_long));
    }

    /**
     * Test if the given object of lat and long is a valid one.
     * @param  object $latLong
     * @return boolean
     */
    public static function pregMatchLatAndLong($latLong)
    {
        return (preg_match('/^[+-]?\d+\.\d+$/', $latLong->lat) &&
                preg_match('/^[+-]?\d+\.\d+$/', $latLong->long));
    }

    /**
     * Determine whether or not the list of destinations are a valid list of destinations or not.
     * @param  object $route
     * @return boolean
     */
    public static function isDestinationsValid($route)
    {
        foreach ($route as $index => $r) {
            // First element suppose to be source.
            if ($index == 0) {
                continue;
            }

            if (TripRepository::isDlatAndDlong($r)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Validate list of destinations against Google Maps API.
     * @param  object $route
     * @return json
     */
    public static function validateListOfTripAgainstGoogleMaps($route)
    {
        foreach ($route as $index => $r) {
            if ($index + 1 == count($route)) {
                break;
            }
            // If it's first element.
            if ($index == 0) {
                $location['s_lat'] = $r->s_lat;
                $location['s_long'] = $r->s_long;
            } else {
                $location['s_lat'] = $r->d_lat;
                $location['s_long'] = $r->d_long;
            }
            $location['d_lat'] = $route[$index + 1]->d_lat;
            $location['d_long'] = $route[$index + 1]->d_long;
            $matrix = getDistanceMatrix($location);
            if (! @isset($matrix['duration']['text'])) {
                return [$location['s_lat'], $location['s_long'], $location['d_lat'], $location['d_long']];
            }
        }
    }

    /**
     * Check to ensure destinations are not same sequentially
     * @param  object $route
     * @return json
     */
    public static function notSameSequentially($route)
    {
        foreach ($route as $index => $r) {
            // Last element should skip, because there can not be sequence.
            if ($index + 1 == count($route)) {
                break;
            }

            if ((array) $r == (array) $route[$index + 1]) {
                // destinations that caused the problem.
                $first = $index + 1;
                $second = $index + 2;
                return [$first, $second];
            }
        }
    }

    /**
     * Validate routes with preg_match
     * @param  object $route
     * @return json
     */
    public static function validateWithPregMatch($route)
    {
        foreach ($route as $index => $r) {
            if ($index == 0) {
                if (! TripRepository::pregMatchLatAndLong((object) ['lat' => $r->s_lat, 'long' => $r->s_long])) {
                    return 'source';
                }
            } elseif (! TripRepository::pregMatchLatAndLong((object) ['lat' => $r->d_lat, 'long' => $r->d_long])) {
                return $index + 1;
            }
        }
    }

    /**
     * Create multi routes trip.
     * @param  object $route
     * @return json
     */
    public static function createMultiRouteTrip($route, $exclude = 0, $userId = null)
    {
        $distanceSum = 0;
        $durationSum = 0;
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

        $trips = [];
        foreach ($route as $index => $r) {
            // Last element should skip, because there can not be sequence.
            if ($index + 1 == count($route)) {
                break;
            }

            // If it's first element.
            if ($index == 0) {
                $location['s_lat'] = $r->s_lat;
                $location['s_long'] = $r->s_long;
            } else {
                $location['s_lat'] = $r->d_lat;
                $location['s_long'] = $r->d_long;
            }
            $location['d_lat'] = $route[$index + 1]->d_lat;
            $location['d_long'] = $route[$index + 1]->d_long;
            $matrix = getDistanceMatrix($location);
            $source = LocationRepository::set($location['s_lat'], $location['s_long'], $userId);
            $destination = LocationRepository::set($location['d_lat'], $location['d_long'], $userId);
            if ($index != 0) {
                $statusId = Status::where('name', 'next_trip_to_happen')->firstOrFail()->value;
            } else {
                $statusId = Status::where('name', 'request_taxi')->firstOrFail()->value;
            }
            //
            // REQUEST_TAXI
            //
            $trips[] = Trip::forceCreate([
                        'client_id'       => $client->id,
                        'status_id'       => $statusId,
                        'source'          => $source->id,
                        'destination'     => $destination->id,
                        'eta_text'        => $matrix['duration']['text'],
                        'eta_value'       => $matrix['duration']['value'],
                        'distance_text'   => $matrix['distance']['text'],
                        'distance_value'  => $matrix['distance']['value'],
                        'created_at'      => Carbon::now(),
                        'updated_at'      => Carbon::now(),
                    ]);

            $distanceSum += (int) $matrix['distance']['value'];
            $durationSum += (int) $matrix['duration']['value'];
        }

        // Fill next and prev ids
        foreach ($trips as $index => $trip) {
            // For first element, next prop shall be set
            if ($index == 0) {
                $trip->forceFill(['next' => $trips[$index+1]->id])->save();
                continue;
            }
            // For last element, prev prop shall be set
            if ($index + 1 == count($trips)) {
                $trip->forceFill(['prev' => $trips[$index-1]->id])->save();
                continue;
            }
            // assign next and prev props for middle items
            $trip->forceFill(['next' => $trips[$index+1]->id, 'prev' => $trips[$index-1]->id])->save();
        }

        // Main trip ID
        $trip = $trips[0];
        $trip_id = $trip->id;
        $tripIds = '';
        foreach ($trips as $index => $t) {
            $tripIds .= $t->id;
            if ($index + 1 != count($trips)) {
                $tripIds .= ',';
            }
        }

        /**
         * If there is one available driver within 1KM.
         * No driver found state happens here.
         * When there is a driver we send the request to driver and wait for his/her response.
         */
        // ADD first trip ids
        $foundDriver = nearby($route[0]->s_lat, $route[0]->s_long, $tripRequest['type'], 10, 1, $exclude)['result'];
        if (!empty($foundDriver)) {
            $foundDriver = $foundDriver[0];
            // TODO
            $driverToClient = getDistanceMatrix(['s_lat'  => $route[0]->s_lat,
                                       's_long' => $route[0]->s_long,
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

            $driver->updateDriverAvailability(false);

            dispatch(new SendClientNotification('wait_for_driver_to_accept_ride', '0', $clientDeviceToken));
            dispatch(new SendDriverNotification('new_client_found', '0', $driverDeviceToken));
            event(new TripInitiated(Trip::whereId($trip_id)->first(), $carType->name, $tripRequest['currency']));

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

            // Halt other connected trips
            foreach ($trips as $index => $t) {
                // First trip that is the main trip will change its status to
                // NO_DRIVER other trips to the NEXT_TRIP_HALT
                if ($index == 0) {
                    continue;
                }

                $t->update([
                        'status_id'              => Status::where('name', 'next_trip_halt')->firstOrFail()->value,
                        'updated_at'             => Carbon::now(),
                    ]);
            }

            dispatch(new SendClientNotification('no_driver_found', '1', $clientDeviceToken));

            return fail([
                'title'       => 'No driver available',
                'detail'      => 'There is no driver available in your area.',
                'trip_status' => 5,
            ], 404);
        }
    }
}
