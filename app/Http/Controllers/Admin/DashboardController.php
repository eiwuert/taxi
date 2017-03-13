<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use App\Trip;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;

class DashboardController extends Controller
{
    /**
     * Dashboard page.
     * @param App\Repositories\TransactionRepository $transaction
     * @return Illuminate\Foundation\Http\response
     */
    public function index(TransactionRepository $transaction)
    {
        $clients = number_format(is_object($count = User::clientsCount())?0:$count);
        $drivers = number_format(is_object($count = User::driversCount())?0:$count);
        $tripCount = Trip::count();
        $trips   = is_object($tripCount) ? 0 : $tripCount;
        $income  = number_format($transaction->income(), 2);

        return view('admin.dashboard', compact('clients', 'drivers', 'trips', 'income'));
    }
}
