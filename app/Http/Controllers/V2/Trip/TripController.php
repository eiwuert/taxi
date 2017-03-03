<?php

namespace App\Http\Controllers\V2\Trip;

use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Http\Requests\API\V2\TripRequest;
use App\Http\Requests\API\V2\NearbyRequest;
use App\Repositories\Trip\CreateRepository as Create;

class TripController extends Controller
{
    /**
     * Request taxi
     *
     * Request taxi by client.
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
                    break;
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
     * Calculate distance and cost between 2 point.
     * @return json
     */
    public function calculate(TripRequest $tripRequest)
    {
        return TripRepository::calculate($tripRequest);
    }
}
