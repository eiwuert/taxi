<?php

namespace App\Http\ViewComposers;

use App\Driver;
use Illuminate\View\View;

class LatestDriversComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('drivers', Driver::orderBy('id', 'desc')->limit(config('admin.perPage'))->get());
    }
}
