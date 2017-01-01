<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{
	/**
	 * Show login form.
	 * @return view
	 */
    public function form()
    {
    	return view('admin.login');
    }

    /**
     * Login admin.
     * @return redirect
     */
    public function login(LoginRequest $request)
    {
    	
    }
}
