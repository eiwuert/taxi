<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use \Laravel\Passport\ClientRepository;

class ClientController extends Controller
{
	/**
	 * Create a new client.
	 * 
	 * @return JSON
	 */
    public function register(UserRequest $request, ClientRepository $client)
    {
        // Set user role
        $request['role']  = 'client';

        $response = $client->create( User::create($request->all())->id, 'client', url('/'), false, true);

    	return response()->json([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }
}
