<?php

namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;

class AdminHeaderComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (is_null(Auth::user()->web())) {
            $view->with('first_name', 'not set');
            $view->with('last_name', 'not set');
        }
        $view->with('first_name', isset(Auth::user()->web->first_name) ? Auth::user()->web->first_name : 'not set');
        $view->with('last_name', isset(Auth::user()->web->last_name) ? Auth::user()->web->last_name : 'not set');
    }
}