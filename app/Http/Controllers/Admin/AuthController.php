<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{
	/**
	 * Show login form.
	 * @return view
	 */
    public function form()
    {
        if (Auth::check()) {
    	   return redirectg(route('dashboard')); 
        } else {
           return view('admin.login'); 
        }
    }

    /**
     * Login admin.
     * @return redirect
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['password' => $request->password,
                            'email' => $request->email,
                            'verified' => true,
                            'role' => 'web'])) {
            return redirect()->intended(route('dashboard'));
        } else {
            /**
             * @todo translate
             */
            return redirect()->back()
                ->with('status', 'Check your credentials');
        }
    }
}
