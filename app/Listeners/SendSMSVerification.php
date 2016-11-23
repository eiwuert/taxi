<?php

namespace App\Listeners;

use App\Sms;
use App\Logics\SmsLogic;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMSVerification
{
    /**
     * SMS instance
     * @var \App\Logics\SmsLogic
     */
    private $sms;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sms = new SmsLogic();
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        if (config('sms.code') == 'random_int') {
            $code = rand (10000 , 99999);
        } else if (config('sms.code' == 'plain')) {
            $code = 55555;
        }

        $event->user->sms()
              ->create([
                  'code' => rand (10000 , 99999),
            ]);

        if ($event->user->role == 'client') {
            $this->sms->send($event->user->client()->first()->phone, $code);
        } else if ($event->user->role == 'driver') {
            $this->sms->send($event->user->driver()->first()->phone, $code);
        }
    }
}
