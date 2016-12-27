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
        $clientIds = Client::whereIn('user_id', User::wherePhone(Auth::user()->phone)
                                                ->whereVerified(true)
                                                ->where('role', 'client')
                                                ->get(['id']))->get(['id']);

        return ok($this->formatClientTrips(Trip::whereIn('client_id', $clientIds)->get()), 200, [], false);
    }

    /**
     * Get driver trip history
     * @return json
     */
    public function driver()
    {
        return ok($this->formatDriverTrips(Auth::user()->driver()->first()->trips()->get()), 200, [], false);
    }

    /**
     * Format driver trips.
     * @param  App\Trip $trips
     * @return array
     */
    private function formatDriverTrips($trips)
    {
        $trips->each(function($t) {
            $source = Location::whereId($t->source)->first();
            $destination = Location::whereId($t->destination)->first();
            $t->status_name = Status::whereValue($t->status_id)->first()->name;
            $t->source = $source->name;
            $t->s_lat  = $source->latitude;
            $t->s_long = $source->longitude;
            $t->destination = $destination->name;
            $t->d_lat  = $destination->latitude;
            $t->d_long = $destination->longitude;
            $t->driver_location = Location::whereId($t->driver_location)->first()->name;
            $t->transaction = Transaction::whereId($t->transaction_id)->get(['entry', 'distance', 'per_distance', 
                'distance_unit', 'distance_value', 'time', 'per_time', 'time_unit', 'time_value', 'surcharge', 'currency', 
                'timezone', 'total']);
            $t->rate = Rate::whereId($t->rate_id)->get(['driver', 'driver_comment']);

            unset($t->id, 
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
        $trips->each(function($t) {
            $source = Location::whereId($t->source)->first();
            $destination = Location::whereId($t->destination)->first();
            $t->status_name = Status::whereValue($t->status_id)->first()->name;
            $t->source = $source->name;
            $t->s_lat  = $source->latitude;
            $t->s_long = $source->longitude;
            $t->destination = $destination->name;
            $t->d_lat  = $destination->latitude;
            $t->d_long = $destination->longitude;
            $t->driver_location = Location::whereId($t->driver_location)->first()->name;
            $t->transaction = Transaction::whereId($t->transaction_id)->get(['entry', 'distance', 'per_distance', 
                'distance_unit', 'distance_value', 'time', 'per_time', 'time_unit', 'time_value', 'surcharge', 'currency', 
                'timezone', 'total']);
            $t->rate = Rate::whereId($t->rate_id)->get(['client', 'client_comment']);
            if (! is_null($t->driver_id)) {
                $driver = Driver::whereId($t->driver_id)->first();
                $car = Car::whereUserId($driver->user_id)->first();
                $carType = $car->type()->first();
                unset($car->id, 
                      $car->user_id, 
                      $car->type_id, 
                      $car->created_at, 
                      $car->updated_at);
                $t->driver = $driver;
                $t->driver->car = $car;
                $t->driver->car->type = $carType->name;
                $t->driver->phone = User::whereId($driver->user_id)->first()->phone;
            } else {
                $t->driver = [];
            }

            unset($t->id, 
                  $t->driver_id, 
                  $t->client_id, 
                  $t->updated_at, 
                  $t->transaction_id,
                  $t->rate_id);
        });

        return $trips;
    }
}
