<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use \Laravel\Passport\ClientRepository;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\DriverRegisterRequest;
use App\Http\Requests\ClientRegisterRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\ClientRegisterSocialRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    /**
     * Driver registration
     *
     * Initial step for driver to register, using phone no. as the primary param
     * for login and validation. phone must be unique among all registered 
     * drivers.
     * 
     * @param  UserRegisterRequest   $userRequest 
     * @param  DriverRegisterRequest $driverRequest
     * @param  ClientRepository      $client
     * @return JSON
     */
    public function driver(UserRegisterRequest $userRequest, DriverRegisterRequest $driverRequest, ClientRepository $client)
    {
        $userRequest['role']  = 'driver';
        $userRequest['email'] = $userRequest['role'] . '_' . $userRequest['phone'] . '@saamtaxi.com';

        $user = User::create($userRequest->all());

        Auth::loginUsingId($user->id)->driver()->create($driverRequest->all());

        $response = $client->create($user->id, 'driver', url('/'), false, true);

        event(new UserRegistered(Auth::loginUsingId($user->id)));

        return ok([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    /**
     * Client registration
     *
     * Initial step for client to register, using phone no. as the primary param
     * for login and validation. phone must be unique among all registered 
     * clients.
     *
     * @param  UserRegisterRequest $userRequest
     * @param  ClientRegisterRequest $clientRequest
     * @param  ClientRepository $client
     * @return json
     */
    public function client(UserRegisterRequest $userRequest, ClientRegisterRequest $clientRequest, ClientRepository $client)
    {
        $userRequest['role']  = 'client';
        $userRequest['email'] = $userRequest['role'] . '_' . $userRequest['phone'] . '@saamtaxi.com';

        $user = User::create($userRequest->all());

        Auth::loginUsingId($user->id)->client()->create($clientRequest->all());

        $response = $client->create($user->id, 'client', url('/'), false, true);

        event(new UserRegistered(Auth::loginUsingId($user->id)));

        return ok([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    /**
     * Client social registraion
     *
     * Initial step for client to register, using phone no. as the primary param
     * for login and validation. phone must be unique among all registered 
     * clients.
     * 
     * @param  ClientRegisterSocialRequest    $socialRequest
     * @param  RegisterRequest  $registerRequest
     * @param  ClientRepository $client
     * @return json
     */
    public function socialClient(ClientRegisterSocialRequest $socialRequest, ClientRegisterRequest $clientRequest, ClientRepository $client)
    {
        $socialRequest['role']  = 'client';
        $socialRequest['email'] = $socialRequest['role'] . '_' . $socialRequest['phone'] . '@saamtaxi.com';
        $socialRequest['password'] = $socialRequest->social_id;

        // Failure will handle with UserRequest
        $user = User::create($socialRequest->all());

        // Failure will handle with RegisterRequest
        Auth::loginUsingId($user->id)->client()->create($clientRequest->all());

        // Create password grant client
        $response = $client->create($user->id, 'client', url('/'), false, true);

        return ok([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }
}
