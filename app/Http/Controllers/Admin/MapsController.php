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
     * Get drivers info as json.
     * @return json
     */
    public function getDriversJson(Request $request)
    {
        return LocationRepository::driversOnMap($request->status);
    }
}
