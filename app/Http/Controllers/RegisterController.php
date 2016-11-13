<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RegisterRequest;
use \Laravel\Passport\ClientRepository;

class RegisterController extends Controller
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

}