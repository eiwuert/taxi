<?php

namespace App\Repositories;

use DB;
use Log;
use Auth;
use App\Fcm;
use Carbon\Carbon;
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
        } elseif (debug_backtrace()[1]['function'] == 'to_client') {
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
        $res = json_decode($response->getBody());
        DB::connection('mongodb')->table('fcm')->insert([
            'multicast_id'   => $res->multicast_id,
            'success'        => $res->success,
            'failure'        => $res->failure,
            'canonical_ids'  => $res->canonical_ids,
            'results'        => $res->results,
            'head'           => debug_backtrace()[1]['function'],
            'device_token'   => $device_token,
            'title'          => $title,
            'message'        => $message,
        ]);
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
