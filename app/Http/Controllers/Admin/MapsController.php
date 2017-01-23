<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;

class MapsController extends Controller
{
    /**
     * Show all available drivers on the map.
     * @return view
     */
    public function index()
    {
        return view('admin.maps.index');
    }

    /**
     * Go full screen for Google maps.
     * @return view
     */
    public function fullscreen(Request $request)
    {
        return view('admin.maps.fullscreen')->withBody('sidebar-collapse');
    }

    /**
     * Get drivers info.
     * @return array
     */
    private function getDrivers($request)
    {
        // return LocationRepository::driversOnMap($request->status);
        $drivers = [];
        $info = [];
        $id = [];
        $filteredDrivers = Driver::with('user', 'user.locations');
        if ($request->status == 'online') {
            // online
            $filteredDrivers = $filteredDrivers->online()->get();
        } else if ($request->status == 'offline') {
            // offline
            $filteredDrivers = $filteredDrivers->offline()->get();
        } else if ($request->status == 'onway') {
            // onway
            $filteredDrivers = $filteredDrivers->onway()->get();
        } else {
            // All
            $filteredDrivers = $filteredDrivers->get();
        }
        foreach ($filteredDrivers as $fd) {
            $drivers[] = $fd->lastLatLng();
            $info[] = '<p><a target="_blank" href="' . route('drivers.show', ['driver' => $fd]) . '">' . $fd->first_name . ' ' . $fd->last_name . '</a></p>';
        }
        return [
            'drivers' => $drivers,
            'info' => $info,
        ];
    }

    /**
     * Get drivers info as json.
     * @return json
     */
    public function getDriversJson(Request $request)
    {
        return $this->getDrivers($request);
    }

    /**
     * Get driver info as json.
     * @return json
     */
    public function getDriverJson(Driver $driver)
    {
        return [
            $driver->lastLatLng(),
        ];
    }
}
