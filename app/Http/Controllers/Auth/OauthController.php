<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use \Laravel\Passport\Http\Controllers\AccessTokenController;

class OauthController extends Controller
{
    /**
     * AccessTokenController instance
     *
     * @var string
     */
    protected $access_token;

    public function __construct()
    {
    	$this->access_token = new AccessTokenController();
    }

    /**
     * Retuen new acces token in json format.
     * 
     * @param  ServerRequestInterface $request
     * @return json
     */
    public function token(ServerRequestInterface $request)
    {
    	$token = $this->access_token->issueToken();	
    }
}