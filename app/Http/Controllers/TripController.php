<?php

namespace App\Http\Controllers;

use Auth;
use Status;
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
    	Auth::user()->client()->create([
    			'status_id'   => Status::where('name', 'request_taxi')->firstOrFail()->id,
    			'source'	  => setLocation($tripRequest->s_lat, $tripRequest->s_long)->id,
    			'destination' => setLocation($tripRequest->d_lat, $tripRequest->d_long)->id,
    			'eta'		  => 0,
    			'etd'		  => 0,
    		]);
    	return 1;
    }
}
