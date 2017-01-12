<?php

namespace App\Console\Commands;

use DB;
use App\Trip;
use App\Status;
use App\Client;
use App\Driver;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;
use App\Repositories\TripRepository;

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

    protected $trip;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->trip = new TripRepository();
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

            // Request new taxi
            $prevTrip = Trip::find($trip->id);
            $tripRequest = [
                's_lat'  => $prevTrip->source()->first()->latitude,
                's_long' => $prevTrip->source()->first()->longitude,
                'd_lat'  => $prevTrip->destination()->first()->latitude,
                'd_long' => $prevTrip->destination()->first()->longitude,
            ];
            $trip = new TripRepository();
            $exclude = $trip->excludeDriver($prevTrip->client_id);
            if ($exclude['count'] < 10) {
                $trip->requestTaxi($tripRequest, $exclude['result'], Client::find($prevTrip->client_id)->user->id);
            } else {
                dispatch(new SendClientNotification('1', 'no_driver_found', Client::where('id', $prevTrip->client_id)->firstOrFail()->device_token));
            }
        }
    }
}
