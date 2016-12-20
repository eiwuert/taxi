<?php

namespace App\Http\Controllers\Trip;

use Auth;
use App\Rate;
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
        //
    }

    /**
     * Get driver trip history
     * @return json
     */
    public function driver()
    {
        return ok($this->formatDriverTrips(Auth::user()->driver()->first()->trips()->get()));
    }

    /**
     * Format driver trips.
     * @param  App\Trip $trips
     * @return array
     */
    private function formatDriverTrips($trips)
    {
        $trips->each(function($t) {
            $t->status_name = Status::whereValue($t->status_id)->first()->name;
            $t->source = Location::whereId($t->source)->first()->name;
            $t->destination = Location::whereId($t->destination)->first()->name;
            $t->driver_location = Location::whereId($t->driver_location)->first()->name;
            $t->transaction = Transaction::whereId($t->transaction_id)->get(['entry', 'distance', 'per_distance', 
                'distance_unit', 'distance_value', 'time', 'per_time', 'time_unit', 'time_value', 'surcharge', 'currency', 
                'timezone', 'total']);
            $t->rate = Rate::whereId($t->rate_id)->get(['driver', 'driver_comment']);
            
            unset($t->id, 
                  $t->driver_id, 
                  $t->client_id, 
                  $t->created_at, 
                  $t->updated_at, 
                  $t->transaction_id,
                  $t->rate_id);
        });

        return $trips;
    }
}
