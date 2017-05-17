<?php

namespace App\Http\ViewComposers;

use App\Contact;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countOfContacts', Contact::whereNull('read_at')->count());
    }
}
