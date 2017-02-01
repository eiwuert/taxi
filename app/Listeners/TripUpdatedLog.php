<?php

namespace App\Listeners;

use App\Trip;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TripUpdatedLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TripUpdated  $event
     * @return void
     */
    public function handle(Trip $event)
    {
        //
    }
}
