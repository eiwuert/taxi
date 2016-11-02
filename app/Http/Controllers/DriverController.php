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
}
