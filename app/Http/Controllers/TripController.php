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
        $client_device_token = Auth::user()->client()->first()->device_token;
    	if ($pending = $this->pendingRequestTaxi()) {
            dispatch(new SendClientNotification('Pending trips', 'You have pending trips', $client_device_token));
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
                    ]);

        $trip = DB::table('trips')->where('id', $trip_id);

        /**
         * If there is one available driver within 1KM.
         * No driver found state happens here.
         * When there is a driver we send the requset to driver and wait for his/her response.
         */
        if (!empty($this->nearby($tripRequest->s_lat, $tripRequest->s_long, 1, 1))) {
            $found_driver = $this->nearby($tripRequest->s_lat, $tripRequest->s_long, 1, 1)[0];
            $driver_to_client = getDistanceMatrix(['s_lat'  => $tripRequest->s_lat,
                                       's_long' => $tripRequest->s_long,
                                       'd_lat'  => $found_driver->latitude,
                                       'd_long' => $found_driver->longitude]);

            $driver = User::find($found_driver->user_id)->driver()->first();
            $driver_device_token = $driver->device_token;

            // 
            // CLIENT_FOUND
            // 
            $trip->update([
                    'driver_id'              => $driver->id,
                    'status_id'              => Status::where('name', 'client_found')->firstOrFail()->id,
                    'etd_text'               => $driver_to_client['duration']['text'],
                    'etd_value'              => $driver_to_client['duration']['value'],
                    'driver_distance_text'   => $driver_to_client['distance']['text'],
                    'driver_distance_value'  => $driver_to_client['distance']['value'],
                    'driver_location'        => $found_driver->id, // location
                ]);

            dispatch(new SendClientNotification('Waiting for driver', 'We are searching for a driver', $client_device_token));
            dispatch(new SendDriverNotification('New trip request', 'There is a client waiting for trip', $driver_device_token));

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
                ]);

            dispatch(new SendClientNotification('No driver', 'There is no driver available', $client_device_token));

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

        return ok($this->nearby($request->lat, 
                                $request->long, 
                                $request->distance, 
                                $request->limit), 200, [], false);
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

    /**
     * Find nearby
     * @param  numeric  $lat
     * @param  numeric  $long
     * @param  float    $distance
     * @param  integer  $limit
     * @return PDO
     */
    private function nearby($lat, $long, $distance = 1.0, $limit = 5)
    {
        $query = "SELECT id, distance, longitude, latitude, name, user_id
        FROM (
        select id, longitude, latitude, name, user_id, ( 6371 * acos( COS( RADIANS(CAST($lat AS double precision)) ) * 
                                                                COS( RADIANS( CAST(latitude  AS double precision) ) ) * 
                                                                COS( RADIANS( CAST(longitude AS double precision) ) - 
                                                                RADIANS(CAST($long AS double precision)) ) + 
                                                                SIN( RADIANS(CAST($lat AS double precision)) ) * 
                                                                SIN( RADIANS( CAST(latitude AS double precision) ) ) 
                                                            ) 
                                                ) AS distance
            FROM locations
                WHERE user_id IN (
                    SELECT id 
                    FROM users
                    WHERE verified = true 
                    AND role = 'driver'
                    AND id IN (
                        SELECT user_id 
                        FROM drivers 
                        WHERE online = true
                        AND approve = true
                        AND available = true
                    )
                )
            ) AS loc 
            where distance < $distance
            ORDER BY distance ASC
            LIMIT $limit";

        return DB::select(DB::raw($query));
    }
}
