<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use App\Repositories\TripRepository;

class FlotLineComposer
{
    /**
     * Driver repository instance
     * @var App\Repositories\TripRepository
     */
    private $trips;

    public function __construct(TripRepository $trips)
    {
        $this->trips = $trips;
    }
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('dailyFinishedTripsOnMonth', js_json($this->trips->dailyFinishedTripsOnMonth()));
    }
}