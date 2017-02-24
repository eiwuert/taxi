<?php

namespace App\Repositories\Trip;

use App\Client;
use App\Repositories\Trip\UserRepository;

class ClientRepository extends UserRepository {
    /**
     * Get client of this trip.
     * @param  \App\Trip $trip
     * @return array
     */
    public static function this($trip)
    {
        $client = Client::whereId($trip->client_id);
        if (static::$obj) {
            return $client->first();
        } else {
            $client = $client->first(Client::$info);
            $client->phone = $client->phone();
            unset($client->user_id);
            return [
                'client' => $client,
            ];
        }
    }
}