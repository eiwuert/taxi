<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Trip;
use App\Status;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Requests\TripRequest;

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
    	if ($pending = $this->pendingRequestTaxi()) 
    		return $pending;

    	$matrix = getDistanceMatrix($tripRequest->all());
    	$source = setLocation($tripRequest->s_lat, $tripRequest->s_long);
    	$destination = setLocation($tripRequest->d_lat, $tripRequest->d_long);

    	$result = DB::table('trips')->insert([
						'client_id'   	  => Auth::user()->client()->first()->id,
						'status_id'       => Status::where('name', 'request_taxi')->firstOrFail()->id,
						'source'	  	  => $source->id,
						'destination'     => $destination->id,
						'eta_text'		  => $matrix['duration']['text'],
						'eta_value'		  => $matrix['duration']['value'],
						'distance_text'	  => $matrix['distance']['text'],
						'distance_value'  => $matrix['distance']['value'],
    				]);

    	if ($result) {
    		return ok([
    					'content' 	       => 'Trip requested successfuly.',
    					'eta_text'	       => $matrix['duration']['text'],
						'eta_value'	       => $matrix['duration']['value'],
						'distance_text'	   => $matrix['distance']['text'],
						'distance_value'   => $matrix['distance']['value'],
						'trip_status'	   => 1,
						'source_name'	   => $source->name,
						'destination_name' => $destination->name,
    				]);
    	} else {
    		return fail([
    				'title' => 'There was problem requesting trip',
    				'detail'=> 'There was some problem with inserting new trip to DB'
    			]);
    	}
    }

    /**
     * Check pending request for current client that is requesting a new taxi.
     * @return json
     */
    private function pendingRequestTaxi()
    {
    	$pending = Auth::user()->client()->first()->trips()
    		   				  ->where('status_id', Status::where('name', 'request_taxi')->firstOrFail()->id);

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
