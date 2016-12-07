<?php

namespace App\Listeners;

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
        $event->trip->rate()->create([]);
    }
}
