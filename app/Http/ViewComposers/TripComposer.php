<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use App\Repositories\TripRepository;

class TripComposer
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
        $view->with('countOfFinishedTrips', number_format($this->trips->countOfFinishedTrips()));
        $view->with('countOfCancelledTrips', number_format($this->trips->countOfCancelledTrips()));
    }
}