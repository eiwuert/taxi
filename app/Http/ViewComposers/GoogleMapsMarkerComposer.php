<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Driver;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repositories\LocationRepository;

class GoogleMapsMarkerComposer
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Bind data to the view.
     *
     * @param  Illuminate\Support\Facades\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $segments = $this->request->segments();
        $data = LocationRepository::driverOnMap($driverModel = Driver::find(end($segments)));
        $view->with('driver', $data['driver']);
        $view->with('info', $data['info']);
        $view->with('icon', $data['icon']);
        $view->with('driverModel', $driverModel);
    }
}
