<?php

namespace App\Listeners;

use DB;
use App\Transaction;
use App\Events\RideAccepted;
use App\Logics\TransactionLogic;
use Illuminate\Queue\InteractsWithQueue;
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
        $transaction = new TransactionLogic($event->type, $event->currency);
        $invoice = $transaction->new($event->trip);
        $transaction = $event->trip->transaction()->create($invoice);
        DB::table('trips')->whereId($event->trip->id)
                          ->update(['transaction_id' => $transaction->id]);
    }
}
