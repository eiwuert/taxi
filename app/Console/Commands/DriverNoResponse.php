<?php

namespace App\Console\Commands;

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $trips = Trip::with('driver','client')
                    ->where('driver_id', '<>', null)
                    ->where('status_id', Status::value('client_found'))
                    ->passed()
                    ->get();

        foreach ($trips as $trip) {
            $driver = $trip->driver;
            $trip->forceFill([
                            'status_id'              => Status::value('no_response'),
                            'updated_at'             => Carbon::now(),
                        ])->save();



            dispatch(new SendDriverNotification('no_reponse_going_offline', '4', $driver->device_token, $driver->user->id));

            $driver->forceFill([
                        'online'     => false,
                        'available'  => true,
                    ])->save();

            // Request new taxi
            $tripRequest = [
                's_lat'  => $trip->source()->first()->latitude,
                's_long' => $trip->source()->first()->longitude,
                'd_lat'  => $trip->destination()->first()->latitude,
                'd_long' => $trip->destination()->first()->longitude,
                'type'   => $driver->user->car->type->id,
            ];
            $exclude = DriversTo::exclude($trip->client_id);
            $client = $trip->client;
            if ($exclude['count'] < 10) {
                Create::this($tripRequest)->forThis($client->user->id)
                    ->exclude($exclude['result'])->now();
            } else {
                dispatch(new SendClientNotification('no_driver_found', '1', $client->device_token, $client->user->id));
            }
        }
    }
}
