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
                    'result' => 'Driver is online.'
                ]);
        } else {
            return fail([
                    'title' => 'Driver cannot go online',
                    'detail'=> 'You are currently online.' 
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
                    'result' => 'Driver is offline.'
                ]);
        } else {
            return fail([
                    'title' => 'Driver cannot go offline',
                    'detail'=> 'An onway or currently online driver cannot go offline.' 
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
