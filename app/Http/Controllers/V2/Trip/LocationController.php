<?php

namespace App\Http\Controllers\V2\Trip;

use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;
use App\Http\Requests\API\V2\LocationRequest;

class LocationController extends Controller
{
    /**
     * Set user location.
     * @param  App\Http\Requests\LocationRequest $request
     * @return json
     */
    public function set(LocationRequest $request)
    {
        // Why TEST? Google Maps API has 5,000 requests per day limitation.
        return ok(LocationRepository::set($request->lat, $request->lng, null, 'TEST'));
    }
}
