<?php

namespace App\Events;

use App\Trip;
use Illuminate\Queue\SerializesModels;

class TripEnded
{
    use SerializesModels;

    public $trip;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }
}
