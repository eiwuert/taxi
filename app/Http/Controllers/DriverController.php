<?php

namespace App\Http\Controllers;


use Auth;
use App\User;
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
        // Set user role
        $request['role']  = 'driver';

        $response = $client->create(User::create($request->all())->id, 'driver', url('/'), false, true);

    	return response()->json([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }
}
