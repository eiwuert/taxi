<?php

namespace App\Events;

use DB;
use Log;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class TripUpdated
{
    use Dispatchable, SerializesModels;

    public $trip;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Trip $trip)
    {
        $result = DB::table('trip_logs')->insert([
                    'client_id'       => $trip->client_id,
                    'driver_id'       => $trip->driver_id,
                    'trip_id'         => $trip->id,
                    'status_id'       => $trip->status_id,
                    'driver_location' => $trip->driver_location,
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now(),
                ]);
        Log::debug('Trip updated.');
    }
}
