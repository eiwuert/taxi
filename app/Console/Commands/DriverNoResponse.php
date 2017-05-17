<?php

namespace App\Console\Commands;

use Log;
use App\Trip;
use App\Status;
use App\Client;
use App\Driver;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;
use App\Repositories\TripRepository;
use App\Repositories\Trip\CreateRepository as Create;
use App\Repositories\Trip\MainRepository as DriversTo;

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
    protected $description = 'Driver with no response.';

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
                    ->where('status_id', Status::where('name', 'client_found')->firstOrFail()->value)
                    ->passed()
                    ->get();

        foreach ($trips as $trip) {
            $driverId = $trip->driver_id;
            Log::info($driverId);
            $trip->forceFill([
                            'status_id'              => Status::where('name', 'no_response')->firstOrFail()->value,
                            'updated_at'             => Carbon::now(),
                        ])->save();

            while (! is_null($trip->next)) {
                Trip::find($trip->next)->forceFill([
                    'status_id' => Status::where('name', 'next_trip_halt')->firstOrFail()->value,
                    'updated_at'             => Carbon::now(),
                ])->save();
                $trip = Trip::find($trip->next);
            }
            $driver = Driver::find($driverId);
            dispatch(new SendDriverNotification('no_reponse_going_offline', '4', $driver->device_token, $driver->user->id));
            Log::info($driverId);

            Driver::find($driverId)->forceFill([
                        'online'     => false,
                        'available'  => true,
                    ])->save();

            Log::alert(($trip->next));
            // Request new taxi
            $prevTrip = Trip::find($trip->id);
            $tripRequest = [
                's_lat'  => $prevTrip->source()->first()->latitude,
                's_long' => $prevTrip->source()->first()->longitude,
                'd_lat'  => $prevTrip->destination()->first()->latitude,
                'd_long' => $prevTrip->destination()->first()->longitude,
            ];
            $exclude = DriversTo::exclude($prevTrip->client_id);
            if ($exclude['count'] < 10) {
                Create::this($tripRequest)->forThis(Client::find($prevTrip->client_id)->user->id)
                    ->exclude($exclude['result'])->now();
            } else {
                $client = Client::find($prevTrip->client_id);
                dispatch(new SendClientNotification('no_driver_found', '1', $client->device_token, $client->user->id));
            }
        }
    }
}
