<?php

namespace App\Listeners;

use DB;
use App\User;
use App\Client;
use App\Events\UserVerified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MultiRecordClient
{
    /**
     * Handle the event.
     *
     * @param  UserVerified  $event
     * @return void
     */
    public function handle(UserVerified $event)
    {
        if ($event->user->role == 'client') {
            DB::table('locations')
                ->whereIn('user_id', User::where('phone', $event->user->phone)
                                        ->whereVerified(true)
                                        ->where('role', 'client')
                                        ->get(['id'])->flatten())
                ->update(['user_id' => $event->user->id]);

            DB::table('clients')
                ->whereIn('user_id', User::where('phone', $event->user->phone)
                                        ->whereVerified(true)
                                        ->where('role', 'client')
                                        ->get(['id'])->flatten())
                ->update(['user_id' => $event->user->id, 'device_token' => Client::whereUserId($event->user->id)->first()->device_token]);

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
}
