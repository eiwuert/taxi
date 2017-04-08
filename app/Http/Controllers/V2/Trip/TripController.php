<?php

namespace App\Http\Controllers\V2\Trip;

use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Http\Requests\API\V2\TripRequest;
use App\Http\Requests\API\V2\NearbyRequest;
use App\Repositories\Trip\NearbyRepository as Find;
use App\Repositories\Trip\CreateRepository as Create;

class TripController extends Controller
{
    /**
     * Request taxi
     *
     * Request taxi by client.
     * @param App\Http\Requests\TripRequest $trip
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
                        'title'  => __('api/trip.Not a valid trip'),
                        'detail' => __('api/trip.You cannot trip there!'),
                    ]);
                    break;
                case 'pending':
                    return fail([
                        'title' => __('api/trip.You have pending request'),
                        'detail'=> __('api/trip.Please address your pending trip request'),
                    ]);
                    break;
                default:
                    return fail([
                        'title' => __('api/trip.failed'),
                        'detail'=> __('api/trip.failed to create trip'),
                    ]);
                    break;
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
     * Calculate distance and cost between 2 point.
     * @param App\Http\Requests\TripRequest $tripRequest
     * @return json
     */
    public function calculate(TripRequest $tripRequest)
    {
        return TripRepository::calculate($tripRequest);
    }
}
