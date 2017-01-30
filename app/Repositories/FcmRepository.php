<?php

namespace App\Repositories;

use Log;
use Auth;
use GuzzleHttp\Client;

class FcmRepository
{
    /**
     * instance of Guzzle
     * @var obj
     */
    private $http;

    /**
     * Create instance of Guzzle Http
     */
    public function __construct()
    {
        $this->http = new Client();
    }

    /**
     * Send a message to a device.
     * @param  string $title
     * @param  string $message
     * @param  string $device_token
     * @return Response
     */
    private function message($title, $message, $device_token)
    {
        if (debug_backtrace()[1]['function'] == 'to_driver') {
            $server_key = config('fcm.driver_server_key');
        } else if (debug_backtrace()[1]['function'] == 'to_client') {
            $server_key = config('fcm.client_server_key');
        }

        $response = $this->http->request('POST', config('fcm.send_url'), 
            [
                'json' => [
                    "data"         => ["team" => $title, "message" => $message],
                    "to"           => $device_token,
                    "time_to_live" => config('fcm.timeout'),
                    "priority"     => config('fcm.priority'),
                ],
                'headers' => [
                    'Authorization' => 'key=' . $server_key,
                    'Content-Type'  => 'application/json',
                ],
            ]
        );
        Log::log('info', $title . ' -> ' . $message);
        Log::info('device_token_' . debug_backtrace()[1]['function'], (array) $device_token);
        Log::info('FCM response: ', (array) $response);
        return $response;
    }

    /**
     * Send FCM message to driver.
     * @param  string $title
     * @param  string $message
     * @param  string $device_token
     * @return Response
     */
    public function to_driver($title, $message, $device_token) 
    {
        return $this->message($title, $message, $device_token);
    }

    /**
     * Send FCM message to driver.
     * @param  string $title
     * @param  string $message
     * @param  string $device_token
     * @return Response
     */
    public function to_client($title, $message, $device_token) 
    {
        return $this->message($title, $message, $device_token);
    }
}
