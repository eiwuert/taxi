<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Trip;
use Illuminate\View\View;
use App\Repositories\TripRepository;

class TripComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countOfFinishedTrips', (int) (Trip::finishedCount()));
        $view->with('countOfCancelledTrips', (int) (Trip::canceledCount()));
        $view->with('progress', TripRepository::calculateTripPercentages());
    }
}