<?php

namespace App\Repositories;

use Log;
use Auth;
use SoapClient;
use Carbon\Carbon;
use GuzzleHttp\Client;

class SmsRepository
{
    /**
     * Send a new text message.
     * @param  numeric $to
     * @param  string $message
     * @return boolean
     */
    public function send($to, $message)
    {
        if (env('APP_ENV', 'production') == 'local' || env('APP_ENV', 'production') == 'testing') {
            return true;
        }
        if (env('SMS') == 'ir') {
            return $this->sendIR($to, $message);
        } else {
            return $this->sendPlivo($to, $message);
        }
    }

    /**
     * Send new SMS with plivo
     * @param  numeric $to
     * @param  string $message
     * @return boolean
     */
    public function sendPlivo($to, $message)
    {
        $api  = config('sms.plivo.url') . "Account/" . config('sms.plivo.auth_id');
        $auth_id    = config('sms.plivo.auth_id');
        $auth_token = config('sms.plivo.auth_token');
        $http = new Client([
            'auth'        => [$auth_id, $auth_token],
            'http_errors' => false,
            'headers'     => ['Content-type' => 'application/json'],
        ]);
        $response = $http->post($api . '/Message/', [
                'json' => [
                    'src'   => config('sms.plivo.from'),
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

    /**
     * Send new SMS with SMS.ir
     * @param  numeric $to
     * @param  string $message
     * @return boolean
     */
    public function sendIR($to, $message)
    {
        date_default_timezone_set(config('app.timezone'));
        $client= new SoapClient(config('sms.ir.url'));
        $parameters['userName'] = config('sms.ir.userName');
        $parameters['password'] = config('sms.ir.password');
        $parameters['mobileNos'] = array(doubleval($to));
        $parameters['messages'] = array($message);
        $parameters['lineNumber'] = config('sms.ir.lineNumber');
        $parameters['sendDateTime'] = date("Y-m-d")."T".date("H:i:s");
        Log::info('SMS.ir log: ', (array) $client->SendMessageWithLineNumber($parameters));
    }
}
