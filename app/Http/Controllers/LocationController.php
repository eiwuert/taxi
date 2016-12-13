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
    public function set(LocationRequest $request)
    {
        return ok([setLocation($request->lat, $request->long, 'TEST')]);
    }

    /**
     * Get location for given id.
     * @param  Location $location
     * @return json
     */
    public function get(Location $location)
    {
    	return ok([$location->get()]);
    }
}
