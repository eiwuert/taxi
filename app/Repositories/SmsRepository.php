<?php

namespace App\Repositories;

use Log;
use Auth;
use GuzzleHttp\Client;

class SmsRepository
{
    /**
     * instance of Guzzle
     * @var obj
     */
    private $http;

    /**
     * Sms instances
     */
    private $api;
    private $auth_id;
    private $auth_token;

    /**
     * Create instance of Guzzle Http
     */
    public function __construct()
    {
        $this->api  = config('sms.url') . "Account/" . config('sms.auth_id');
        $this->auth_id    = config('sms.auth_id');
        $this->auth_token = config('sms.auth_token');
        $this->http = new Client([
            'auth'        => [$this->auth_id, $this->auth_token],
            'http_errors' => false,
            'headers'     => ['Content-type' => 'application/json'],
        ]);
    }

    /**
     * Send new SMS.
     * @param  numberic $to
     * @param  string $message
     * @return boolean
     */
    public function send($to, $message)
    {
        $response = $this->http->post($this->api . '/Message/', [
                'json' => [
                    'src'   => config('sms.from'),
                    'dst'   => $to,
                    'text'  => $message
                ]
            ]);

        if ($response->getStatusCode() == 200 && $response->getReasonPhrase() == 'OK') {
            return true;
        } else {
            Log::critical('SMS verification failed with status of ' . $response->getStatusCode() . 
                          ' and reason phrase of ' . $response->getReasonPhrase());
            return false;
        }
    }
}