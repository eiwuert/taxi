<?php

namespace App\Http\Controllers\Trip;

use App\Http\Requests\TripRequest;
use App\Http\Requests\NearbyRequest;
use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Http\Requests\MultiTripRequest;
use App\Repositories\Trip\EndRepository as End;
use App\Repositories\Trip\StartRepository as Start;
use App\Repositories\Trip\NearbyRepository as Find;
use App\Repositories\Trip\AcceptRepository as Accept;
use App\Repositories\Trip\CreateRepository as Create;
use App\Repositories\Trip\CancelRepository as Cancel;
use App\Repositories\Trip\ArrivedRepository as Driver;
use App\Repositories\Trip\CurrentRepository as Current;

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
        $result = Create::this($trip)->forThis('auth')->now();
        if (in_array('ok', $result)) {
            return ok([
                'content'          => __('api/trip.Trip request created'),
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
                        'title'       => __('api/trip.No driver available'),
                        'detail'      => __('api/trip.There is no driver available in your area'),
                        'trip_status' => 5,
                    ], 404);
                    break;
                case 'location':
                    return fail([
                        'title'  => __('api/trip.Not valid trip'),
                        'detail' => __('api/trip.You cannot trip there!'),
                    ]);
                    break;
                case 'pending':
                    return fail([
                        'title' => __('api/trip.You have pending request'),
                        'detail'=> __('api/trip.Please address your pending trip request at first'),
                    ]);
                    break;
                default:
                    return fail([
                        'title' => __('api/trip.failed'),
                        'detail'=> __('api/trip.failed to create trip'),
                    ]);
            }
        }
    }

    /**
     * Show nearby taxi to client.
     * @param  \App\Http\Requests\NearbyRequest $point
     * @return json
     */
    public function nearbyTaxi(NearbyRequest $point)
    {
        return ok(Find::nearby($point), 200, [], false);
    }

    /**
     * Cancel ride.
     * @return json
     */
    public function cancel()
    {
        $result = Cancel::trip();
        if (in_array('ok', $result)) {
            return ok([
                'title'  => __('api/trip.Trip cancelled'),
                'detail' => __('api/trip.Trip cancelled successfully'),
            ]);
        } else {
            return fail([
                'title'  => __('api/trip.You cannot do this'),
                'detail' => __('api/trip.You cannot cancel your ride on this status'),
            ]);
        }
    }

    /**
     * Accept ride and go to the client.
     * @return json
     */
    public function accept()
    {
        if (Accept::trip()) {
            return ok([
                    'title'  => __('api/trip.You are onway'),
                    'detail' => __('api/trip.Trip accepted'),
                ]);
        } else {
            return fail([
                    'title'  => __('api/trip.Failed'),
                    'detail' => __('api/trip.You have no trip to accept'),
                ]);
        }
    }

    /**
     * Start ride.
     * @return json
     */
    public function start()
    {
        if (Start::trip()) {
            return ok([
                'title'  => __('api/trip.Trip started'),
                'detail' => __('api/trip.Trip started'),
            ]);
        } else {
            return fail([
                'title'  => __('api/trip.Failed'),
                'detail' => __('api/trip.You have no trip to start'),
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
        return ok(Current::trip());
    }

    /**
     * End ride.
     * @return json
     */
    public function end()
    {
        $result = End::trip();
        if (in_array('ok', $result)) {
            return ok([
                'title'  => __('api/trip.Trip ended'),
                'detail' => __('api/trip.Trip ended'),
            ]);
        } else {
            switch ($result['fail']) {
                case 'not_started':
                    return fail([
                        'title'  => __('api/trip.Failed'),
                        'detail' => __('api/trip.You have no trip to end'),
                    ]);
                    break;
                default:
                    return fail([
                        'title'  => __('api/trip.Trip is not paid'),
                        'detail' => __('api/trip.Please ask the client to choose a payment method')
                    ]);
                    break;
            }
        }
    }

    /**
     * Driver arrived to start point to start the trip.
     * @return json
     */
    public function arrived()
    {
        if (Driver::arrived()) {
            return ok([
                'title'  => __('api/trip.Arrived'),
                'detail' => __('api/trip.You have arrived'),
            ]);
        } else {
            return fail([
                'title'  => __('api/trip.Failed'),
                'detail' => __('api/trip.You have no trip to be arrived'),
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
