<?php

namespace App\Http\Controllers\Trip;

use Auth;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    /**
     * Driver online
     *
     * Make a driver online, when a driver goes online his/her availability will
     * set to true as well. An approved driver can go to online mode.
     * @return JSON
     */
    public function online()
    {
        // Driver can go online?
        if (Auth::user()->driver->first()->goOnline()) {
            return ok([
                    'result' => __('api/driver.Driver is online')
                ]);
        } else {
            return fail([
                    'title' => __('api/driver.Driver cannot go online'),
                    'detail'=> __('api/driver.You are currently online') 
                ]);
        }
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
        // Driver can go online?
        if (Auth::user()->driver->first()->goOffline()) {
            return ok([
                    'result' => __('api/driver.Driver is offline')
                ]);
        } else {
            return fail([
                    'title' => __('api/driver.Driver cannot go offline'),
                    'detail'=> __('api/driver.An onway or currently offline driver cannot go offline'), 
                ]);
        }
    }

    /**
     * Get driver status, Online or Offline
     * @return json
     */
    public function status()
    {
        return ok([
                'online' => Auth::user()->driver->first()->online,
            ]);
    }
}
