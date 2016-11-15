<?php

namespace App\Http\Controllers;

use Auth;
use App\Sms;
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
    	$sms = Auth::user()->sms()->where('created_at', '>', Carbon::now()->subMinute(500)->toDateTimeString());
    	if ($sms->count()) {
    		if ($sms->first()->code == $request->code) {
    			Auth::user()->update(['verified' => true]);
    			return ok([
    						'content' => 'Phone verified successfuly'
    					]);
    		}
    	}
    }
}
