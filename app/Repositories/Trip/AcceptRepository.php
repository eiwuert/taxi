<?php

namespace App\Repositories\Trip;

use Auth;
use App\Client;
use App\Status;
use App\Jobs\SendClientNotification;

class AcceptRepository
{
    public static function trip()
    {
        $driver = Auth::user()->driver()->first();
        $status = Status::value('client_found');
        $trip = $driver->trips()
                       ->whereIn('status_id', [$status])
                       ->orderBy('id', 'desc')->first();

        if (is_null($trip)) {
            return false;
        }

        if ($trip->status_id == $status) {
            $trip->updateStatusTo('driver_onway');
            $driver->updateDriverAvailability(false);
            $deviceToken = Client::whereId($trip->client_id)->first()->device_token;
            dispatch(new SendClientNotification('driver_onway', '5', $deviceToken));
            return true;
        } else {
            return false;
        }
    }
}
