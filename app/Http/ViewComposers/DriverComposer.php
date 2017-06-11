<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use App\Repositories\DriverRepository;

class DriverComposer
{
    /**
     * Driver repository instance
     * @var App\Repositories\DriverRepository
     */
    private $drivers;

    public function __construct(DriverRepository $drivers)
    {
        $this->drivers = $drivers;
    }
    /**
     * Bind data to the view.
     *
     * @param  Illuminate\Support\Facades\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countOfTotalDrivers', number_format($this->drivers->countOfTotalDrivers()));
        $view->with('countOfOnlineDrivers', number_format($this->drivers->countOfOnlineDrivers()));
        $view->with('countOfOnWayDrivers', number_format($this->drivers->countOfOnWayDrivers()));
        $view->with('countOfOfflineDrivers', number_format($this->drivers->countOfOfflineDrivers()));
        $view->with('countOfInapproveDrivers', number_format($this->drivers->countOfInapproveDrivers()));
    }
}