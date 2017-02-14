<?php

namespace App\Repositories;

use DB;
use Log;
use Auth;
use App\Car;
use App\User;
use App\Trip;
use Validator;
use App\Driver;
use App\Client;
use App\Status;
use App\Location;
use Carbon\Carbon;
use App\Events\TripEnded;
use App\Events\RideAccepted;
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
        if (isset($tripRequest['s_lng'])) {
            $tripRequest['s_long'] = $tripRequest['s_lng'];
            $tripRequest['d_long'] = $tripRequest['d_lng'];
        }


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
        $source = LocationRepository::set($tripRequest['s_lat'], $tripRequest['s_long'], $userId);
        $destination = LocationRepository::set($tripRequest['d_lat'], $tripRequest['d_long'], $userId);

        if (! @isset($matrix['duration']['text'])) {
            return ok([
                    'title'  => 'Not valid trip',
                    'detail' => 'You cannot trip there!'
                ]);
        }

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

        $pending = Trip::where('client_id', $client->id)
                        ->whereIn('status_id', [1, 2, 7, 12, 6, 9, 15]);

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
            if (! is_null($e->driver_id))
                $toExclude[] = $e->driver_id;
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

        foreach (range(1, 18) as $i) {
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
        $distanceMatrix = getDistanceMatrix($tripRequest); // 'distance', 'duration'
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
        $trip = $driver->trips()->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return false;
        }
        if ($trip->status_id == 2) {
            self::updateStatus($trip, 'driver_onway');
            self::updateDriverAvailability($driver, false);
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
        $trip = $driver->trips()->orderBy('id', 'desc')->first();
        if (is_null ($trip)) {
            return false;
        }

        //
        // DRIVER_ARRIVED
        //
        if ($trip->status_id == 12) {
            self::updateStatus($trip, 'trip_started');
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
        $trip = $driver->trips()->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return false;
        }
        if ($trip->status_id == 7) {
            self::updateStatus($trip, 'driver_arrived');
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
        $trip = $driver->trips()->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return false;
        }
        if ($trip->status_id == 6) {
            self::updateStatus($trip, 'trip_ended');
            dispatch(new SendClientNotification('trip_ended', '7', Client::whereId($trip->client_id)->first()->device_token));
            event(new TripEnded($trip));
            return true;
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
            $trip = $client->trips()->orderBy('id', 'desc')->first();
            if (self::notOnTrip($trip)) {
                return false;
            }

            $driver = Driver::where('id', $trip->driver_id)->first(['first_name', 'last_name', 'email', 'gender', 'picture', 'user_id']);
            $driver->phone = $driver->user->phone;
            $car = Car::whereUserId($driver->user_id)->first(['number', 'color', 'type_id']);
            $carType = $car->type()->first(['name']);
            $source = $trip->source()->first(['latitude', 'longitude', 'name']);
            $destination = $trip->destination()->first(['latitude', 'longitude', 'name']);
            $status = Status::whereValue($trip->status_id)->first(['name', 'value']);
            $driverLocation = $trip->driverLocation()->first(['latitude', 'longitude', 'name']);
            unset($driver->user_id, $trip->id, $trip->client_id, $trip->driver_id, $trip->status_id, $trip->source, $trip->destination,
                $trip->created_at, $trip->updated_at, $trip->transaction_id, $trip->rate_id, $trip->driver_location, $driver->user);
            return [
                    'driver' => $driver,
                    'trip'   => $trip,
                    'status' => $status,
                    'car'    => $car,
                    'type'   => $carType,
                    'source' => $source,
                    'destination' => $destination,
                    'driver_location' => $driverLocation,
                ];
        } else if(Auth::user()->role == 'driver') {
            $driver = Auth::user()->driver()->first();
            $trip = $driver->trips()->orderBy('id', 'desc')->first();
            if (self::notOnTrip($trip)) {
                return false;
            }
            $client = Client::whereId($trip->client_id)->first(['first_name', 'last_name', 'gender', 'picture', 'user_id']);
            $client->phone = $client->user->phone;
            $source = $trip->source()->first(['latitude', 'longitude', 'name']);
            $destination = $trip->destination()->first(['latitude', 'longitude', 'name']);
            $status = Status::whereValue($trip->status_id)->first(['name', 'value']);
            unset($client->user_id, $trip->id, $trip->client_id, $trip->driver_id, $trip->status_id, $trip->source, $trip->destination,
                $trip->created_at, $trip->updated_at, $trip->transaction_id, $trip->rate_id, $trip->driver_location, $client->user);
            return [
                    'client' => $client,
                    'trip'   => $trip,
                    'status' => $status,
                    'source' => $source,
                    'destination' => $destination,
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
            $trip->status_id == 3  ) {
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
}
