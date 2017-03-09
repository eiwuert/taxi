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
     * @param  Illuminate\Support\Facades\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countOfFinishedTrips', is_object(Trip::finishedCount()) ? 0 : Trip::finishedCount());
        $view->with('countOfCancelledTrips', is_object(Trip::canceledCount()) ? 0 : Trip::canceledCount());
        $view->with('progress', TripRepository::calculateTripPercentages());
    }
}