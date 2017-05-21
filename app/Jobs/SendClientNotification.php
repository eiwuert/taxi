<?php

namespace App\Jobs;

use Log;
use Auth;
use App\Events\StateChanged;
use Illuminate\Bus\Queueable;
use App\Repositories\FcmRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendClientNotification implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $title;
    protected $message;
    protected $user_id;
    protected $device_token;

    /**
     * Create a new job instance.
     * 
     * @param string $title
     * @param string $message
     * @param string $device_token
     * @return void
     */
    public function __construct($title, $message, $device_token, $userId = 0)
    {
        $this->title = $title;
        $this->message = $message;
        $this->user_id = $userId;
        $this->device_token = $device_token;
        if ($userId != 0) {
            Auth::loginUsingId($userId);
        }
    }

    /**
     * Execute the job.
     * 
     * @return void
     */
    public function handle()
    {
        $fcm = new FcmRepository();
        $fcm->to_client($this->title, $this->message, $this->device_token);
        event(new StateChanged(Auth::user(), $this->title, $this->message));
    }
}
