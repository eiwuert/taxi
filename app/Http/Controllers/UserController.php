<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Agency;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function changeLang($lang)
    {
        if (in_array($lang, ['fa', 'en'])) {
            if (!is_null(Auth::user())) {
                call_user_func([Auth::user(), Auth::user()->role])
                    ->first()
                    ->forceFill(['lang' => $lang])
                    ->save();
            }
            App::setlocale($lang);
            return ok([
                'title'  => __('api/lang.success'),
                'detail' => __('api/lang.success_detail')
            ]);
        } else {
            return fail([
                'title'  => __('api/lang.fail'),
                'detail' => __('api/lang.fail_detail')
            ]);
        }
    }

    /**
     * Contact to agency call center.
     * @return json
     */
    public function contact()
    {
        $userAgency = Agency::whereState(call_user_func([Auth::user(), Auth::user()->role])->first()->state)->first();
        $globalAgency = Agency::whereState(0)->first();
        if (is_null($userAgency)) {
            $userAgency = new \stdClass();
        } else {
            $userAgency->name = config('states.' . $userAgency->state);
            unset($userAgency['id'], $userAgency['state'], $userAgency['created_at'], $userAgency['updated_at']);
        }
        if (is_null($globalAgency)) {
            $globalAgency = new \stdClass();
        } else {
            // $globalAgency->name = config('states.' . $globalAgency->state);
            unset($globalAgency['id'], $globalAgency['state'], $globalAgency['created_at'], $globalAgency['updated_at']);
        }
        return ok([
            'head' => $globalAgency,
            'branch' => $userAgency
        ]);
    }
}
