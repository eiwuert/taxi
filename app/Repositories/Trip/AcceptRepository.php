<?php

namespace App\Repositories\Trip;

use Auth;

class AcceptRepository
{
    public static function trip()
    {
        $driver = Auth::user()->driver()->first();
        $status = Status::whereName('client_found')->firstOrFail()->value;
        $trip = $driver->trips()
                       ->whereIn('status_id', $status)
                       ->orderBy('id', 'desc')->first();

        if (is_null($trip)) {
            return false;
        }

        if ($trip->status_id == 2) {
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
