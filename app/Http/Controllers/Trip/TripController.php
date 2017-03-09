<?php

namespace App\Http\Controllers\Trip;

use App\Http\Requests\TripRequest;
use App\Http\Requests\NearbyRequest;
use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Http\Requests\MultiTripRequest;
use App\Repositories\Trip\CreateRepository as Create;

class TripController extends Controller
{
    /**
     * Request taxi
     *
     * Request taxi by client.
     * @param  App\Http\Requests\TripRequest $trip
     * @return json
     */
    public function requestTaxi(TripRequest $trip)
    {
        $result = Create::this($trip)->for('auth')->now();
        if (in_array('ok', $result)) {
            return ok([
                'content'          => 'Trip request created successfully.',
                'eta_text'         => $result['data']['matrix']['duration']['text'],
                'eta_value'        => $result['data']['matrix']['duration']['value'],
                'distance_text'    => $result['data']['matrix']['distance']['text'],
                'distance_value'   => $result['data']['matrix']['distance']['value'],
                'trip_status'      => 2,
                'source_name'      => $result['data']['source'],
                'destination_name' => $result['data']['destination'],
                'driver'           => $result['data']['driver'],
            ]);
        } else {
            switch ($result['fail']) {
                case 'no_driver':
                    return fail([
                        'title'       => 'No driver available',
                        'detail'      => 'There is no driver available in your area.',
                        'trip_status' => 5,
                    ], 404);
                    break;
                case 'location':
                    return fail([
                        'title'  => 'Not valid trip',
                        'detail' => 'You cannot trip there!'
                    ]);
                    break;
                case 'pending':
                    return fail([
                        'title' => 'You have pending request',
                        'detail'=> 'Please address your pending trip request at first',
                    ]);
                    break;
                default:
                    return fail([
                        'title' => 'failed',
                        'detail'=> 'failed to create trip.',
                    ]);
            }
        }
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
     * @param  App\Http\Requests\TripRequest $tripRequest
     * @return json
     */
    public function calculate(TripRequest $tripRequest)
    {
        return TripRepository::calculate($tripRequest);
    }
}
