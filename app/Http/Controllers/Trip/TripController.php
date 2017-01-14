<?php

namespace App\Http\Controllers\Trip;

use DB;
use Auth;
use App\Car;
use App\User;
use App\Trip;
use App\Driver;
use App\Client;
use App\Status;
use App\Location;
use Carbon\Carbon;
use App\Jobs\RequestTaxi;
use App\Events\TripEnded;
use App\Events\RideAccepted;
use Illuminate\Http\Request;
use App\Http\Requests\TripRequest;
use App\Http\Requests\NearbyRequest;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;
use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;

class TripController extends Controller
{
	/**
	 * Request taxi
	 *
	 * Request taxi by client.
	 * @return json
	 */
    public function requestTaxi(TripRequest $tripRequest, TripRepository $trip)
    {
        return $trip->requestTaxi($tripRequest->all());
    }

    /**
     * Show nearby taxi to client.
     * @param  \App\Http\Requests\NearbyRequest $request
     * @return json
     */
    public function nearbyTaxi(NearbyRequest $request)
    {
        if (is_null($request->limit)) {
            $request->limit = 5;
        }

        if (is_null($request->distance)) {
            $request->distance = 1;
        }

         if (is_null($request->type)) {
            $request->type = 'any';
        }

        return ok(nearby($request->lat, 
                                $request->long,
                                $request->type,   
                                $request->distance, 
                                $request->limit)['result'], 200, [], false);
    }

    /**
     * Cancel ride.
     * @return json
     */
    public function cancel()
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
                    $this->updateStatus($trip, 'cancel_request_taxi');

                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from ' . $status . ' to 10',
                        ]);
                    break;
                case '3':
                case '4':
                    $this->updateStatus($trip, 'cancel_request_taxi');
                    $this->updateDriverAvailability($driver, true);

                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from ' . $status . ' to 10',
                        ]);
                    break;

                //
                // CLIENT_FOUND
                //
                case '2':
                    $this->updateStatus($trip, 'cancel_request_taxi');
                    $this->updateDriverAvailability($driver, true);
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
                    $this->updateStatus($trip, 'cancel_onway_driver');
                    $this->updateDriverAvailability($driver, true);
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
                    $this->updateStatus($trip, 'client_canceled_arrived_driver');
                    $this->updateDriverAvailability($driver, true);
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
                    $this->updateStatus($trip, 'driver_reject_started_trip');
                    $this->updateDriverAvailability($driver, true);
                    dispatch(new SendClientNotification('started_trip_cancelled_by_driver', '2', Client::whereId($trip->client_id)->first()->device_token));
                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from 6 to 8',
                        ]);
                    break;

                //
                // CLIENT_FOUND
                //
                case '2':
                    $this->updateStatus($trip, 'reject_client_found');
                    $this->updateDriverAvailability($driver, true);
                    dispatch(new SendCLientNotification('new_clinet_cancelled_by_driver', '3', Client::whereId($trip->client_id)->first()->device_token));
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
                        dispatch(new SendClientNotification('1', 'no_driver_found', Client::where('id', $trip->client_id)->firstOrFail()->device_token));
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
                    $this->updateStatus($trip, 'driver_cancel_arrived_status');
                    $this->updateDriverAvailability($driver, true);
                    dispatch(new SendCLientNotification('arrived_driver_cancelled_trip', '4', Client::whereId($trip->client_id)->first()->device_token));
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
     * Accept ride and go to the client.
     * @return json
     */
    public function accept()
    {
        $driver = Auth::user()->driver()->first();
        $trip = $driver->trips()->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'You have no trip to start',
                ]);
        }
        if ($trip->status_id == 2) {
            $this->updateStatus($trip, 'driver_onway');
            $this->updateDriverAvailability($driver, false);
            dispatch(new SendClientNotification('driver_onway', '5', Client::whereId($trip->client_id)->first()->device_token));
            return ok([
                    'title'  => 'You are onway.',
                    'detail' => 'Trip status changed from 2 to 7',
                ]);   
        } else {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'You have no trip to start',
                ]);
        }
    }

    /**
     * Start ride.
     * @return json
     */
    public function start()
    {
        $driver = Auth::user()->driver()->first();
        $trip = $driver->trips()->orderBy('id', 'desc')->first();
        if (is_null ($trip)) {
            return fail([
                    'title'  => 'Wait',
                    'detail' => 'You still do not have trip, please wait.'
                ]);
        }

        //
        // DRIVER_ARRIVED
        //
        if ($trip->status_id == 12) {
            $this->updateStatus($trip, 'trip_started');
            $this->updateDriverAvailability($driver, false);
            dispatch(new SendClientNotification('trip_started', '6', Client::whereId($trip->client_id)->first()->device_token));
            return ok([
                    'title'  => 'Trip started.',
                    'detail' => 'Trip status changed from 12 to 6',
                ]);   
        } else {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'You have no trip to start',
                ]);
        }
    }

    /**
     * Current state of the trip.
     * @todo 
     * @return json
     */
    public function trip()
    {
        if (Auth::user()->role == 'client') {
            $client = User::wherePhone(Auth::user()->phone)
                            ->orderBy('id', 'desc')
                            ->first()->client()->first();
            $trip = $client->trips()->orderBy('id', 'desc')->first();
            if ($this->notOnTrip($trip)) {
                return fail([
                        'title'  => 'Not on trip',
                        'detail' => 'Not on an active trip right now',
                    ]);
            }

            $driver = Driver::where('id', $trip->driver_id)->first(['first_name', 'last_name', 'email', 'gender', 'picture', 'user_id']);
            $driver->phone = $driver->user->phone;
            $car = Car::whereUserId($driver->user_id)->first(['number', 'color', 'type_id']);
            $carType = $car->type()->first(['name']);
            $source = $trip->source()->first(['latitude', 'longitude', 'name']);
            $destination = $trip->destination()->first(['latitude', 'longitude', 'name']);
            $status = Status::whereId($trip->status_id)->first(['name', 'value']);
            $driverLocation = $trip->driverLocation()->first(['latitude', 'longitude', 'name']);
            unset($driver->user_id, $trip->id, $trip->client_id, $trip->driver_id, $trip->status_id, $trip->source, $trip->destination,
                $trip->created_at, $trip->updated_at, $trip->transaction_id, $trip->rate_id, $trip->driver_location, $driver->user);
            return ok([
                    'driver' => $driver,
                    'trip'   => $trip,
                    'status' => $status,
                    'car'    => $car,
                    'type'   => $carType,
                    'source' => $source,
                    'destination' => $destination,
                    'driver_location' => $driverLocation,
                ]);
        } else if(Auth::user()->role == 'driver') {
            $driver = Auth::user()->driver()->first();
            $trip = $driver->trips()->orderBy('id', 'desc')->first();
            if ($this->notOnTrip($trip)) {
                return fail([
                        'title'  => 'Not on trip',
                        'detail' => 'Not on an active trip right now',
                    ]);
            }
            $client = Client::whereId($trip->client_id)->first(['first_name', 'last_name', 'gender', 'picture', 'user_id']);
            $client->phone = $client->user->phone;
            $source = $trip->source()->first(['latitude', 'longitude', 'name']);
            $destination = $trip->destination()->first(['latitude', 'longitude', 'name']);
            $status = Status::whereId($trip->status_id)->first(['name', 'value']);
            unset($client->user_id, $trip->id, $trip->client_id, $trip->driver_id, $trip->status_id, $trip->source, $trip->destination,
                $trip->created_at, $trip->updated_at, $trip->transaction_id, $trip->rate_id, $trip->driver_location, $client->user);
            return ok([
                    'client' => $client,
                    'trip'   => $trip,
                    'status' => $status,
                    'source' => $source,
                    'destination' => $destination,
                ]);
        }
    }

    /**
     * End ride.
     * @return json
     */
    public function end()
    {
        $driver = Auth::user()->driver()->first();
        $trip = $driver->trips()->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'You have no trip to end or you cannot end trip now.',
                ]);
        }
        if ($trip->status_id == 6) {
            $this->updateStatus($trip, 'trip_ended');
            dispatch(new SendClientNotification('trip_ended', '7', Client::whereId($trip->client_id)->first()->device_token));
            event(new TripEnded($trip));
            return ok([
                    'title'  => 'Trip ended.',
                    'detail' => 'Trip status changed from 6 to 9, You can rate trip now.',
                ]);   
        } else {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'You have no trip to end or you cannot end trip now.',
                ]);
        }
    }

    /**
     * Driver arrived to start point to start the trip.
     * @return json
     */
    public function arrived()
    {
        $driver = Auth::user()->driver()->first();
        $trip = $driver->trips()->orderBy('id', 'desc')->first();
        if (is_null($trip)) {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'You cannot got to this status from your current state',
                ]);
        }
        if ($trip->status_id == 7) {
            $this->updateStatus($trip, 'driver_arrived');
            dispatch(new SendClientNotification('driver_arrived', '8', Client::whereId($trip->client_id)->first()->device_token));
            return ok([
                    'title'  => 'Waiting for client.',
                    'detail' => 'Trip status changed from 7 to 12.',
                ]);   
        } else {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'You cannot got to this status from your current state',
                ]);
        }
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
     * If current driver or client on a trip.
     * @param  App\Trip $trip
     * @return boolean
     */
    private function notOnTrip($trip)
    {
        if (is_null($trip)) {
            return true;
        }

        if ($trip->status_id == 10 ||
            $trip->status_id == 5  ||
            $trip->status_id == 11 ||
            $trip->status_id == 8  ||
            $trip->status_id == 9  ||
            $trip->status_id == 3  ) {
            return true;
        } else {
            return false;
        }
    }
}
