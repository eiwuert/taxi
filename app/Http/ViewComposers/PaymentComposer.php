<?php

namespace App\Http\ViewComposers;

use App\Payment;
use Illuminate\View\View;

class PaymentComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countOfCash', Payment::cash()->count());
        $view->with('countOfWallet', Payment::wallet()->count());
        $view->with('countOfCharge', Payment::charge()->count());
    }
}
