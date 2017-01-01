<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use App\Trip;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Contracts\TransactionContract;

class DashboardController extends Controller
{
	/**
	 * Dashboard page.
	 * @return view
	 */
    public function index(TransactionContract $transaction)
    {
    	$clients = number_format(User::clientsCount());
    	$drivers = number_format(User::driversCount());
    	$trips   = number_format(Trip::finishedCount());
    	$income  = number_format($transaction->income(), 2);

    	return view('admin.dashboard', compact('clients', 'drivers', 'trips', 'income'));
    }
}
