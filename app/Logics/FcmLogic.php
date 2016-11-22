<?php

namespace App\Logics;

use Auth;
use GuzzleHttp\Client;

class FcmLogic
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
                ],
                'headers' => [
                    'Authorization' => 'key=' . $server_key,
                    'Content-Type'  => 'application/json',
                ],
            ]
        );
        return $response;
	}

    /**
     * Send FCM message to driver.
     * @param  string $title
     * @param  string $message
     * @param  string $device_token
     * @return boolean
     */
    public function to_driver($title, $message, $device_token) 
    {
        $response = $this->message($title, $message, $device_token);

        if ($response->getReasonPhrase() == 'OK' && $response->getStatusCode() == 200) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Send FCM message to driver.
     * @param  string $title
     * @param  string $message
     * @param  string $device_token
     * @return boolean
     */
    public function to_client($title, $message, $device_token) 
    {
        $response = $this->message($title, $message, $device_token);

        if ($response->getReasonPhrase() == 'OK' && $response->getStatusCode() == 200) {
            return true;
        } else {
            return false;
        }
    }
}