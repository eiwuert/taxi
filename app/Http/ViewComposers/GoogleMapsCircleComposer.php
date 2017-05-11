<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\ZoneRepository;

class GoogleMapsCircleComposer
{
    /**
     * Bind data to the view.
     *
     * @param  Illuminate\Support\Facades\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $zones = ZoneRepository::cities();
        $view->with('cities', $zones);
    }
}
