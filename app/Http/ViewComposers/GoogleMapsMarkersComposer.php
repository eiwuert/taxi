<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Driver;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repositories\LocationRepository;

class GoogleMapsMarkersComposer
{
    /**
     * Driver repository instance
     * @var App\Repositories\LocationRepository
     */
    private $locationRepository;
    private $request;

    public function __construct(LocationRepository $LR, Request $request)
    {
        $this->locationRepository = $LR;
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
        $data = LocationRepository::driversOnMap($this->request->status);
        $view->with('drivers', $data['drivers']);
        $view->with('info', $data['info']);
    }
}
