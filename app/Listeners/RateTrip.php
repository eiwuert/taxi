<?php

namespace App\Listeners;

use DB;
use App\Rate;
use App\Trip;
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
            $trip = Trip::find($event->trip->id);
            $rate = $trip->rate()->save(new Rate());
        }
    }
}
