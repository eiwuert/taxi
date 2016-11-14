<?php

namespace App\Http\Controllers;

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
/*    	dd();
    	dd(setLocation($tripRequest->s_lat, $tripRequest->s_long));
    	$name = GoogleMaps::load('geocoding')
		        ->setParamByKey('latlng', $tripRequest->s_lat . ',' . $tripRequest->s_long)
		        ->get('results.formatted_address')['results'][0]['formatted_address'];
		dd($tripRequest->s_lat);
    	$source = Location::create('');
    	return 1;*/
    }
}
