<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ClientRequest;
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
        $user = User::create($request->all());
        Auth::loginUsingId($user->id)->client()->create($request->all());        

        $response = $client->create($user->id, 'client', url('/'), false, true);

    	return response()->json([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    public function login(UserRequest $request, ClientRepository $client)
    {
        //dd($request->all());
        if (Auth::attempt($request->all())) {
            
            // A user can have multiple user secrets and ids
            $response = $client->forUser(Auth::user()->id)[0];
            return [
                'client_secret' => $response->secret,
                'client_id'     => $response->id,
            ];
        }
    }
}
