<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Driver;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ClientRequest;
use \Laravel\Passport\ClientRepository;

class DriverController extends Controller
{
	/**
	 * Create a new driver.
	 * 
	 * @return json
	 */
    public function register(UserRequest $userRequest, ClientRequest $clientRequest, ClientRepository $client)
    {
        // Failure will handle with UserRequest
        $user = User::create($userRequest->all());

        // Failure will handle with ClientRequest
        Auth::loginUsingId($user->id)->driver()->create($clientRequest->all());   

        // Create password grant client
        $response = $client->create($user->id, 'driver', url('/'), false, true);

    	return ok([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    public function login(UserRequest $request, ClientRepository $client)
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
                    'title' => 'User credentioal is not valid.',
                    'detail' => 'You have entered email and password that can not be authenticated.'
                ], 401);
        }
    }
}
