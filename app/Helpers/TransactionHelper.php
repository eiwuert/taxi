<?php

namespace App\Helpers;

use DB;
use App\Transaction;
use App\Helpers\Contracts\TransactionContract;

class TransactionHelper implements TransactionContract
{
    public function income()
    {
        return DB::table('transactions')
                    ->join('trips', 'transactions.trip_id', '=', 'trips.id')
                    ->select(['total'])
                    ->whereIn('status_id', [9, 15, 16, 17])
                    ->sum('total');
    }
}