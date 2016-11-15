<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Status;
use GoogleMaps;
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
    public function request(TripRequest $tripRequest)
    {
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
}
