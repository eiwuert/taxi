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
            $code->name = $code->user->name();
            if (is_null($user)) {
                $code->picture = asset('img/no-profile.png');
                $code->phone = null;
            } else {
                $code->picture = $user->getPicture();
                $code->phone = $code->user->phone();
            }
        }
        return $codes;
    }
}
