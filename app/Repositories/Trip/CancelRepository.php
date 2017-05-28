<?php

namespace App\Repositories\Trip;

use Auth;
use App\Client;
use App\Driver;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;
use App\Repositories\Trip\CreateRepository as Create;
use App\Repositories\Trip\MainRepository as DriversTo;

class CancelRepository
{
    /**
     * Cancel method.
     * @return array
     */
    public static function trip()
    {
        if (Auth::user()->role == 'client') {
            $client = Auth::user()->client()->first();
            $trip   = $client->trips()->orderBy('id', 'desc')->first();

            /**
             * In case of a client call the cancel API when he/she does not even
             * own a trip, so we just return an error.
             */
            if (is_null($trip)) {
                return ['fail' => 'came_early'];
            }

            if (! is_null($trip->driver_id)) {
                $driver = Driver::whereId($trip->driver_id)->first();
            }

            if (! is_null($trip->status_id)) {
                $status = $trip->status_id;
            } else {
                $status = 0;
            }

            /**
             * Cancel by CLIENT
             */
            switch ($status) {
                // REQUEST_TAXI
                case '1':
                    $trip->updateStatusTo('cancel_request_taxi');
                    return ['ok'];
                    break;
                // NO_RESPONSE
                // REJECT_CLIENT_FOUND
                case '3':
                case '4':
                    $trip->updateStatusTo('cancel_request_taxi');
                    $driver->updateDriverAvailability(true);
                    return ['ok'];
                    break;
                // CLIENT_FOUND
                case '2':
                    $trip->updateStatusTo('cancel_request_taxi');
                    $driver->updateDriverAvailability(true);
                    $deviceToken = Driver::whereId($trip->driver_id)->first()->device_token;
                    dispatch(new SendDriverNotification('trip_cancelled_by_client', '1', $deviceToken));
                    return ['ok'];
                    break;
                // DRIVER_ONWAY
                case '7':
                    $trip->updateStatusTo('cancel_onway_driver');
                    $driver->updateDriverAvailability(true);
                    $deviceToken = Driver::whereId($trip->driver_id)->first()->device_token;
                    dispatch(new SendDriverNotification('client_cancelled_onway_driver', '2', $deviceToken));
                    return ['ok'];
                    break;
                // DRIVER_ARRIVED
                case '12':
                    $trip->updateStatusTo('client_canceled_arrived_driver');
                    $driver->updateDriverAvailability(true);
                    $deviceToken = Driver::whereId($trip->driver_id)->first()->device_token;
                    dispatch(new SendDriverNotification('client_canceled_arrived_driver', '3', $deviceToken));
                    return ['ok'];
                    break;
                // CANCEL FAIL
                default:
                    return ['fail' => 'came_early'];
                    break;
            }
        } elseif (Auth::user()->role == 'driver') {
            $driver = Auth::user()->driver()->first();
            $trip   = $driver->trips()->orderBy('id', 'desc')->first();

            if (! is_null($trip)) {
                $status = $trip->status_id;
            } else {
                $status = 0;
            }

            // Cancel by DRIVER
            switch ($status) {
                // TRIP_STARTED
                case '6':
                    $trip->updateStatusTo('driver_reject_started_trip');
                    $driver->updateDriverAvailability(true);
                    $deviceToken = Client::whereId($trip->client_id)->first()->device_token;
                    dispatch(new SendClientNotification('started_trip_cancelled_by_driver', '2', $deviceToken));
                    return ['ok'];
                    break;
                // DRIVER_ONWAY
                // TO arrive and ON TIRP
                // @todo: these 2 status shall be separated and have their own cases.
                case '7':
                    $trip->updateStatusTo('cancel_onway_driver');
                    $driver->updateDriverAvailability(true);
                    $deviceToken = Client::whereId($trip->client_id)->first()->device_token;
                    dispatch(new SendClientNotification('arrived_driver_cancelled_trip', '4', $deviceToken));
                    dispatch(new SendClientNotification('new_clinet_cancelled_by_driver', '3', $deviceToken));
                    return ['ok'];
                    break;
                // CLIENT_FOUND
                case '2':
                    $trip->updateStatusTo('reject_client_found');
                    $driver->updateDriverAvailability(true);
                    $deviceToken = Client::whereId($trip->client_id)->first()->device_token;
                    dispatch(new SendClientNotification('new_clinet_cancelled_by_driver', '3', $deviceToken));
                    // Request new taxi
                    $tripRequest = [
                            's_lat'  => $trip->source()->first()->latitude,
                            's_long' => $trip->source()->first()->longitude,
                            'd_lat'  => $trip->destination()->first()->latitude,
                            'd_long' => $trip->destination()->first()->longitude,
                            'type'   => $trip->driver->user->car->type->id,
                        ];
                    $exclude = DriversTo::exclude($trip->client_id);
                    if ($exclude['count'] < 10) {
                        Create::this($tripRequest)->forThis(Client::find($trip->client_id)->user->id)->exclude($exclude['result'])->now();
                    } else {
                        $trip->updateStatusTo('no_driver');
                        dispatch(new SendClientNotification('no_driver_found', '1', $deviceToken));
                    }
                    return ['ok'];
                    break;
                // DRIVER_ARRIVED
                case '12':
                    $trip->updateStatusTo('driver_cancel_arrived_status');
                    $driver->updateDriverAvailability(true);
                    $deviceToken = Client::whereId($trip->client_id)->first()->device_token;
                    dispatch(new SendClientNotification('arrived_driver_cancelled_trip', '4', $deviceToken));
                    return ['ok'];
                    break;
                // CANCEL FAIL
                default:
                    return ['fail' => 'came_early'];
                    break;
            }
        } else {
            return ['fail' => 'came_early'];
        }
    }
}
