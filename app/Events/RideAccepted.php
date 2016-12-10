<?php

namespace App\Events;

use App\Trip;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RideAccepted
{
    use InteractsWithSockets, SerializesModels;

    public $trip;
    public $type;
    public $currency;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Trip $trip, $type, $currency)
    {
        $this->trip = $trip;
        $this->type = $type;
        $this->currency = $currency;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('trip.' . $this->trip->id);
    }
}
