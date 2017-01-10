<?php

namespace App\Listeners;

use DB;
use App\Car;
use App\User;
use App\Events\UserVerified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDriverCar
{
    /**
     * Handle the event.
     *
     * @param  UserVerified  $event
     * @return void
     */
    public function handle(UserVerified $event)
    {
        if ($event->user->role == 'driver') {
            Car::insert([
                    'number' => '000000',
                    'color' => 'pink',
                    'user_id' => $event->user->id,
                    'type_id' => 1,
                ]);
        }
    }
}
