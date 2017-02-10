<?php

namespace App\Http\ViewComposers;

use Auth;
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
        $view->with('countOfFinishedTrips', TripRepository::countOfFinishedTrips());
        $view->with('countOfCancelledTrips', TripRepository::countOfCancelledTrips());
        $view->with('progress', TripRepository::calculateTripPercentages());
    }
}