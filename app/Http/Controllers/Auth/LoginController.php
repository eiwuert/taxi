<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\SocialRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use \Laravel\Passport\ClientRepository;
use App\Http\Requests\UserLoginSocialRequest;
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
     * API caller type.
     * 
     * @var string
     */
    private $type;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'phone';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->type = $request->segment(2);
    }

    /**
     * Driver/Client login
     *
     * Handle driver and client login with phone and password.
     * 
     * @param  UserLoginRequest $userRequest
     * @param  ClientRepository $client
     * @return JSON
     */
    public function loginUser(UserLoginRequest $userRequest, ClientRepository $client)
    {
        // This condition always return a result because we are checking existance
        // of the user phone number on the validation step.
        if ($this->type == 'driver') {
            if (User::where('phone', $userRequest->phone)->first()->role != 'driver') {
                return fail([
                        'title' => 'Unauthorized',
                        'detail'=> 'You cannot login as a driver with these credentials.'
                    ], 401);
            }
        } elseif ($this->type == 'client') {
            if (User::where('phone', $userRequest->phone)->first()->role != 'client') {
                return fail([
                        'title' => 'Unauthorized',
                        'detail'=> 'You cannot login as a client with these credentials.'
                    ], 401);
            }
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
                    'cliegnt_secret' => $response->secret,
                    'client_id'      => $response->id,
                ]);
        } else {
            return fail([
                    'title'  => 'User credentials is not valid.',
                    'detail' => 'You have entered phone and password that can not be authenticated.'
                ], 401);
        }
    }

    /**
     * Login social.
     *
     * Login client using social ID.
     * 
     * @param  UserRequest
     * @param  ClientRepository
     * @return json
     */
    public function loginSocial(UserLoginSocialRequest $userRequest, ClientRepository $client)
    {
        if ($this->type == 'client') {
            if (User::where('social_id', $userRequest->social_id)->first()->role != 'client') {
                return fail([
                        'title' => 'Unauthorized',
                        'detail'=> 'You cannot login as a client with these credentials.'
                    ], 401);
            }
        }

        if (Auth::attempt(['social_id' => $userRequest->social_id, 'password' => $userRequest->social_id])) {
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
                    'cliegnt_secret' => $response->secret,
                    'client_id'      => $response->id,
                ]);
        } else {
            return fail([
                    'title'  => 'User credentials is not valid.',
                    'detail' => 'You have entered phone and password that can not be authenticated.'
                ], 401);
        }
    }
}
