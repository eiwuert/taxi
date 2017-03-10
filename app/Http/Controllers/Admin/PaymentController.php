<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show pagination of payments.
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')
                           ->paginate(config('admin.perPage'));
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Filter status modes.
     * @param  string $status
     * @return view
     */
    public function filter(Request $request)
    {
        if ($request->status == 'cash') {
            $payments = Payment::cash();
        } elseif ($request->status == 'wallet') {
            $payments = Payment::wallet();
        } else {
            $payments = Payment::charge();
        }
        $payments = $payments->orderBy('id', 'desc')->paginate(config('admin.perPage'));
        return view('admin.payments.index', compact('payments'));
    }
}
