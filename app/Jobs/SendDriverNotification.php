<?php

namespace App\Jobs;

use App\Logics\FcmLogic;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDriverNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $title;
    protected $message;
    protected $device_token;

    /**
     * Create a new job instance.
     * 
     * @param string $title
     * @param string $message
     * @param string $device_token     
     * @return void
     */
    public function __construct($title, $message, $device_token)
    {
        $this->title = $title;
        $this->message = $message;
        $this->device_token = $device_token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fcm = new FcmLogic();
        $fcm->to_driver($this->title, $this->message, $this->device_token);
    }
}
