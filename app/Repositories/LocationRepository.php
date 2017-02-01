<?php

namespace App\Repositories;

use Auth;
use Cache;
use App\User;
use GoogleMaps;
use App\Driver;

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
        $driverWithFilter = Driver::with('user', 'user.locations');

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
     * Return a new location id that has been saved.
     *
     * @param  decimal  $lat
     * @param  decimal  $long
     * @param  string   $name
     * @return integer Location id
     */
    public static function set($lat, $long, $userId = null, $name = '')
    {
        if ($name == '') {
            $name = GoogleMaps::load('geocoding')
                              ->setParamByKey('latlng', $lat . ',' . $long)
                              ->setParamByKey('mode', 'driving')
                              ->setParamByKey('language', 'FA')
                              ->setParamByKey('traffic_model', 'best_guess')
                              ->get('results.formatted_address');
            (isset($name['results'][0]['formatted_address'])) ? $name = $name['results'][0]['formatted_address'] : '';
        }

        if (@$name['status'] == 'ZERO_RESULTS') {
            $name = 'NO RESULT';
        }

        if (is_null($userId)) {
            $user = Auth::user();
        } else {
            $user = User::find($userId);
        }
        Cache::forever('location_' . $user->id, ['lat' => $lat, 'lng' => $long]);
        return $user->locations()->create([
                    'latitude'  => $lat,
                    'longitude' => $long,
                    'name'      => $name,
                ]);
    }

    /**
     * Get Gelcoding name.
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
}
