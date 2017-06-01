<?php

namespace App\Repositories;

use Auth;
use Cache;
use App\User;
use GoogleMaps;
use App\Driver;
use App\Status;

class LocationRepository
{
    /**
     * Show drivers on maps includes their name and link to their profile.
     * @param String $filter
     * @return array
     */
    public static function driversOnMap($filter = null)
    {
        $drivers = [];
        $info = [];
        $driverWithFilter = Driver::with('user')
            ->where('approve', true);

        // Apply filter on drivers
        switch ($filter) {
            case 'online':
                $driverWithFilter = $driverWithFilter->online()->get();
                break;
            case 'offline':
                $driverWithFilter = $driverWithFilter->offline()->get();
                break;
            case 'onway':
                $driverWithFilter = $driverWithFilter->onway()->get();
                break;
            default:
                $driverWithFilter = $driverWithFilter->get();
                break;
        }
        foreach ($driverWithFilter as $driver) {
            $drivers[] = $driver->lastLatLng();
            $info[] = '<p><a target="_blank" href="' . route('drivers.show', ['driver' => $driver]) . '">' . (($driver->first_name == '') ? 'empty' : $driver->first_name) . ' ' . (($driver->last_name == '') ? 'empty' : $driver->last_name) . '</a></p>';
        }
        return [
            'drivers' => $drivers,
            'info' => $info,
        ];
    }

    /**
     * Show drivers on maps includes their name and link to their profile.
     * @param \App\Driver $driver
     * @param String $filter
     * @return array
     */
    public static function driverOnMap(Driver $driver, $filter = null)
    {
        $info = '<p><a target="_blank" href="' . route('drivers.show', ['driver' => $driver]) . '">' .
            (($driver->first_name == '') ? 'empty' : $driver->first_name) . ' ' .
            (($driver->last_name == '') ? 'empty' : $driver->last_name) . '</a></p>';
        $driver = [$driver->lastLatLng()];
        return [
            'driver' => $driver,
            'info' => [$info],
        ];
    }

    /**
     * Return a new location id that has been saved.
     *
     * @param  decimal $lat
     * @param  decimal $long
     * @param  string $name
     * @return integer Location id
     */
    public static function set($lat, $long, $userId = null, $name = '')
    {
        if ($name == '') {
            $name = self::getGeocoding($lat, $long);
        }

        if (is_null($userId)) {
            $user = Auth::user();
        } else {
            $user = User::find($userId);
        }

        Cache::forever(config('app.name') . '_location_' . $user->id, ['lat' => $lat, 'lng' => $long]);
        $location = $user->locations()->create([
            'latitude' => $lat,
            'longitude' => $long,
            'name' => $name,
        ]);

        if ($user->role == 'driver') {
            $user->driver->first()->forceFill([
                'latitude'  => $lat,
                'longitude' => $long,
            ])->save();
        }

        // Set status if is driver
        $status = self::getLastStatusOfTrip($user);
        if ($status) {
            $location['status'] = $status;
        } elseif ($user->role == 'driver') {
            $location['status'] = null;
        }
        return $location;
    }

    /**
     * Get Geocoding name.
     * @param  decimal $lat
     * @param  decimal $long
     * @return string
     */
    public static function getGeocoding($lat, $long)
    {
        $name = GoogleMaps::load('geocoding')
            ->setParamByKey('latlng', $lat . ',' . $long)
            ->setParamByKey('mode', 'driving')
            ->setParamByKey('language', 'FA')
            ->setParamByKey('traffic_model', 'best_guess')
            ->get('results.formatted_address');
        (isset($name['results'][0]['formatted_address'])) ? $name = $name['results'][0]['formatted_address'] : '';

        if (@$name['status'] == 'ZERO_RESULTS') {
            $name = 'NO RESULT';
        }

        return $name;
    }

    /**
     * Get the last status value of the driver trip.
     * @param  \App\User $user
     * @return string|boolean
     */
    private static function getLastStatusOfTrip($user)
    {
        if ($user->role == 'driver') {
            if (is_null($trip = $user->driver()->first()->trips()
                // 10:cancel_request_taxi, 5:no_driver, 4:reject_client_found, 11:cancel_onway_driver,
                // 8:driver_reject_started_trip, 13:client_canceled_arrived_driver,
                // 14:driver_cancel_arrived_status, 17:trip_is_over, 18:trip_is_over_by_admin, 3:no_response
                ->whereNotIn('status_id', [10, 5, 4, 11, 8, 13, 14, 17, 18, 3])->orderBy('id', 'desc')->first())) {
                return false;
            } else {
                return $trip->status_id;
            }
        } else {
            return false;
        }
    }
}
