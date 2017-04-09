<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Gate;
use App\Sms;
use App\User;
use Carbon\Carbon;
use App\Events\UserVerified;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Requests\SmsRequest;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    /**
     * Verify SMS code
     *
     * Check user SMS code is valid.
     * @return json
     */
    public function verify(SmsRequest $request)
    {
        if (is_null($this->getSMS()->first())) {
            return fail([
                    'title'  => __('api/sms.Please ask for verification again'),
                    'detail' => __('api/sms.There is no active code for verifying this phone number'),
                ]);
        }

        if (Gate::denies('verify')) {
            return fail([
                    'title'  => __('api/sms.You are already verified'),
                    'detail' => __('api/sms.You are verified, there is no need for verify again'),
                ]);
        }

        if (Gate::denies('attempts', $this->getSMS())) {
            return fail([
                    'title'  => __('api/sms.Exceed attempts tries'),
                    'detail' => __('api/sms.You\'ve entered verification code wrong for too many times'),
                ]);
        }

        $sms = $this->getSMS();
        $sms->first()->increment('attempts');

        if ($sms->exists()) {
            if ($sms->first()->code == $request->code) {
                event(new UserVerified(Auth::user()));
                $this->verifyUser();
                return ok([
                            'content' => __('api/sms.Phone verified successfully'),
                        ]);
            } else {
                return fail([
                    'title'  => __('api/sms.Wrong code'),
                    'detail' => __('api/sms.You have entered wrong verification code, please check your code again'),
                ], 404);
            }
        } else {
            return fail([
                    'title'  => __('api/sms.Please ask for verification again'),
                    'detail' => __('api/sms.There is no active code for verifying this phone number'),
                ], 404);
        }
    }

    /**
     * Resend verification SMS.
     *
     * Resend SMS to authenticated user.
     * @return json
     */
    public function resend()
    {
        if (Gate::denies('verify')) {
            return fail([
                    'title'  => __('api/sms.You are already verified'),
                    'detail' => __('api/sms.You are verified, there is no need for verify again'),
                ]);
        }

        if (Auth::user()->can('resend', Sms::class)) {
            event(new UserRegistered(Auth::user()));
            return ok(['content' => __('api/sms.SMS code re-sent successfully')]);
        }

        return fail([
                    'title'  => __('api/sms.You have requested for sms before'),
                    'detail' => __('api/sms.You have asked for resending sms less than 2 minutes ago'),
                ]);
    }

    /**
     * Get user sms that is received less than 8 minutes ago.
     * @param  integer $minute
     * @return PDO
     */
    private function getSMS($minute = 8)
    {
        return Sms::whereUserId(Auth::user()->id)->received($minute)->orderBy('id', 'desc');
    }

    /**
     * Update user to verified.
     * @return void
     */
    private function verifyUser()
    {
        $user = User::find(Auth::user()->id);
        $user->verified = true;
        $user->save();
    }
}
