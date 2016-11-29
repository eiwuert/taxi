<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Trip;
use App\Driver;
use App\Client;
use App\Status;
use App\Location;
use Carbon\Carbon;
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
        if (!empty($foundDriver = nearby($tripRequest->s_lat, $tripRequest->s_long, 1, 1))) {
            $foundDriver = $foundDriver[0];
            $driverToClient = getDistanceMatrix(['s_lat'  => $tripRequest->s_lat,
                                       's_long' => $tripRequest->s_long,
                                       'd_lat'  => $foundDriver->latitude,
                                       'd_long' => $foundDriver->longitude]);

            $driver = User::find($foundDriver->user_id)->driver()->first();
            $driverDeviceToken = $driver->device_token;

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
                    'driver_location'        => $foundDriver->id, // location
                    'updated_at'             => Carbon::now(),
                ]);

            dispatch(new SendClientNotification('Waiting for driver', 'We are searching for a driver', $clientDeviceToken));
            dispatch(new SendDriverNotification('New trip request', 'There is a client waiting for trip', $driverDeviceToken));

            return ok([
                        'content'          => 'Trip request created successfully, waiting for driver(s) to accept.',
                        'eta_text'         => $matrix['duration']['text'],
                        'eta_value'        => $matrix['duration']['value'],
                        'distance_text'    => $matrix['distance']['text'],
                        'distance_value'   => $matrix['distance']['value'],
                        'trip_status'      => 2,
                        'source_name'      => $source->name,
                        'destination_name' => $destination->name,
                    ]);
        } else {
            //
            //  NO_DRIVER
            //  
            $trip->update([
                    'status_id'       => Status::where('name', 'no_driver')->firstOrFail()->id,
                    'updated_at'      => Carbon::now(),
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

        return ok(nearby($request->lat, 
                                $request->long, 
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
            $client = Auth::user()->client()->first()->trips()->first()->status_id;
            
        } else if (Auth::user()->role == 'driver') {
            $driver = Auth::user()->driver()->first()->trips()->first()->status_id;
            
        } else {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'Fail',
                ]);
        }
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
                              ->orWhere('status_id', Status::where('name', 'client_found')->firstOrFail()->id);

    	if ($pending->count()) {
    		return fail([
    				'title' => 'You have pending request',
    				'detail'=> 'Please address your pending trip request at first',
    				'trips' => $pending->get(),
    			]);
    	}

    	return false;
    }
}
