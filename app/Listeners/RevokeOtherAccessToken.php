<?php

namespace App\Listeners;

use DB;
use App\User;
use App\Events\UserVerified;
use App\Jobs\SendDriverNotification;
use App\Jobs\SendClientNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RevokeOtherAccessToken
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
            // DRIVER
            $toRevoke = \App\User::wherePhone($event->user->phone)
                ->select('id')
                ->where('id', '<>', $event->user->id)
                ->where('role', 'driver');
            foreach ($toRevoke->get() as $user) {
                if (! $user->driver->isEmpty()) {
                    dispatch(new SendDriverNotification('logout', '8', $user->driver->first()->device_token));
                }
            }
            DB::table('oauth_access_tokens')
                ->whereIn('user_id', $toRevoke->get(['id'])->flatten())
                ->where('name', 'driver')
                ->update(['revoked' => true]);
        } else if ($event->user->role == 'client') {
            // CLIENT
            $toRevoke = User::wherePhone($event->user->phone)
                            ->select('id')
                            ->where('id', '<>', $event->user->id)
                            ->where('role', 'client');
            foreach ($toRevoke->get() as $user) {
                if (! $user->client->isEmpty()) {
                    dispatch(new SendClientNotification('logout', '12', $user->client->first()->device_token));
                }
            }
            DB::table('oauth_access_tokens')
                ->whereIn('user_id', $toRevoke->get(['id'])->flatten())
                ->where('name', 'client')
                ->update(['revoked' => true]);
        }
    }
}
