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
        $clients = number_format(\App\Client::count());
        $drivers = number_format(\App\Driver::count());
        $tripCount = Trip::count();
        $trips   = is_object($tripCount) ? 0 : $tripCount;
        $income  = number_format($transaction->income());

        return view('admin.dashboard', compact('clients', 'drivers', 'trips', 'income'));
    }

    /**
     * Switch language between en and fa.
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function switchLang()
    {
        $lang = \Request::segment(1);
        if ($lang == 'fa') {
            return redirect()->to('en/admin/dashboard');
        } else {
            return redirect()->to('fa/admin/dashboard');
        }
    }
}
