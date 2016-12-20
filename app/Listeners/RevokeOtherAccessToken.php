<?php

namespace App\Listeners;

use DB;
use App\User;
use App\Events\UserVerified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RevokeOtherAccessToken
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
            $toRevoke = User::wherePhone($event->user->phone)
                            ->select('id')
                            ->where('id', '<>', $event->user->id)
                            ->where('role', 'driver')
                            ->get(['id']);

            DB::table('oauth_access_tokens')
                ->whereIn('user_id', $toRevoke->flatten())
                ->update(['revoked' => true]);
        }
    }
}
