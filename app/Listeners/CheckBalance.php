<?php

namespace App\Listeners;

use App\Payment;
use App\Events\TripInitiated;
use App\Jobs\SendClientNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckBalance
{
    /**
     * Handle the event.
     *
     * @param  TripInitiated  $event
     * @return void
     */
    public function handle(TripInitiated $event)
    {
        if ($event->request['payment'] == 'cash') {
            Payment::forceCreate([
                'trip_id' => $event->trip->id,
                'client_id' => $event->trip->client->id,
                'paid' => false,
                'type' => 'cash',
                'ref'  => '0000',
            ]);
        } elseif ($event->request['payment'] == 'wallet') {
            if ($event->trip->client->balance > $event->trip->transaction->total) {
                $event->trip->client->updateBalance((int)$event->trip->transaction->total * (-1));
            } else {
                dispatch(new SendClientNotification('switched_to_cash', '12', $event->trip->client->device_token));
                Payment::forceCreate([
                    'trip_id' => $event->trip->id,
                    'client_id' => $event->trip->client->id,
                    'paid' => false,
                    'type' => 'cash',
                    'ref'  => '0000',
                ]);
            }
        }
    }
}
