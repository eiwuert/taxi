<?php

namespace App\Listeners;

use DB;
use App\Transaction;
use App\Events\RideAccepted;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\TransactionRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class IssueInvoice
{
    private $transaction;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  RideAccepted  $event
     * @return void
     */
    public function handle(RideAccepted $event)
    {
        $transaction = new TransactionRepository();
        $invoice = $transaction->newTransaction($event->trip, $event->type, $event->currency);
        $transaction = $event->trip->transaction()->create($invoice);
    }
}
