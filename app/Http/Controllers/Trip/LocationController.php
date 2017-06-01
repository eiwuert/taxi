<?php

namespace App\Http\Controllers\Trip;

use Auth;
use GoogleMaps;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Repositories\LocationRepository;

class LocationController extends Controller
{
    /**
     * Set user location.
     * @param  LocationRequest $request
     * @return json
     */
    public function set(LocationRequest $request)
    {
        if (Auth::user()->role == 'driver') {
            Auth::user()->driver->first()->forceFill([
                'latitude'  => $request->lat,
                'longitude' => $request->long,
            ])->save();
        }
        return ok(LocationRepository::set($request->lat, $request->long, null, 'TEST'));
    }
}
