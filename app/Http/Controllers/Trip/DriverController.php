<?php

namespace App\Http\Controllers\Trip;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use \Laravel\Passport\ClientRepository;

class DriverController extends Controller
{
    /**
     * Driver online
     *
     * Make a driver online, when a driver goes online his/her availability will
     * set to true as well. An approved drvier can go to online mode.
     * @return JSON
     */
    public function online()
    {
        $user = Auth::user()->driver()->first();
        if (Auth::user()->driver()->first()->online) {
            return fail([
                        'title' => 'Driver cannot go online',
                        'detail'=> 'You are currently online.' 
                    ]);
        }

        // Online    true
        // Available true
        if ($this->updateFlags(true, true)) {
            return ok(['result' => 'Driver is online.']);
        } else {
            return fail([
                        'title' => 'Driver cannot go online',
                        'detail'=> 'Driver cannot go online because of some updating online status issue' 
                    ]);
        }
    }

    /**
     * Driver offline
     *
     * Make a driver offline, when a driver goes offline his/her availability will
     * set to false as well. An approved drvier can go to offline mode.
     * @return JSON
     */
    public function offline()
    {
        if (! Auth::user()->driver()->first()->available) {
            return fail([
                        'title' => 'Driver cannot go offline',
                        'detail'=> 'An onway driver cannot go offline.' 
                    ]);
        }

        // Online    false
        // Available false
        if ($this->updateFlags(false, false)) {
            return ok(['result' => 'Driver is offline.']);
        } else {
            return fail([
                        'title' => 'Driver cannot go offline',
                        'detail'=> 'Driver cannot go offline because of some updating offline status issue' 
                    ]);
        }
    }

    /**
     * Driver onway
     *
     * NOT USED
     * Make a driver onway, when a driver goes onway his/her availability will
     * set to false while he/she is still online An approved drvier can go 
     * to onway mode.
     * @return JSON
     */
    public function onway()
    {
        // Online    true
        // Available false
        if ($this->updateFlags(true, false)) {
            return ok(['result' => 'Driver is onway.']);
        } else {
            return fail([
                        'title' => 'Driver cannot be onway',
                        'detail'=> 'Driver cannot be onway because of some updating onway status issue' 
                    ]);
        }
    }

    /**
     * Driver available
     *
     * NOT USED
     * Make a driver available, when a driver goes available his/her availability 
     * will set to true while he/she is still online An approved drvier can go 
     * to available mode.
     * @return JSON
     */
    public function available()
    {
        // Online    true
        // Available true
        if ($this->updateFlags(true, true)) {
            return ok(['result' => 'Driver is available.']);
        } else {
            return fail([
                        'title' => 'Driver cannot be availabe',
                        'detail'=> 'Driver cannot be availabe because of some updating availabe status issue' 
                    ]);
        }
    }

    /**
     * Set online and availabe flags.
     * @param  boolean $online
     * @param  boolean $available
     * @return boolean
     */
    private function updateFlags($online, $available)
    {
        $driver = Auth::user()->driver()->first();
        $driver->online    = $online;
        $driver->available = $available;
        return $driver->save();
    }
}
