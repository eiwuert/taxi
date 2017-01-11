<?php

namespace App\Console\Commands;

use DB;
use App\trip;
use App\Status;
use Carbon\Carbon;
use App\Client;
use App\Driver;
use Illuminate\Console\Command;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;

class driverNoResponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'driver:noresponse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Driver with no reponse.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $trips = Trip::where('driver_id', '<>', null)
                    ->where('status_id', Status::where('name', 'client_found')->firstOrFail()->id)
                    ->passed()
                    ->get();

        foreach($trips as $trip) {
            DB::table('trips')->where('id', $trip->id)
              ->update([
                    'status_id'              => Status::where('name', 'no_driver')->firstOrFail()->id,
                    'updated_at'             => Carbon::now(),
                ]);

            dispatch(new SendDriverNotification('4', 'no_reponse_going_offline', Driver::where('id', $trip->driver_id)->firstOrFail()->device_token));

            DB::table('drivers')
              ->where('id', $trip->driver_id)
              ->update([
                    'online'     => false,
                    'available'  => false,
                ]);
        }
    }
}
