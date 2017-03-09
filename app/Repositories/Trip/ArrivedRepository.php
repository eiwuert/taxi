<?php

namespace App\Repositories\Trip;

use Auth;
use App\Client;
use App\Jobs\SendClientNotification;

class ArrivedRepository
{
    /**
     * Make driver as arrived driver.
     * @return boolean
     */
    public static function arrived()
    {
        $driver = Auth::user()->driver()->first();
        $status = Status::whereName('driver_onway')->firstOrFail()->value;
        $trip = $driver->trips()
                       ->whereIn('status_id', $status)
                       ->orderBy('id', 'desc')->first();

        if (is_null($trip)) {
            return false;
        }

        if ($trip->status_id == 7) {
            $trip->updateStatusTo('driver_arrived');
            $deviceToken = Client::whereId($trip->client_id)->first()->device_token;
            dispatch(new SendClientNotification('driver_arrived', '8', $deviceToken));
            return true;
        } else {
            return false;
        }
    }
}
