<?php

namespace App\Http\Controllers\V2\Trip;

use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Http\Requests\API\V2\TripRequest;
use App\Http\Requests\API\V2\NearbyRequest;

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
        return TripRepository::requestTaxi($tripRequest->all());
    }

    /**
     * Show nearby taxi to client.
     * @param  \App\Http\Requests\NearbyRequest $request
     * @return json
     */
    public function nearbyTaxi(NearbyRequest $request)
    {
        return ok(TripRepository::nearby($request), 200, [], false);
    }

    /**
     * Calculate distance and cost between 2 point.
     * @return json
     */
    public function calculate(TripRequest $tripRequest)
    {
        return TripRepository::calculate($tripRequest);
    }
}
