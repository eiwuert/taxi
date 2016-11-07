<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Http\Requests\RegisterRequest;
use \Laravel\Passport\ClientRepository;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Create a new driver.
     *
     * @param  UserRequest $userRequest
     * @param  RegisterRequest $registerRequest
     * @param  ClientRepository $client
     * @return json
     */
    public function driver(UserRequest $userRequest, RegisterRequest $registerRequest, ClientRepository $client)
    {
        // Failure will handle with UserRequest
        $user = User::create($userRequest->all());

        // Failure will handle with RegisterRequest
        Auth::loginUsingId($user->id)->driver()->create($registerRequest->all());

        // Create password grant client
        $response = $client->create($user->id, 'driver', url('/'), false, true);

        return ok([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    /**
     * Create a new client.
     *
     * @param  UserRequest $userRequest
     * @param  RegisterRequest $registerRequest
     * @param  ClientRepository $client
     * @return json
     */
    public function client(UserRequest $userRequest, RegisterRequest $registerRequest, ClientRepository $client)
    {
        // Failure will handle with UserRequest
        $user = User::create($userRequest->all());

        // Failure will handle with RegisterRequest
        Auth::loginUsingId($user->id)->client()->create($registerRequest->all());

        // Create password grant client
        $response = $client->create($user->id, 'client', url('/'), false, true);

        return ok([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    /**
     * Register using social id.
     * @param  SocialRequest    $socialRequest
     * @param  RegisterRequest  $registerRequest
     * @param  ClientRepository $client
     * @return json
     */
    public function socialDriver(SocialRequest $socialRequest, RegisterRequest $registerRequest, ClientRepository $client)
    {
        $socialRequest['password'] = $socialRequest->social_id;

        // Failure will handle with UserRequest
        $user = User::create($socialRequest->all());

        // Failure will handle with RegisterRequest
        Auth::loginUsingId($user->id)->driver()->create($registerRequest->all());

        // Create password grant client
        $response = $client->create($user->id, 'driver', url('/'), false, true);

        return ok([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }

    /**
     * Register using social id.
     * @param  SocialRequest    $socialRequest
     * @param  RegisterRequest  $registerRequest
     * @param  ClientRepository $client
     * @return json
     */
    public function socialClient(SocialRequest $socialRequest, RegisterRequest $registerRequest, ClientRepository $client)
    {
        $socialRequest['password'] = $socialRequest->social_id;

        // Failure will handle with UserRequest
        $user = User::create($socialRequest->all());

        //dd($registerRequest->all());

        // Failure will handle with RegisterRequest
        Auth::loginUsingId($user->id)->client()->create($registerRequest->all());

        // Create password grant client
        $response = $client->create($user->id, 'client', url('/'), false, true);

        return ok([
            'client_secret' => $response->secret,
            'client_id'     => $response->id,
        ]);
    }
}
