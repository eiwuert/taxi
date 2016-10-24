<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use GuzzleHttp\Client;
use \Laravel\Passport\ClientRepository;

class ClientController extends Controller
{
	/**
	 * Create a new client.
	 * 
	 * @return JSON
	 */
    public function register(ClientRequest $request, ClientRepository $client)
    {
        // Set client token
        $request['token'] = '1';

        // Set user role
        $request['role']  = 'client';

        $response = $client->create( User::create($request->all())->id, 'client', url('/'), false, true);

    	return response()->json([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    /**
     * Generate token for client.
     *
     * @return string
     */
    private function token()
    {
    	return 'client-' . md5(microtime().rand());
    }
}
