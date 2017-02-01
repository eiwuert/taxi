<?php

namespace App\Listeners;

use Log;
use App\Trip;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TripCreatedLog
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
     * @param  Trip  $event
     * @return void
     */
    public function handle(Trip $event)
    {
        Log::info($event);
    }
}
