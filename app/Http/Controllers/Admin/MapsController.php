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
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.maps.index');
    }

    /**
     * Go full screen for Google maps.
     * @return Illuminate\Http\Response
     */
    public function fullscreen()
    {
        return view('admin.maps.fullscreen')->withBody('sidebar-collapse');
    }

    /**
     * Go full screen for Google maps.
     * @return Illuminate\Http\Response
     */
    public function track(Driver $driver)
    {
        return view('admin.maps.track', compact('driver'))->withBody('sidebar-collapse');
    }

    /**
     * Get drivers info as json.
     * @return json
     */
    public function getDriversJson(Request $request)
    {
        return LocationRepository::driversOnMap($request->status);
    }

    /**
     * Get driver info as json.
     * @return json
     */
    public function getDriverJson(Driver $driver, Request $request)
    {
        return LocationRepository::driverOnMap($driver, $request->status);
    }
}
