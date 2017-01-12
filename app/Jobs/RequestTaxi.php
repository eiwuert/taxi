<?php

namespace App\Jobs;

use DB;
use Auth;
use App\User;
use App\Status;
use App\Location;
use Carbon\Carbon;
use App\Events\RideAccepted;
use Illuminate\Bus\Queueable;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestTaxi implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $tripRequest;

}
