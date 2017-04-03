<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Repositories\FilterRepository;
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
                           ->paginate(option('pagination', 15));
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
        $payments = $payments->orderBy('id', 'desc')->paginate(option('pagination', 15));
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show one payment record with details.
     * @return Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        if ($payment->purpose() == 'Trip') {
            return view('admin.payments.show', compact('payment'));
        } else {
            return view('admin.payments.charge', compact('payment'));
        }
    }

    /**
     * Show all drivers.
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function drivers(Request $request)
    {
        $drivers = Driver::with('trips')
                        ->orderBy('id', 'desc');

        if (isset($request->sortby) && isset($request->orderby) 
            && array_key_exists($request->sortby, Driver::$sortable)) {
            $drivers = $drivers->orderBy($request->sortby, $request->orderby);
        }

        if (isset($request->date_range)) {
            $drivers = FilterRepository::daterange($request->date_range, $drivers);
        }

        if (isset($request->count)) {
            if ($request->count == 15 || $request->count == 30) {
                $drivers = $drivers->paginate($request->count);
            } else {
                $drivers = $drivers->paginate(Driver::count());
            }
        } else {
            $drivers = $drivers->paginate(option('pagination', 15));
        }

        return view('admin.payments.drivers', compact('drivers'));
    }

    /**
     * Get individual trips details.
     * @param  App\Driver  $driver 
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function trips(Driver $driver, Request $request)
    {
        $filters = [];
        foreach (explode('&', $request->filters) as $chunk) {
            $param = explode("=", $chunk);

            if ($param) {
                $filters[@$param[0]] = @$param[1];
            }
        }
        $payments = Payment::orderBy('id', 'desc')
                           ->whereIn('trip_id', $driver->trips()
                                                       ->range(@$filters['date_range'])
                                                       ->get(['id'])
                                                       ->flatten())
                           ->paginate(option('pagination', 15));
        return view('admin.payments.trips', compact('payments', 'driver'));
    }
}
