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
                    'driver_id'              => null,
                    'status_id'              => Status::where('name', 'no_driver')->firstOrFail()->id,
                    'etd_text'               => null,
                    'etd_value'              => null,
                    'driver_distance_text'   => null,
                    'driver_distance_value'  => null,
                    'driver_location'        => null,
                    'updated_at'             => Carbon::now(),
                ]);

            dispatch(new SendClientNotification('No one accepted', 'No one accepted your trip.', Client::where('id', $trip->client_id)->firstOrFail()->device_token));
            dispatch(new SendDriverNotification('You didn\'t respond', 'You are going offline', Driver::where('id', $trip->driver_id)->firstOrFail()->device_token));


            DB::table('drivers')
              ->where('id', $trip->driver_id)
              ->update([
                    'online'     => false,
                    'available'  => false,
                ]);
        }
    }
}
