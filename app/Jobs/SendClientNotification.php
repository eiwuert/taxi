<?php

namespace App\Jobs;

use App\Logics\FcmLogic;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendClientNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * FCM instance.
     * @var FCM
     */
    protected $fcm;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FCM $fcm)
    {
        $this->fcm = $fcm;
    }

    /**
     * Execute the job.
     *
     * @param string $title
     * @param string $message
     * @param string $device_type
     * @return void
     */
    public function handle($title, $message, $device_type)
    {
        $this->fcm->to_driver($title, $message, $device_type);
    }
}
