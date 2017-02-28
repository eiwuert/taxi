<?php

namespace App\Console\Commands;

use DB;
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
        $single = Trip::where('driver_id', '<>', null)
                    ->where('status_id', Status::where('name', 'client_found')->firstOrFail()->value)
                    ->where('next', null)
                    ->passed();

        // Multi route trips has more time. due to the time it takes to create trips.
        $multi = Trip::where('driver_id', '<>', null)
                    ->where('status_id', Status::where('name', 'client_found')->firstOrFail()->value)
                    ->where('next', '<>', null)
                    ->passed(65);

        // Union of single route trips and multi routes
        $trips = $single->union($multi)->get();

        foreach ($trips as $trip) {
            $driverId = $trip->driver_id;
            Log::info($driverId);
            $trip->forceFill([
                            'status_id'              => Status::where('name', 'no_response')->firstOrFail()->value,
                            'updated_at'             => Carbon::now(),
                        ])->save();
            Log::info($driverId);

            while (! is_null($trip->next)) {
                Trip::find($trip->next)->forceFill([
                    'status_id' => Status::where('name', 'next_trip_halt')->firstOrFail()->value,
                    'updated_at'             => Carbon::now(),
                ])->save();
                $trip = Trip::find($trip->next);
            }
            Log::info($driverId);

            dispatch(new SendDriverNotification('no_reponse_going_offline', '4', Driver::where('id', $driverId)->firstOrFail()->device_token));
            Log::info($driverId);

            Driver::find($driverId)->forceFill([
                        'online'     => false,
                        'available'  => true,
                    ])->save();

            Log::alert(($trip->next));
            // Request new taxi
            if (is_null($trip->next)) {
                $prevTrip = Trip::find($trip->id);
                $tripRequest = [
                    's_lat'  => $prevTrip->source()->first()->latitude,
                    's_long' => $prevTrip->source()->first()->longitude,
                    'd_lat'  => $prevTrip->destination()->first()->latitude,
                    'd_long' => $prevTrip->destination()->first()->longitude,
                ];
                $exclude = TripRepository::excludeDriver($prevTrip->client_id);
                if ($exclude['count'] < 10) {
                    TripRepository::requestTaxi($tripRequest, $exclude['result'], Client::find($prevTrip->client_id)->user->id);
                } else {
                    dispatch(new SendClientNotification('no_driver_found', '1', Client::where('id', $prevTrip->client_id)->firstOrFail()->device_token));
                }
            } else {
                $prevTrip = Trip::find($trip->id);
                $locations = [];
                while (!is_null($prevTrip->next)) {
                    $locations[] = $prevTrip->source;
                    $prevTrip = \App\Trip::find($prevTrip->next);
                }
                $locations[] = $prevTrip->source;
                $locations[] = $prevTrip->destination;

                $tripRequest = [];
                foreach ($locations as $index => $location) {
                    if ($index == 0) {
                        $latLng = \App\Location::find($location);
                        $tripRequest[] = [
                            's_lat' => $latLng->latitude,
                            's_long' => $latLng->longitude,
                        ];
                        continue;
                    }

                    $latLng = \App\Location::find($location);
                    $tripRequest[] = [
                        'd_lat' => $latLng->latitude,
                        'd_long' => $latLng->longitude,
                    ];
                }

                $exclude = TripRepository::excludeDriver($prevTrip->client_id);
                if ($exclude['count'] < 10) {
                    Log::alert('im creating another trip.');
                    TripRepository::createMultiRouteTrip($tripRequest, $exclude['result'], Client::find($prevTrip->client_id)->user->id);
                } else {
                    dispatch(new SendClientNotification('no_driver_found', '1', Client::where('id', $prevTrip->client_id)->firstOrFail()->device_token));
                    $prevTrip = Trip::find($trip->id);
                    Log::alert('im sending no driver message.');
                    while (!is_null($prevTrip->next)) {
                        Trip::find($prevTrip)->forceFill(['status_id' => Status::where('name', 'next_trip_halt')->firstOrFail()->value])->save();
                        $prevTrip = $prevTrip->next;
                    }
                    $prevTrip->forceFill(['status_id' => Status::where('name', 'next_trip_halt')->firstOrFail()->value])->save();
                }
            }
        }
    }
}
