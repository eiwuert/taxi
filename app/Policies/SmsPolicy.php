<?php

namespace App\Policies;

use App\Sms;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SmsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can resend the sms.
     *
     * @param  \App\User  $user
     * @param  \App\Sms  $sms
     * @return mixed
     */
    public function resend(User $user)
    {
        if(\App::runningUnitTests()) {
            return !$user->sms()->received(0)->count();
        } else {
            return !$user->sms()->received(2)->count();
        }
    }
}
