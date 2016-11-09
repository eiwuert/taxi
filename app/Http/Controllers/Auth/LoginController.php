<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\SocialRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use \Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Login user.
     * 
     * @param  UserRequest
     * @param  ClientRepository
     * @return json
     */
    public function loginUser(Request $request, ClientRepository $client)
    {
        if (!isset($request['password']) || !isset($request['email'])) {
            return fail([
                    'title'  => 'Email and password are required.',
                    'detail' => 'Email and password should be sent.'
                ], 401);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
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

    /**
     * Driver login
     *
     * Handle driver login with phone and password.
     * @param  UserLoginRequest $userRequest
     * @param  ClientRepository $client
     * @return JSON
     */
    public function loginDriver(UserLoginRequest $userRequest, ClientRepository $client)
    {
        // This condition always return a result because we are checking esistance
        // of the user phone number on the validation step.
        if (User::where('phone', $userRequest->phone)->first()->role != 'driver') {
            return fail([
                    'title' => 'Unauthorized',
                    'detail'=> 'You cannot login as a driver with these credentials.'
                ], 401);
        }

        if (Auth::attempt(['phone' => $userRequest->phone, 'password' => $userRequest->password])) {
            // A user can have multiple user secrets and ids
            $response = $client->forUser(Auth::user()->id)->first();

            // if there is no client id secret or secret.
            if (empty($response)) {
                return fail([
                        'title'  => 'no client secret',
                        'detail' => 'There is no client id and client secret for this user, please
                                    contact adminstrator'
                    ], 500);
            }

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

    /**
     * Login social.
     * 
     * @param  UserRequest
     * @param  ClientRepository
     * @return json
     */
    public function loginSocial(Request $request, ClientRepository $client)
    {
        if (!isset($request['social_id']) || !isset($request['email'])) {
            return fail([
                    'title'  => 'Email and social ID are required.',
                    'detail' => 'Email and social ID should be sent.'
                ], 401);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->social_id])) {
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
