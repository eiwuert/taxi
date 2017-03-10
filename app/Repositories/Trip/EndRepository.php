<?php

namespace App\Repositories\Trip;

use Auth;
use App\Status;
use App\Client;
use App\Events\TripEnded;
use App\Jobs\SendClientNotification;

class EndRepository
{
    /**
     * End trip.
     * @return array
     */
    public static function trip()
    {
        $driver = Auth::user()->driver()->first();
        $status = Status::whereName('trip_started')->firstOrFail()->value;
        $trip = $driver->trips()
                       ->whereIn('status_id', [$status])
                       ->orderBy('id', 'desc')->first();

        if (is_null($trip)) {
            return ['fail' => 'not_started'];
        }

        if (! $trip->payments()->paid()->exists()) {
            return ['fail' => 'not_paid'];
        }

        if ($trip->status_id == 6) {
            $trip->updateStatusTo('trip_ended');
            $deviceToken = Client::whereId($trip->client_id)->first()->device_token;
            dispatch(new SendClientNotification('trip_ended', '7', $deviceToken));
            event(new TripEnded($trip));
            return ['ok'];
        } else {
            return ['fail' => 'not_started'];
        }
    }
}
