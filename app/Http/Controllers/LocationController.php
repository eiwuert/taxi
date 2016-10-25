<?php

namespace App\Http\Controllers;

use Auth;
use GoogleMaps;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest;

class LocationController extends Controller
{
	/**
	 * Set user location.
	 * @param  LocationRequest $request
	 * @return json
	 */
    public function set(LocationRequest $request, Location $location)
    {
    	$request['name'] = GoogleMaps::load('geocoding')
				               		 ->setParamByKey('latlng', $request['latitude'] . ',' . $request['longitude'])
				               		 ->get('results.formatted_address')['results'][0]['formatted_address'];
    	$request['user_id'] = Auth::user()->id;

    	$location = Auth::user()->locations()->create($request->all());

		return [$location];
    }

    /**
     * Get location for given id.
     * @param  Location $location
     * @return json
     */
    public function get(Location $location)
    {
    	return $location->get();
    }
}
