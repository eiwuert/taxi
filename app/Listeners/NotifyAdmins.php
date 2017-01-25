<?php

namespace App\Listeners;

use App\User;
use Notification;
use App\Events\UserRegistered;
use App\Repositories\SmsRepository;
use App\Notifications\ClientCreated;
use App\Notifications\DriverCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdmins
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $admins = User::whereRole('web')->get();
        $user = $event->user;
        if ($event->user->role == 'client') {
            Notification::send($admins, new ClientCreated($user));
        } else if ($event->user->role == 'driver') {
            Notification::send($admins, new DriverCreated($user));
        }
    }
}
