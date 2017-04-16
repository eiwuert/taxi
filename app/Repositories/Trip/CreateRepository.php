<?php

namespace App\Repositories\Trip;

use Log;
use Auth;
use App\User;
use App\Trip;
use App\Status;
use App\Payment;
use App\Location;
use Carbon\Carbon;
use App\Events\TripInitiated;
use App\Jobs\SendClientNotification;
use App\Jobs\SendDriverNotification;
use App\Repositories\LocationRepository;
use App\Repositories\Trip\MainRepository;

class CreateRepository extends MainRepository
{
    private static $car;
    private static $trip;
    private static $type;
    private static $user;
    private static $client;
    private static $driver;
    private static $nearby;
    private static $matrix;
    private static $source;
    private static $exclude;
    private static $request;
    private static $pending;
    private static $toClient;
    private static $destination;

    /**
     * Create new trip.
     * @param  array $request
     * @return static
     */
    public static function this($request)
    {
        self::$request = self::pre($request);
        return new static;
    }

    /**
     * Create a trip for given user or just authenticated user if he/she does not
     * have any pending trips.
     * @param  string $user
     * @return static
     */
    public static function forThis($user)
    {
        // Fetch the user.
        if ($user == 'auth') {
            self::$user = Auth::user();
            self::$client = self::$user->client->first();
        } else {
            self::$user = User::find($user);
            self::$client = self::$user->client()->first();
        }
        //
        // Check pending trips.
        $pending = Trip::where('client_id', self::$client->id)
                        ->where('driver_id', '<>', null)
                        ->whereIn('status_id', Trip::$pending);

        // If I have a pending trip and not on dev mode so the pending message will
        // be broadcast to the client.
        if ($pending->exists() && !self::dev($pending)) {
            self::$pending = true;
            return new static;
        } else {
            return new static;
        }
    }

    /**
     * Exclude given drivers from trip.
     * @param  array $drivers
     * @return static
     */
    public static function exclude($drivers = 0)
    {
        if (self::$pending) {
            return new static;
        }
        self::$exclude = $drivers;
        return new static;
    }

    /**
     * Time for actual trip method where trip is getting created.
     *
     * @return array
     */
    public static function now()
    {
        if (self::$pending) {
            return ['fail' => 'pending'];
        }
        if (self::location()) {
            return ['fail' => 'location'];
        }
        // Create trip.
        self::$trip = self::create();
        // Driver around the client.
        $drivers = self::nearby();
        if (!empty($drivers)) {
            self::$nearby = $drivers[0];
            $driverUser = User::find(self::$nearby->user_id);
            self::$toClient = self::toClient();
            $driverInfo = self::driverInfo($driverUser);
            self::update();
            self::$driver->updateDriverAvailability(false);
            dispatch(new SendClientNotification('wait_for_driver_to_accept_ride', '0', self::$client->device_token));
            Log::debug('Driver device token: ' . self::$driver->device_token);
            dispatch(new SendDriverNotification('new_client_found', '0', self::$driver->device_token));
            event(new TripInitiated(self::$trip, self::$request));
            return [
                'ok',
                'data' => [
                    'matrix' => self::$matrix,
                    'source' => self::$source->name,
                    'destination' => self::$destination->name,
                    'driver' => (object)$driverInfo
                ]
            ];
        } else {
            self::noDriver();
            dispatch(new SendClientNotification('no_driver_found', '1', self::$client->device_token));
            return ['fail' => 'no_driver'];
        }
    }

    /**
     * Set trip source and destination return true on error.
     *
     * @return boolean
     */
    private static function location()
    {
        self::$matrix = getDistanceMatrix(self::$request);
        self::$source = LocationRepository::set(self::$request['s_lat'], self::$request['s_long'], self::$user->id);
        self::$destination = LocationRepository::set(self::$request['d_lat'], self::$request['d_long'], self::$user->id);
        if (! @isset(self::$matrix['duration']['text'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Create a new trip and initiate with fetch value so far.
     * @return \App\Trip
     */
    private static function create()
    {
        return Trip::forceCreate([
            'client_id'       => self::$client->id,
            'status_id'       => Status::where('name', 'request_taxi')->firstOrFail()->value,
            'source'          => self::$source->id,
            'destination'     => self::$destination->id,
            'eta_text'        => self::$matrix['duration']['text'],
            'eta_value'       => self::$matrix['duration']['value'],
            'distance_text'   => self::$matrix['distance']['text'],
            'distance_value'  => self::$matrix['distance']['value'],
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now(),
        ]);
    }

    /**
     * Update trip status when a driver found.
     * @return void
     */
    private static function update()
    {
        self::$trip->update([
            'driver_id'              => self::$driver->id,
            'status_id'              => Status::where('name', 'client_found')->firstOrFail()->value,
            'etd_text'               => self::$toClient['duration']['text'],
            'etd_value'              => self::$toClient['duration']['value'],
            'driver_distance_text'   => self::$toClient['distance']['text'],
            'driver_distance_value'  => self::$toClient['distance']['value'],
            'driver_location'        => Location::where('user_id', self::$nearby->user_id)->orderBy('id', 'desc')->first()->id,
            'updated_at'             => Carbon::now(),
        ]);
    }

    /**
     * Find nearby driver.
     *
     * @return array
     */
    private static function nearby()
    {
        if (is_null(self::$exclude)) {
            self::$exclude = 0;
        }
        return nearby(self::$request['s_lat'],
                      self::$request['s_long'],
                      self::$request['type'],
                      // LIMIT
                      1,
                      // DISTANCE - KM
                      1, self::$exclude)['result'];
    }

    /**
     * Calculate distance of driver to client source.
     *
     * @return array
     */
    private static function toClient()
    {
        return getDistanceMatrix(['s_lat'  => self::$request['s_lat'],
                                   's_long' => self::$request['s_long'],
                                   'd_lat'  => self::$nearby->latitude,
                                   'd_long' => self::$nearby->longitude]);
    }

    /**
     * Get trip driver info.
     *
     * @param  \App\User $user
     * @return array
     */
    private static function driverInfo($user)
    {
        self::$driver = $user->driver()->first();
        self::$car = $user->car()->first();
        self::$type = self::$car->type()->first();
        return [
            'first_name' => self::$driver->first_name,
            'last_name'  => self::$driver->last_name,
            'gender'  => self::$driver->gender,
            'picture'  => self::$driver->picture,
            'number'  => self::$car->number,
            'color'  => self::$car->color,
            'type'  => self::$type->name,
            'phone' => $user->phone,
        ];
    }

    /**
     * Update trip status to no driver.
     *
     * @return void
     */
    private static function noDriver()
    {
        self::$trip->update([
            'status_id'              => Status::where('name', 'no_driver')->firstOrFail()->value,
            'updated_at'             => Carbon::now(),
        ]);
    }
}
