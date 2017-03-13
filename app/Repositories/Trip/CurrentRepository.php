<?php

namespace App\Repositories\Trip;

use Auth;
use App\Car;
use App\Status;
use App\Driver;
use App\Client;
use App\Location;
use App\Repositories\Trip\MainRepository as Main;

class CurrentRepository extends Main
{
    /**
     * Return the trip.
     * @return array
     */
    public static function trip()
    {
        if (Main::role() == 'client') {
            return self::clientTrip();
        } elseif (Main::role() == 'driver') {
            return self::driverTrip();
        }
    }

    /**
     * Show current trip of the driver.
     * @return array
     */
    private static function driverTrip()
    {
        $driver = Auth::user()->driver()->first();
        $trip = $driver->trips()->orderBy('id', 'desc')->first();
        $paid = $trip->payments()->paid()->exists();
        $transaction = $trip->transaction()->first();
        if(is_null($transaction)) {
            $total = 0;
        } else {
            $total = $transaction->total;
        }
        $client = Client::whereId($trip->client_id)->first(['first_name', 'last_name', 'gender', 'picture', 'user_id']);
        $client->phone = $client->user->phone;
        $source = $trip->source()->first(['latitude', 'longitude', 'name']);
        $destination = $trip->destination()->first(['latitude', 'longitude', 'name']);
        $status = Status::whereValue($trip->status_id)->first(['name', 'value']);
        $paid = $trip->payments()->paid()->exists();
        $payment = is_null($payment = $trip->payments()->paid()->first())?'to select':$payment->type;
        unset($client->user_id, $trip->id, $trip->next, $trip->prev, $trip->client_id, $trip->driver_id,
              $trip->status_id, $trip->source, $trip->destination, $trip->created_at, $trip->updated_at,
              $trip->transaction_id, $trip->rate_id, $trip->driver_location, $client->user);
        return [
            'paid'        => $paid,
            'payment'     => $payment,
            'client'      => $client,
            'trip'        => $trip,
            'status'      => $status,
            'source'      => $source,
            'destination' => $destination,
            'total'       => $total,
        ];
    }

    /**
     * Show current trip of the client.
     * @return array
     */
    private static function clientTrip()
    {
        $client = Auth::user()->client()->first();
        $trip = $client->trips()->orderBy('id', 'desc')->first();
        $driver = Driver::where('id', $trip->driver_id)->first(['first_name', 'last_name', 'email', 'gender', 'picture', 'user_id']);
        if (is_null($driver)) {
            return false;
        }
        $driver->phone = $driver->user->phone;
        $car = Car::whereUserId($driver->user_id)->first(['number', 'color', 'type_id']);
        $carType = $car->type()->first(['name']);
        $source = $trip->source()->first(['latitude', 'longitude', 'name']);
        $destination = $trip->destination()->first(['latitude', 'longitude', 'name']);
        $status = Status::whereValue($trip->status_id)->first(['name', 'value']);
        $driverLocation = Location::whereUserId($trip->driver()->first()->user_id)
                                    ->orderBy('id', 'desc')
                                    ->first(['latitude', 'longitude', 'name']);
        $paid = $trip->payments()->paid()->exists();
        $payment = is_null($payment = $trip->payments()->paid()->first()) ? 'to select' : $payment->type;
        unset($driver->user_id, $trip->next, $trip->prev, $trip->client_id, $trip->driver_id, $trip->status_id,
              $trip->source, $trip->destination, $trip->created_at, $trip->updated_at, $trip->transaction_id,
              $trip->rate_id, $trip->driver_location, $driver->user);

        return [
            'paid'            => $paid,
            'payment'         => $payment,
            'driver'          => $driver,
            'trip'            => $trip,
            'status'          => $status,
            'car'             => $car,
            'type'            => $carType,
            'source'          => $source,
            'destination'     => $destination,
            'driver_location' => $driverLocation,
            'total'           => $trip->transaction()->first()->total,
        ];
    }
}
