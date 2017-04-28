<?php

namespace App\Listeners;

use DB;
use App\Car;
use App\User;
use App\Driver;
use App\Events\UserVerified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MultiRecordDriver
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
            DB::table('locations')
                ->whereIn('user_id', User::where('phone', $event->user->phone)
                                        ->whereVerified(true)
                                        ->where('role', 'driver')
                                        ->get(['id'])->flatten())
                ->update(['user_id' => $event->user->id]);

            $updated = Car::whereIn('user_id', User::where('phone', $event->user->phone)
                                                ->whereVerified(true)
                                                ->where('role', 'driver')
                                                ->get(['id'])->flatten())
                        ->update(['user_id' => $event->user->id]);

            if (! $updated) {
                Car::insert([
                    'number' => '000000',
                    'color' => 'pink',
                    'user_id' => $event->user->id,
                    'type_id' => 1,
                ]);
            }

            DB::table('drivers')
                ->whereIn('user_id', User::where('phone', $event->user->phone)
                                        ->whereVerified(true)
                                        ->where('role', 'driver')
                                        ->get(['id'])->flatten())
                ->update(['user_id' => $event->user->id, 'device_token' => Driver::whereUserId($event->user->id)->first()->device_token]);

            $count = DB::table('drivers')
                         ->where('user_id', $event->user->id)->count();

            while ($count > 1) {
                DB::table('drivers')
                    ->where('id', DB::table('drivers')
                                    ->where('user_id', $event->user->id)
                                    ->orderBy('id', 'desc')
                                    ->first()->id)
                    ->delete();

                $count -= 1;
            }

            // User::where('phone', $event->user->phone)
            //     ->where('role', 'driver')
            //     ->each(function ($u) use (& $event) {
            //         if (!is_null($u->driver->first())) {
            //             if ($u->driver->first()->user_id != $event->user->id) {
            //                 $u->driver->first()->delete();
            //             }
            //         }
            //     });
        }
    }
}
