<?php

namespace App\Http\Controllers\Trip;

use App\Http\Requests\TripRequest;
use App\Http\Requests\NearbyRequest;
use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;

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
