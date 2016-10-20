<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
	/**
	 * Create a new client.
	 * 
	 * @return JSON
	 */
    public function register(ClientRequest $request)
    {
    	// Set client token
    	$request['token'] = $this->token();

    	// Set user role
    	$request['role']  = 'client';

    	return User::create($request->all());
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
