<?php

namespace App\Listeners;

use DB;
use App\User;
use App\Events\UserVerified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MultiRecordClient
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
        DB::table('clients')
            ->whereIn('user_id', User::where('phone', $event->user->phone)
                                    ->whereVerified(true)
                                    ->where('role', 'client')
                                    ->get(['id'])->flatten())
            ->update(['user_id' => $event->user->id, 'device_token' => $event->user->device_token]);

        $count = DB::table('clients')
                     ->where('user_id', $event->user->id)->count();

        while ($count > 1) {
            DB::table('clients')
                ->where('id', DB::table('clients')
                                ->where('user_id', $event->user->id)
                                ->orderBy('id', 'desc')
                                ->first()->id)
                ->delete();

            $count -= 1;
        }
    }
}
