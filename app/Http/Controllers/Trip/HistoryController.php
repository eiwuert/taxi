<?php

namespace App\Http\Controllers\Trip;

use Auth;
use App\Car;
use App\User;
use App\Rate;
use App\Trip;
use App\Client;
use App\Driver;
use App\Status;
use App\Location;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    /**
     * Get client trip history.
     * @return json
     */
    public function client()
    {
        return ok($this->formatClientTrips(Auth::user()->client()->first()
                                            ->trips()->whereIn('status_id', ['9', '15', '16', '17'])
                                            ->orderBy('id', 'desc')
                                            ->get()), 200, [], false);
    }

    /**
     * Get driver trip history
     * @return json
     */
    public function driver()
    {
        return ok($this->formatDriverTrips(Auth::user()->driver()->first()
                                            ->trips()->whereIn('status_id', ['9', '15', '16', '17'])
                                            ->orderBy('id', 'desc')
                                            ->get()), 200, [], false);
    }

    /**
     * Format driver trips.
     * @param  App\Trip $trips
     * @return array
     */
    private function formatDriverTrips($trips)
    {
        $trips->each(function ($t) {
            $source = Location::whereId($t->source)->first();
            $destination = Location::whereId($t->destination)->first();
            $t->status_name = Status::whereValue($t->status_id)->first()->name;
            $t->source = $source->name;
            $t->s_lat  = $source->latitude;
            $t->s_long = $source->longitude;
            $t->destination = $destination->name;
            $t->d_lat  = $destination->latitude;
            $t->d_long = $destination->longitude;
            $t->driver_location = Location::whereId($t->driver_location)->first();
            $t->transaction = $t->transaction;
            $t->rate = $t->rate;

            unset($t->id,
                  $t->next,
                  $t->prev,
                  $t->driver_id,
                  $t->client_id,
                  $t->updated_at,
                  $t->transaction_id,
                  $t->rate_id);
        });

        return $trips;
    }

    /**
     * Format client trips.
     * @param  App\Trip $trips
     * @return array
     */
    private function formatClientTrips($trips)
    {
        $history = [];
        foreach ($trips as $t) {
            $source = Location::whereId($t->source)->first();
            $destination = Location::whereId($t->destination)->first();
            $hist['id'] = $t->id;
            $hist['status_name'] = Status::whereValue($t->status_id)->first()->name;
            $hist['source'] = $source->name;
            $hist['s_lat']  = $source->latitude;
            $hist['s_long'] = $source->longitude;
            $hist['destination'] = $destination->name;
            $hist['d_lat']  = $destination->latitude;
            $hist['d_long'] = $destination->longitude;
            $driverLocation = Location::whereId($t->driver_location)->first();
            if (! is_null($driverLocation)) {
                $hist['driver_location'] = [[
                                        'name' => $driverLocation->name,
                                        'lat' => $driverLocation->latitude,
                                        'long' => $driverLocation->longitude
                                    ]];
            }
            $transaction = $t->transaction;
            if (!is_null($transaction)) {
                $hist['transaction'] = [ $transaction ];
            } else {
                $hist['transaction'] = [];
            }
            $rate = $t->rate;
            if (!is_null($rate)) {
                $hist['rate'] = [[
                                'client' => $rate->client,
                                'client_comment' => $rate->client_comment,
                            ]];
            } else {
                $hist['rate'] = [];
            }
            if (! is_null($t->driver_id)) {
                $driver = Driver::whereId($t->driver_id)->first();
                $car = Car::whereUserId($driver->user_id)->first();
                $carType = $car->type()->first();
                unset($car->id,
                      $car->user_id,
                      $car->type_id,
                      $car->created_at,
                      $car->updated_at);
                $histDriver = [];
                $histDriver['driver'] = $driver;
                $histDriver['driver']['car'] = $car;
                $histDriver['driver']['car']['type'] = $carType->name;
                $histDriver['driver']['phone'] = User::whereId($driver->user_id)->first()->phone;
                $hist['driver'] = [$histDriver['driver']];
            } else {
                $hist['driver'] = [];
            }

            $history[] = $hist;
        }

        return $history;
    }
}
