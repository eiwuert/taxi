<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use App\Sms;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\SmsRequest;

class SmsController extends Controller
{
	/**
	 * Verify SMS code
	 *
	 * Check user SMS code is valid.
	 * @return json
	 */
    public function __invoke(SmsRequest $request)
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
                $this->verify();
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
     * Get user sms that is received less than 8 minutes ago.
     * @param  integer $minute
     * @return PDO
     */
    private function getSMS($minute = 8)
    {
        return Auth::user()->sms()->where('created_at', '>', Carbon::now()->subMinute($minute)->toDateTimeString());
    }

    /**
     * Update user to verified.
     * @return void
     */
    private function verify()
    {
        $user = User::find(Auth::user()->id);
        $user->verified = true;
        $user->save();
    }
}
