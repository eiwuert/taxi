<?php

namespace App\Listeners;

use DB;
use App\Rate;
use Carbon\Carbon;
use App\Events\TripEnded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RateTrip
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  TripEnded  $event
     * @return void
     */
    public function handle(TripEnded $event)
    {
        if (is_null(Rate::whereTripId($event->trip->id)->first())) {
            DB::table('trips')->whereId($event->trip->id)
                ->update([
                        'rate_id' => DB::table('rates')->insertGetId([
                                        'trip_id'     => $event->trip->id,
                                        'created_at'  => Carbon::now(),
                                        'updated_at'  => Carbon::now(),
                                    ]),
                        ]);
        }
    }
}
