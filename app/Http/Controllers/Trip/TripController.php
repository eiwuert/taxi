<?php

namespace App\Http\Controllers\Trip;

use App\Http\Requests\TripRequest;
use App\Http\Requests\NearbyRequest;
use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Http\Requests\MultiTripRequest;

class TripController extends Controller
{
    /**
     * Multi route request taxi.
     * @return json
     */
    public function multiRouteRequestTaxi(MultiTripRequest $request)
    {
        // Decode route parameter
        $route = json_decode($request->route);

        // Count of array shall be at least 2.
        if (TripRepository::minMultiTripLimit($route)) {
            return fail([
                    'title'  => 'Not enough arguments',
                    'detail' => 'Multi route `route` parameter needs at least 2 arguments.'
                ]);
        }

        // Count of array shall not exceed the LIMIT.
        if (TripRepository::maxMultiTripLimit($route)) {
            return fail([
                    'title'  => 'Too many arguments',
                    'detail' => 'Multi route `route` parameter must be at most 10 arguments.'
                ]);
        }

        /**
         * Validate route parameter
         */
        // First element shall be source latLng
        if(TripRepository::isSlatAndSlong($route[0])) {
            return fail([
                    'title'  => 'First element shall be source',
                    'detail' => 'First element of `route` parameter shall be source info: s_lat and s_long'
                ]);
        }

        // Rest of the element shall be destinations of latLongs
        if (! TripRepository::isDestinationsValid($route)) {
            return fail([
                    'title'  => 'Not valid destinations',
                    'detail' => '`route` elements except first one shall be objects of d_lat and d_long'
                ]);
        }

        // Validate route structure with preg_match
        if (TripRepository::validateWithPregMatch($route) == 'source') {
            return fail([
                'title'  => 'Source geo info is not valid',
                'detail' => 'source latLng information is not valid.',
            ]);
        } else if (is_integer($index = TripRepository::validateWithPregMatch($route))) {
            return fail([
                'title'  => 'Destination geo info is not valid',
                'detail' => 'destination latLng information is not valid on object: ' . ($index),
            ]);
        }

        // Not same values sequentially 
        if(is_array($items = TripRepository::notSameSequentially($route))) {
            return fail([
                'title'  => '2 destinations are same sequentially',
                'detail' => "destination $items[0] and destination $items[1] are same sequentially",
            ]);
        }

        // Validate LatLngs against Google Maps API
/*        if(is_array($items = TripRepository::validateListOfTripAgainstGoogleMaps($route))) {
            return fail([
                    'title'  => 'Not valid trip',
                    'detail' => "You cannot trip from ({$items[0]}, {$items[1]}) to ({$items[2]}, {$items[3]}).",
                ]);
        }*/

        // Create a multi route trip
        return TripRepository::createMultiRouteTrip($route);
    }

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
     * Cancel ride.
     * @return json
     */
    public function cancel()
    {
        return TripRepository::cancelTrip();
    }

    /**
     * Accept ride and go to the client.
     * @return json
     */
    public function accept()
    {
        if (TripRepository::accept()) {
            return ok([
                    'title'  => 'You are onway.',
                    'detail' => 'Trip status changed from 2 to 7',
                ]);
        } else {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'You have no trip to start',
                ]);
        }
    }

    /**
     * Start ride.
     * @return json
     */
    public function start()
    {
        if (TripRepository::start()) {
            return ok([
                    'title'  => 'Trip started.',
                    'detail' => 'Trip status changed from 12 to 6',
                ]);
        } else {
            return fail([
                    'title'  => 'Wait',
                    'detail' => 'You still do not have trip, please wait.'
                ]);
        }
    }

    /**
     * Current state of the trip.
     * @todo 
     * @return json
     */
    public function trip()
    {
        if ($trip = TripRepository::trip()) {
            return ok($trip);
        } else {
            return fail([
                    'title'  => 'Not on trip',
                    'detail' => 'Not on an active trip right now',
                ]);
        }
    }

    /**
     * End ride.
     * @return json
     */
    public function end()
    {
        if (TripRepository::end()) {
            return ok([
                    'title'  => 'Trip ended.',
                    'detail' => 'Trip status changed from 6 to 9, You can rate trip now.',
                ]);
        } else {
            return fail([
                    'title'  => 'Fail',
                    'detail' => 'You have no trip to end or you cannot end trip now.',
                ]);
        }
    }

    /**
     * Driver arrived to start point to start the trip.
     * @return json
     */
    public function arrived()
    {
        if (TripRepository::arrived()) {
            return ok([
                'title'  => 'Waiting for client.',
                'detail' => 'Trip status changed from 7 to 12.',
            ]);
        } else {
            return fail([
                'title'  => 'Fail',
                'detail' => 'You cannot got to this status from your current state',
            ]);
        }
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
