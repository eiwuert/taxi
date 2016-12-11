<?php

namespace App\Http\Controllers;

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
use App\Events\TripEnded;
use App\Events\RideAccepted;
use Illuminate\Http\Request;
use App\Http\Requests\TripRequest;
use App\Http\Requests\NearbyRequest;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;

class TripController extends Controller
{
	/**
	 * Request taxi
	 *
	 * Request taxi by client.
	 * @return json
	 */
    public function requestTaxi(TripRequest $tripRequest)
    {
        if (is_null($tripRequest->currency)) {
            $tripRequest->currency = 'USD';
        }

        if (is_null($tripRequest->type)) {
            $tripRequest->currency = 'any';
        }

        $clientDeviceToken = Auth::user()->client()->first()->device_token;
    	if ($pending = $this->pendingRequestTaxi()) {
            dispatch(new SendClientNotification('Pending trips', 'You have pending trips', $clientDeviceToken));
    		return $pending;
        }

        $matrix = getDistanceMatrix($tripRequest->all());
        $source = setLocation($tripRequest->s_lat, $tripRequest->s_long);
        $destination = setLocation($tripRequest->d_lat, $tripRequest->d_long);

        // 
        // REQUEST_TAXI
        // 
        $trip_id = DB::table('trips')->insertGetId([
                        'client_id'       => Auth::user()->client()->first()->id,
                        'status_id'       => Status::where('name', 'request_taxi')->firstOrFail()->id,
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
        if (!empty($foundDriver = nearby($tripRequest->s_lat, $tripRequest->s_long, $tripRequest->type, 10, 1))) {
            $foundDriver = $foundDriver[0];
            $driverToClient = getDistanceMatrix(['s_lat'  => $tripRequest->s_lat,
                                       's_long' => $tripRequest->s_long,
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
            ];

            // 
            // CLIENT_FOUND
            // 
            $trip->update([
                    'driver_id'              => $driver->id,
                    'status_id'              => Status::where('name', 'client_found')->firstOrFail()->id,
                    'etd_text'               => $driverToClient['duration']['text'],
                    'etd_value'              => $driverToClient['duration']['value'],
                    'driver_distance_text'   => $driverToClient['distance']['text'],
                    'driver_distance_value'  => $driverToClient['distance']['value'],
                    'driver_location'        => Location::where('user_id', $foundDriver->user_id)->orderBy('id', 'desc')->first()->id, // location
                    'updated_at'             => Carbon::now(),
                ]);

            //$this->updateDriverAvailability($driver, false);

            dispatch(new SendClientNotification('Waiting for driver', 'We are searching for a driver', $clientDeviceToken));
            dispatch(new SendDriverNotification('New trip request', 'There is a client waiting for trip', $driverDeviceToken));
            event(new RideAccepted(Trip::whereId($trip_id)->first(), $tripRequest->type, $tripRequest->currency));

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
                    'status_id'              => Status::where('name', 'no_driver')->firstOrFail()->id,
                    'updated_at'             => Carbon::now(),
                ]);

            dispatch(new SendClientNotification('No driver', 'There is no driver available', $clientDeviceToken));

            return fail([
                'title'       => 'No driver available',
                'detail'      => 'There is no driver available in your area.',
                'trip_status' => 5,
            ], 404);
        }
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
                                $request->limit), 200, [], false);
    }

    /**
     * Cancel ride.
     * @return json
     */
    public function cancel()
    {
        if (Auth::user()->role == 'client') {
            $client = Auth::user()->client()->first();
            $trip   = $client->trips()->orderBy('id', 'desc')->first();
            $driver = Driver::whereId($trip->driver_id)->first();
            $status = $trip->status_id;
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
                case '3':
                case '4':
                    $this->updateStatus($trip, 'cancel_request_taxi');
                    if (! is_null($driver)) {
                        $this->updateDriverAvailability($driver, true);
                    }
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
                    dispatch(new SendDriverNotification('Trip cancelled', 'Client cancelled the trip', Driver::whereId($trip->driver_id)->first()->device_token));
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
                    dispatch(new SendDriverNotification('Trip cancelled', 'Client cancelled the trip', Driver::whereId($trip->driver_id)->first()->device_token));
                    return ok([
                            'title'  => 'Trip cancelled.',
                            'detail' => 'Trip status changed from 7 to 11',
                        ]);
                    break;

                //
                // DRIVER_ARRIVED
                //
                case '12':
                    $this->updateStatus($trip, 'client_canceled_arrived_cancel');
                    $this->updateDriverAvailability($driver, true);
                    dispatch(new SendDriverNotification('Trip cancelled', 'Client cancelled the trip', Driver::whereId($trip->driver_id)->first()->device_token));
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
            $trip   = $driver->trips()->orderBy('id', 'desc')->first();;
            $status = $trip->status_id;
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
                    dispatch(new SendClientNotification('Trip cancelled', 'Driver cancelled the trip', Client::whereId($trip->client_id)->first()->device_token));
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
                    dispatch(new SendCLientNotification('Trip rejected', 'Driver rejected the trip', Client::whereId($trip->client_id)->first()->device_token));
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
                    dispatch(new SendCLientNotification('Trip rejected', 'Driver rejected the trip', Client::whereId($trip->client_id)->first()->device_token));
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
        if ($trip->status_id == 2) {
            $this->updateStatus($trip, 'driver_onway');
            $this->updateDriverAvailability($driver, false);
            dispatch(new SendClientNotification('Driver onway', 'Driver onway to you', Client::whereId($trip->client_id)->first()->device_token));
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
            dispatch(new SendClientNotification('Trip started', 'Trip started', Client::whereId($trip->client_id)->first()->device_token));
            return ok([
                    'title'  => 'Trip started.',
                    'detail' => 'Trip status changed from 2 to 6',
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
            $client = Auth::user()->client()->first();
            $trip = $client->trips()->orderBy('id', 'desc')->first();
            if ($this->notOnTrip($trip)) {
                return fail([
                        'title'  => 'Not on trip',
                        'detail' => 'Not on an active trip right now',
                    ]);
            }
            $driver = $trip->driver()->first();
            $car = Car::whereUserId($trip->driver_id)->first();
            $carType = $car->type()->first();

            return ok([
                    'driver' => $driver,
                    'trip'   => $trip,
                    'status' => Status::whereId($trip->status_id)->first(),
                    'car'    => $car,
                    'type'   => $carType,
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
            return ok([
                    'client' => $trip->client()->first(),
                    'trip'   => $trip,
                    'status' => Status::whereId($trip->id),
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
        if ($trip->status_id == 6) {
            $this->updateStatus($trip, 'trip_ended');
            $this->updateDriverAvailability($driver, true);
            dispatch(new SendClientNotification('Trip ended', 'Trip ended', Client::whereId($trip->client_id)->first()->device_token));
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
        if ($trip->status_id == 7) {
            $this->updateStatus($trip, 'driver_arrived');
            dispatch(new SendClientNotification('Driver arrived', 'Driver arrived', Client::whereId($trip->client_id)->first()->device_token));
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
            'status_id' => Status::where('name', $name)->firstOrFail()->id,
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
     * Check pending request for current client that is requesting a new taxi.
     * @return json
     */
    private function pendingRequestTaxi()
    {
    	/**
    	 * @todo add more state for pending request
    	 * @var QueryBuilder
    	 */
    	$pending = Auth::user()->client()->first()->trips()
                              ->where('status_id', Status::where('name', 'request_taxi')->firstOrFail()->id)
                              ->orWhere('status_id', Status::where('name', 'client_found')->firstOrFail()->id)
                              ->orWhere('status_id', Status::where('name', 'driver_onway')->firstOrFail()->id)
                              ->orWhere('status_id', Status::where('name', 'driver_arrived')->firstOrFail()->id)
                              ->orWhere('status_id', Status::where('name', 'trip_started')->firstOrFail()->id);

    	if ($pending->count()) {
    		return fail([
    				'title' => 'You have pending request',
    				'detail'=> 'Please address your pending trip request at first',
    				'trips' => $pending->get(),
    			]);
    	}

    	return false;
    }

    /**
     * If current driver or client on a trip.
     * @param  App\Trip $trip
     * @return boolean
     */
    private function notOnTrip($trip)
    {
        if ($trip->status_id == 10 ||
            $trip->status_id == 5  ||
            $trip->status_id == 11 ||
            $trip->status_id == 8  ||
            $trip->status_id == 9  ||
            $trip->status_id == 3  ||) {
            return true;
        } else {
            return false;
        }
    }
}
