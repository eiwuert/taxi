<?php

namespace App\Listeners;

use DB;
use App\User;
use App\Events\UserVerified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MultiRecordDriver
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
     * @param  UserVerified  $event
     * @return void
     */
    public function handle(UserVerified $event)
    {
        if ($event->user->role == 'driver') {
            DB::table('locations')
                ->whereIn('user_id', User::where('phone', $event->user->phone)->get(['id'])->flatten())
                ->update(['user_id' => $event->user->id]);

            DB::table('cars')
                ->whereIn('user_id', User::where('phone', $event->user->phone)->get(['id'])->flatten())
                ->update(['user_id' => $event->user->id]);

            DB::table('cars')
                ->whereIn('user_id', User::where('phone', $event->user->phone)->get(['id'])->flatten())
                ->update(['user_id' => $event->user->id]);

            DB::table('drivers')
                ->whereIn('user_id', User::where('phone', $event->user->phone)->get(['id'])->flatten())
                ->update(['user_id' => $event->user->id]);

            $records = DB::table('drivers')
                         ->whereIn('user_id', User::where('phone', $event->user->phone)->get(['id'])->flatten());

            if ($records->count() > 1) {
                DB::table('drivers')->where('id', $records->orderBy('id', 'desc')->first()->id)
                    ->delete();
            }

        }
    }
}
