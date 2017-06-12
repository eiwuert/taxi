<?php

namespace App\Http\ViewComposers;

use App\Client;
use Illuminate\View\View;

class LatestClientsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('clients', Client::orderBy('id', 'desc')->limit(config('admin.perPage'))->get());
    }
}
