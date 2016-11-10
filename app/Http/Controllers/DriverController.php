<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RegisterRequest;
use \Laravel\Passport\ClientRepository;

class DriverController extends Controller
{
	/**
	 * Create a new driver.
     *
     * @param  UserRequest $userRequest
     * @param  RegisterRequest $registerRequest
     * @param  ClientRepository $client
	 * @return json
	 */
    public function register(UserRequest $userRequest, RegisterRequest $registerRequest, ClientRepository $client)
    {
        // Failure will handle with UserRequest
        $user = User::create($userRequest->all());

        // Failure will handle with RegisterRequest
        Auth::loginUsingId($user->id)->driver()->create($registerRequest->all());

        // Create password grant client
        $response = $client->create($user->id, 'driver', url('/'), false, true);

    	return ok([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    /**
     * Login drive.
     * 
     * @param  UserRequest
     * @param  ClientRepository
     * @return json
     */
    public function login(Request $request, ClientRepository $client)
    {
        if (Auth::attempt($request->all())) {
            // A user can have multiple user secrets and ids
            $response = $client->forUser(Auth::user()->id)[0];

            return ok([
                    'client_secret' => $response->secret,
                    'client_id'     => $response->id,
                ]);
        } else {
            return fail([
                    'title'  => 'User credentials is not valid.',
                    'detail' => 'You have entered email and password that can not be authenticated.'
                ], 401);
        }
    }

    /**
     * Driver online
     *
     * Make a driver online, when a driver goes online his/her availability will
     * set to true as well. An approved drvier can go to online mode.
     * @return JSON
     */
    public function online()
    {
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
