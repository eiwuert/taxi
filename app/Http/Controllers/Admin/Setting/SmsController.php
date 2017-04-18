<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Sms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    /**
     * Show all codes.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Sms::with('user')
                    ->orderBy('id', 'desc')
                    ->paginate((int) option('pagination', 15));
        $codes = $this->mutateCodes($codes);
        return view('admin.settings.sms', compact('codes'));
    }

    /**
     * Mutate codes before sending to view.
     *
     * @param  Array $codes
     * @return \Illuminate\Http\Response
     */
    private function mutateCodes($codes)
    {
        foreach ($codes as $code) {
            $user = call_user_func([$code->user, $code->user->role])->first();
            $code->picture = $user->getPicture();
            if (is_null($user->first_name) && is_null($user->last_name)) {
                $code->name = null;
            } else {
                $code->name = $user->first_name . ' ' . $user->last_name;
            }
            $code->phone = $user->phone();
        }
        return $codes;
    }
}
