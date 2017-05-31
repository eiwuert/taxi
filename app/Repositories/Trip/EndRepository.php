<?php

namespace App\Repositories\Trip;

use App\Client;
use App\Events\TripEnded;
use App\Jobs\SendClientNotification;
use App\Payment;
use App\Status;
use Auth;

class EndRepository
{
    /**
     * End trip.
     * @return array
     */
    public static function trip()
    {
        $driver = Auth::user()->driver()->first();
        $status = Status::value('trip_started');
        $trip = $driver->trips()
                       ->whereIn('status_id', [$status])
                       ->orderBy('id', 'desc')->first();

        if (is_null($trip)) {
            return ['fail' => 'not_started'];
        }


        if ($trip->status_id == $status) {
            if (! $trip->payments()->paid()->exists()) {
                Payment::forceCreate([
                    'trip_id' => $trip->id,
                    'client_id' => $trip->client->id,
                    'paid' => true,
                    'type' => 'cash',
                    'ref'  => '00000',
                ]);
            }
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
