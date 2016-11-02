<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Driver;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use \Laravel\Passport\ClientRepository;

class DriverController extends Controller
{
	/**
	 * Create a new driver.
	 * 
	 * @return json
	 */
    public function register(UserRequest $request, ClientRepository $client)
    {
        $user = User::create($request->all());
        Auth::loginUsingId($user->id)->driver()->create($request->all());   

        $response = $client->create($user->id, 'driver', url('/'), false, true);

    	return response()->json([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    public function login(UserRequest $request, ClientRepository $client)
    {
        if (Auth::attempt($request->all())) {
            // A user can have multiple user secrets and ids
            $response = $client->forUser(Auth::user()->id)[0];

            return response()->json([
                'success' => true,
                'data' => [
                    'client_secret' => $response->secret,
                    'client_id'     => $response->id,
                    ]
                ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => [
                    'status' => 401,
                    'title' => 'User credentioal is not valid.'
                    'detail' => 'You have entered email and password that can not be authenticate.'
                    ]
                ], 401);
        }
    }
}
