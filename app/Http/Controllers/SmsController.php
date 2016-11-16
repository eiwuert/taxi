<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use App\Sms;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Requests\SmsRequest;

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
        if (Gate::denies('verify')) {
            return fail([
                    'title'  => 'You are already verfied',
                    'detail' => 'You are verfied, there is no need for verify again.'
                ]);
        }

        $sms = $this->getSMS();

    	if ($sms->count()) {
    		if ($sms->first()->code == $request->code) {
                $this->verifyUser();
    			return ok([
    						'content' => 'Phone verified successfuly'
    					]);
    		} else {
                return fail([
                    'title'  => 'Wrong code',
                    'detail' => 'You have entered wrong verification code, please check your code again.'
                ], 404);
            }
    	} else {
            return fail([
                    'title'  => 'Please ask for verification again',
                    'detail' => 'There is no active code for verifying this phone number.'
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
        if (Auth::user()->can('resend', Sms::class)) {
            event(new UserRegistered(Auth::user()));

            return ok([
                        'content' => 'SMS code re-sent successfuly',
                    ]);
        }
        return fail([
                        'title'  => 'You have requested for sms before',
                        'detail' => 'You have asked for resending sms less than 2 minutes ago.',
                    ]);
    }

    /**
     * Get user sms that is received less than 8 minutes ago.
     * @param  integer|string $minute
     * @return PDO
     */
    private function getSMS($minute = 8)
    {
        if ($minute == 'all') {
            return Auth::user()->sms()->get();
        } else {
            return Auth::user()->sms()->received($minute);        
        }
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
