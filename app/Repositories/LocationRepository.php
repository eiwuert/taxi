<?php

namespace App\Repositories;

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
                $driverWithFilter = $driverWithFilter->offline()->get();
                break;
        }
        foreach ($driverWithFilter as $driver) {
            $drivers[] = $driver->lastLatLng();
            $info[] = '<p><a target="_blank" href="' . route('drivers.show', ['driver' => $driver]) . '">' . ($driver->first_name or 'empty') . ' ' . ($driver->last_name or 'empty') . '</a></p>';
        }
        return [
            'drivers' => str_replace('"', '', json_encode($drivers)),
            'info' => json_encode($info),
        ];
    }
}
