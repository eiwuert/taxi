<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Status;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repositories\TripRepository;

class FlotLineComposer
{
    /**
     * Driver repository instance
     * @var App\Repositories\TripRepository
     */
    private $trips;

    public function __construct(TripRepository $trips, Request $request)
    {
        $this->trips = $trips;
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
        if ($this->applicableFilter()) {
            $view->with('dailyFinishedTripsOnMonth', js_json($this->trips->dailyFinishedTripsOnMonth($this->request->status)));
        } else {
            $view->with('dailyFinishedTripsOnMonth', js_json($this->trips->dailyFinishedTripsOnMonth()));
        }
    }

    /**
     * Check if the filter is applicable.
     * @return boolean
     */
    private function applicableFilter()
    {
        if (Status::whereName($this->request->status)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}