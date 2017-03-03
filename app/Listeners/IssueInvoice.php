<?php

namespace App\Listeners;

use DB;
use App\Transaction;
use App\Events\TripInitiated;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\TransactionRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class IssueInvoice
{
    /**
     * Handle the event.
     *
     * @param  TripInitiated  $event
     * @return void
     */
    public function handle(TripInitiated $event)
    {
        $transaction = new TransactionRepository();
        $invoice = $transaction->newTransaction($event->trip, $event->trip->driver->user->car->type->name, 
                                                $event->request['currency']);
        $transaction = $event->trip->transaction()->create($invoice);
    }
}
