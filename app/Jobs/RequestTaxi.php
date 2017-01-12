<?php

namespace App\Jobs;

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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tripRequest)
    {
        $this->tripRequest = $tripRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (is_null($this->tripRequest->currency)) {
            $this->tripRequest->currency = 'USD';
        }

        if (is_null($this->tripRequest->type)) {
            $this->tripRequest->type = 'any';
        }

        $clientDeviceToken = User::wherePhone(Auth::user()->phone)
                            ->orderBy('id', 'desc')
                            ->first()->client()->first()->device_token;
        if ($pending = $this->pendingRequestTaxi()) {
            return $pending;
        }

        $matrix = getDistanceMatrix($this->tripRequest->all());
        $source = setLocation($this->tripRequest->s_lat, $this->tripRequest->s_long);
        $destination = setLocation($this->tripRequest->d_lat, $this->tripRequest->d_long);

        if (! @isset($matrix['duration']['text'])) {
            return ok([
                    'title'  => 'Not valid trip',
                    'detail' => 'You cannot trip there!'
                ]);
        }

        // 
        // REQUEST_TAXI
        // 
        $trip_id = DB::table('trips')->insertGetId([
                        'client_id'       => User::wherePhone(Auth::user()->phone)
                            ->orderBy('id', 'desc')
                            ->first()->client()->first()->id,
                        'status_id'       => Status::where('name', 'request_taxi')->firstOrFail()->value,
                        'source'          => $source->id,
                        'destination'     => $destination->id,
                        'eta_text'        => $matrix['duration']['text'],
                        'eta_value'       => $matrix['duration']['value'],
                        'distance_text'   => $matrix['distance']['text'],
                        'distance_value'  => $matrix['distance']['value'],
                        'created_at'      => Carbon::now(),
                        'updated_at'      => Carbon::now(),
                    ]);

        $trip = DB::table('trips')->where('id', $trip_id);

        /**
         * If there is one available driver within 1KM.
         * No driver found state happens here.
         * When there is a driver we send the requset to driver and wait for his/her response.
         */
        if (!empty($foundDriver = nearby($this->tripRequest->s_lat, $this->tripRequest->s_long, $this->tripRequest->type, 10, 1))) {
            $foundDriver = $foundDriver[0];
            $driverToClient = getDistanceMatrix(['s_lat'  => $this->tripRequest->s_lat,
                                       's_long' => $this->tripRequest->s_long,
                                       'd_lat'  => $foundDriver->latitude,
                                       'd_long' => $foundDriver->longitude]);

            $driver = User::find($foundDriver->user_id)->driver()->first();
            $driverDeviceToken = $driver->device_token;
            $car = User::find($foundDriver->user_id)->car()->first();
            $carType = $car->type()->first();
            $driverInfo = [
                'first_name' => $driver->first_name,
                'last_name'  => $driver->last_name,
                'gender'  => $driver->gender,
                'picture'  => $driver->picture,
                'number'  => $car->number,
                'color'  => $car->color,
                'type'  => $carType->name,
                'phone' => User::find($foundDriver->user_id)->phone,
            ];

            // 
            // CLIENT_FOUND
            // 
            $trip->update([
                    'driver_id'              => $driver->id,
                    'status_id'              => Status::where('name', 'client_found')->firstOrFail()->value,
                    'etd_text'               => $driverToClient['duration']['text'],
                    'etd_value'              => $driverToClient['duration']['value'],
                    'driver_distance_text'   => $driverToClient['distance']['text'],
                    'driver_distance_value'  => $driverToClient['distance']['value'],
                    'driver_location'        => Location::where('user_id', $foundDriver->user_id)->orderBy('id', 'desc')->first()->id, // location
                    'updated_at'             => Carbon::now(),
                ]);

            $this->updateDriverAvailability($driver, false);

            dispatch(new SendClientNotification('wait_for_driver_to_accept_ride', '0', $clientDeviceToken));
            dispatch(new SendDriverNotification('new_client_found', '0', $driverDeviceToken));
            event(new RideAccepted(Trip::whereId($trip_id)->first(), $carType->name, $this->tripRequest->currency));

            return ok([
                        'content'          => 'Trip request created successfully.',
                        'eta_text'         => $matrix['duration']['text'],
                        'eta_value'        => $matrix['duration']['value'],
                        'distance_text'    => $matrix['distance']['text'],
                        'distance_value'   => $matrix['distance']['value'],
                        'trip_status'      => 2,
                        'source_name'      => $source->name,
                        'destination_name' => $destination->name,
                        'driver'           => (object)$driverInfo,
                    ]);
        } else {
            //
            //  NO_DRIVER
            //  
            $trip->update([
                    'status_id'              => Status::where('name', 'no_driver')->firstOrFail()->value,
                    'updated_at'             => Carbon::now(),
                ]);

            dispatch(new SendClientNotification('no_driver_found', '1', $clientDeviceToken));

            return fail([
                'title'       => 'No driver available',
                'detail'      => 'There is no driver available in your area.',
                'trip_status' => 5,
            ], 404);
        }
    }
}
