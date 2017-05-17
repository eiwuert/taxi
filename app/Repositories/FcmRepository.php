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
        if (\App::runningUnitTests()) {
            return true;
        }

        if (debug_backtrace()[1]['function'] == 'to_driver') {
            $server_key = config('fcm.server_key');
        } elseif (debug_backtrace()[1]['function'] == 'to_client') {
            $server_key = config('fcm.server_key');
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
        Log::debug('to driver: ' . $message . ': ' . $title);
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
        Log::debug('to client: ' . $message . ': ' . $title);
        return $this->message($title, $message, $device_token);
    }

    /**
     * Count of successful messages in a month.
     *
     * @param  bool $success
     * @return array
     */
    public function dailyMessagesOnMonth($success = 0)
    {
        // Goes to start of month
        $startOfMonth = Carbon::now()->startOfMonth()->month;
        $dailySuccessfulMessagesOnMonth = [];

        // Loop through days
        $add = 0;
        while (Carbon::now()->month == $startOfMonth) {
            // $total = Fcm::where(['_id' => array('$gte' => Carbon::now()->startOfMonth()->addDay($add)->toIso8601String(),
            //                                              '$lt' => Carbon::now()->startOfMonth()->addDay($add++)->toIso8601String())])
                $total = Fcm::where('success', $success)
                            ->where('_id', '>=', Fcm::createId(Carbon::now()->startOfMonth()->addDay($add++)->timestamp))
                            ->where('_id', '<', Fcm::createId(Carbon::now()->startOfMonth()->addDay($add)->timestamp))
                            ->count();

            $dailySuccessfulMessagesOnMonth[] = [Carbon::now()->startOfDay()->addDay($add)->day, $total];
            $startOfMonth = Carbon::now()->startOfMonth()->addDay($add)->month;
        }
        // Sort data.
        asort($dailySuccessfulMessagesOnMonth);
        
        // return only values.
        return array_values($dailySuccessfulMessagesOnMonth);
    }
}
