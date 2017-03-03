<?php

namespace App\Events;

use App\Trip;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TripInitiated
{
    use InteractsWithSockets, SerializesModels;

    public $trip;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Trip $trip, $request)
    {
        $this->trip = $trip;
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        $channels = [];
        foreach(User::whereRole('web')->get() as $admin) {
            $channels[] = new PrivateChannel('App.User.' . $admin->id);
        }
        return $channels;
    }
}
