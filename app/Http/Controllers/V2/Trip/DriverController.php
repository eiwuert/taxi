<?php

namespace App\Http\Controllers\V2\Trip;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    /**
     * Driver online
     *
     * Make a driver online, when a driver goes online his/her availability will
     * set to true as well. Only an approved driver can go to online mode.
     * @return JSON
     */
    public function online()
    {
        // If driver is online keep the driver online, if the driver is offline
        // change the status to online. only different with V1 is that the
        // response is OK on both situations.
        if (!Auth::user()->driver->first()->available && Auth::user()->driver->first()->online) {
            return fail([
                    'title' => __('api/driver.Onway'),
                    'detail' => __('api/driver.You\'re onway')
                ]);
        }
        Auth::user()->driver->first()->goOnline();
        return ok([
            'title' => __('api/driver.Online'),
            'detail' => __('api/driver.You\'re online now')
        ]);
    }

    /**
     * Driver offline
     *
     * Make a driver offline, when a driver goes offline his/her availability will
     * set to false as well. An approved driver can go to offline mode.
     * @return JSON
     */
    public function offline()
    {
        // Driver is online but not available so the driver is onway.
        if (!Auth::user()->driver->first()->available && Auth::user()->driver->first()->online) {
            return fail([
                    'title' => __('api/driver.Onway'),
                    'detail' => __('api/driver.You\'re onway')
                ]);
        }
        Auth::user()->driver->first()->goOffline();
        return ok([
                'title' => __('api/driver.Offline'),
                'detail' => __('api/driver.You\'re offline now')
            ]);
    }

    /**
     * Get driver status, Online or Offline
     * @return json
     */
    public function status()
    {
        if (Auth::user()->driver->first()->online) {
            return ok([
                'title' => __('api/driver.Online'),
                'detail' => __('api/driver.You\'re online')
            ]);
        } else {
            return fail([
                'title' => __('api/driver.Offline'),
                'detail' => __('api/driver.You\'re offline')
            ]);
        }
    }
}
