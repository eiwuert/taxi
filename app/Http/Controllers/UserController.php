<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function changeLang($lang)
    {
        if (in_array($lang, ['fa', 'en'])) {
            call_user_func([Auth::user(), Auth::user()->role])
                ->first()
                ->forceFill(['lang' => $lang])
                ->save();
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
}
