<?php

namespace App\Repositories\Trip;

use Auth;
use App\Status;
use App\Client;
use App\Jobs\SendClientNotification;

class StartRepository
{
    /**
     * Start the trip.
     * @return boolean
     */
    public static function trip()
    {
        $driver = Auth::user()->driver()->first();
        $status = Status::whereName('driver_arrived')->firstOrFail()->value;
        $trip = $driver->trips()->whereIn('status_id', [$status])
                       ->orderBy('id', 'desc')->first();

        if (is_null($trip)) {
            return false;
        }

        if ($trip->status_id == 12) {
            $trip->updateStatusTo('trip_started');
            $deviceToken = Client::whereId($trip->client_id)->first()->device_token;
            dispatch(new SendClientNotification('trip_started', '6', $deviceToken));
            return true;
        } else {
            return false;
        }
    }
}