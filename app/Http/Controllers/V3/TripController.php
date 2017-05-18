<?php

namespace App\Http\Controllers\V3;

use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Http\Requests\API\V2\TripRequest;
use App\Http\Requests\API\V2\NearbyRequest;
use App\Repositories\Trip\NearbyRepository as Find;
use App\Repositories\Trip\CreateRepository as Create;

class TripController extends Controller
{
    /**
     * Show nearby taxi to client.
     * @param  \App\Http\Requests\NearbyRequest $point
     * @return json
     */
    public function nearbyTaxi(NearbyRequest $point)
    {
        return ok(Find::nearbyCategorizedByCarType($point), 200, [], false);
    }

    /**
     * Calculate distance and cost between 2 point.
     * @param App\Http\Requests\TripRequest $tripRequest
     * @return json
     */
    public function calculate(TripRequest $tripRequest)
    {
        return TripRepository::calculateV3($tripRequest);
    }
}
