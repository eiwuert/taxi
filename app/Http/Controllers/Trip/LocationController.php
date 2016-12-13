<?php

namespace App\Http\Controllers\Trip;

use Auth;
use GoogleMaps;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
