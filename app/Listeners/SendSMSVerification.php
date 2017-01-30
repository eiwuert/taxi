<?php

namespace App\Listeners;

use App\Sms;
use App\Events\UserRegistered;
use App\Repositories\SmsRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSMSVerification
{
    /**
     * SMS instance
     * @var \App\Repositories\SmsRepository
     */
    private $sms;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sms = new SmsRepository();
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
        } else if (config('sms.code') == 'plain') {
            $code = 55555;
        }

        $event->user->sms()
              ->create([
                  'code' => $code,
            ]);

        if ($event->user->role == 'client') {
            $this->sms->send($event->user->phone, $code);
        } else if ($event->user->role == 'driver') {
            $this->sms->send($event->user->phone, $code);
        }
    }
}
