<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use App\User;
use Validator;
use Carbon\Carbon;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use \Laravel\Passport\Passport;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use \Laravel\Passport\ClientRepository;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\DriverRegisterRequest;
use App\Http\Requests\ClientRegisterRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\ClientRegisterSocialRequest;
use \Laravel\Passport\Http\Controllers\AccessTokenController;

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
     * New client repository instance.
     *
     * @var  string
     */
    private $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ClientRepository $client)
    {
        $this->middleware('guest');
        $this->client = $client;
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
     * for login and validation.
     * 
     * @param  UserRegisterRequest   $userRequest 
     * @param  DriverRegisterRequest $driverRequest
     * @param  ClientRepository      $client
     * @return json
     */
    public function driver(UserRegisterRequest $userRequest, DriverRegisterRequest $driverRequest)
    {
        // Create new driver
        $driver = $this->newDriver($userRequest, $driverRequest);

        // Revoke other access tokens for this driver
        $this->revokeOtherAccessTokens($userRequest->phone, $driver->user_id);
        
        // Genrate new access token
        $token = $this->newPersonalAccessToken($driver->id, 'driver');

        // Fire user register listeners
        event(new UserRegistered(Auth::loginUsingId($driver->user_id)));

        return ok([
                'token_type'   => 'Bearer',
                'access_token' => $token->accessToken,
                'expires_at'   => $token->token->get(['expires_at'])[0]->expires_at,
            ]);
    }

    /**
     * Client registration
     *
     * Initial step for client to register, using phone no. as the primary param
     * for login and validation. 
     *
     * @param  App\Http\Request\UserRegisterRequest $userRequest
     * @param  App\Http\Request\ClientRegisterRequest $clientRequest
     * @return json
     */
    public function client(UserRegisterRequest $userRequest, ClientRegisterRequest $clientRequest)
    {
        // Create new client
        $client = $this->newClient($userRequest, $clientRequest);

        // Genrate new access token
        $token = $this->newPersonalAccessToken($client->id, 'driver');

        // Fire user register listeners
        event(new UserRegistered(Auth::loginUsingId($client->user_id)));

        return ok([
                'token_type'   => 'Bearer',
                'access_token' => $token->accessToken,
                'expires_at'   => $token->token->get(['expires_at'])[0]->expires_at,
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

    /**
     * Revoke other access tokens of given phone number and keep his/her current
     * access token functinal.
     * @param  string $phone
     * @param  intger $currentUserId
     * @return bool
     */
    private function revokeOtherAccessTokens($phone, $currentUserId)
    {
        $toRevoke = user::wherePhone($phone)
                        ->select('id')
                        ->where('id', '<>', $currentUserId)
                        ->get(['id']);

        DB::table('oauth_access_tokens')
            ->whereIn('user_id', $toRevoke->flatten())
            ->update(['revoked' => true]);
    }

    /**
     * Create new personal access token for given client id.
     * @param  integer $clientId
     * @param  string $tokenName
     * @return array
     */
    private function newPersonalAccessToken($clientId, $tokenName)
    {
        DB::table('oauth_personal_access_clients')->insert([
            'client_id'  => $clientId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return Auth::user()->createToken($tokenName);
    }

    /**
     * Create new client.
     * @param  App\Http\Request\UserRegisterRequest $userRequest
     * @param  App\Http\Request\ClientRegisterRequest $clientRequest
     * @return \Laravel\Passport\ClientRepository
     */
    private function newClient($userRequest, $clientRequest)
    {
        $uuid = Uuid::generate(1)->string;
        $userRequest['role']     = 'client';
        $email = $userRequest['role'] . '_' . $userRequest['phone'] . '_' . $uuid . '@saamtaxi.com';
        $userRequest['uuid']     = $uuid;
        $userRequest['password'] = $uuid;
        $userRequest['email']    = $email;

        $user = User::create($userRequest->all());

        $user = Auth::loginUsingId($user->id)->client()->create($clientRequest->all());

        return $this->client->create($user->id, 'client', url('/'), true, false);
    }

    /**
     * Create new driver.
     * @param  App\Http\Request\UserRegisterRequest $userRequest
     * @param  App\Http\Request\ClientRegisterRequest $clientRequest
     * @return \Laravel\Passport\ClientRepository
     */
    private function newDriver($userRequest, $driverRequest)
    {
        $uuid = Uuid::generate(1)->string;
        $userRequest['role']     = 'driver';
        $email = $userRequest['role'] . '_' . $userRequest['phone'] . '_' . $uuid . '@saamtaxi.com';
        $userRequest['uuid']     = $uuid;
        $userRequest['password'] = $uuid;
        $userRequest['email']    = $email;

        $user = User::create($userRequest->all());

        Auth::loginUsingId($user->id)->driver()->create($driverRequest->all());

        return $this->client->create($user->id, 'driver', url('/'), true, false);
    }
}
