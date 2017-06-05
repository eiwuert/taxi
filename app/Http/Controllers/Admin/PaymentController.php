<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FilterRepository;
use App\Repositories\ExportRepository as Export;

class PaymentController extends Controller
{
    /**
     * Show pagination of payments.
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payments = Payment::orderBy('id', 'desc')
                           ->paginate(option('pagination', 15));
        if (@$request->export) {
            if (is_null($request->type)) {
                $request->type = 'pdf';
            }
            return Export::from('Index', $payments->toArray()['data'], $request->type);
        } else {
            return view('admin.payments.index', compact('payments'));
        }
    }

    /**
     * Filter status modes.
     * @param  string $status
     * @return view
     */
    public function filter(Request $request)
    {
        $payments = new Payment();
        if ($request->status == 'cash') {
            $payments = Payment::cash();
        } elseif ($request->status == 'wallet') {
            $payments = Payment::wallet();
        } elseif ($request->status == 'charge') {
            $payments = Payment::charge();
        }

        if (isset($request->date_range)) {
            $payments = FilterRepository::daterange($request->date_range, $payments);
        }


        if (isset($request->count)) {
            if ($request->count == 15 || $request->count == 30) {
                $payments = $payments->paginate($request->count);
            } else {
                $payments = $payments->paginate(Payment::count());
            }
        } else {
            $payments = $payments->orderBy('id', 'desc')->paginate(option('pagination', 15));
        }

        if (@$request->export) {
            if (is_null($request->type)) {
                $request->type = 'pdf';
            }
            return Export::from('Filters', $payments->toArray()['data'], $request->type);
        } else {
            return view('admin.payments.index', compact('payments'));
        }
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
        $accountings = $driver->accounting()->orderby('id', 'desc')->get();
        if (@$request->export) {
            if (is_null($request->type)) {
                $request->type = 'pdf';
            }
            return Export::from('Payment of the ' . $driver->first_name . ' ' . $driver->last_name, $payments->toArray()['data'], $request->type);
        } else {
            return view('admin.payments.trips', compact('payments', 'driver', 'accountings'));
        }
    }

    /**
     * Filter status modes.
     * @param  string $status
     * @return view
     */
    public function filterTrips(Driver $driver, Request $request)
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
                                                       ->flatten());

        if (isset($request->date_range)) {
            $payments = FilterRepository::daterange($request->date_range, $payments);
        }


        if (isset($request->count)) {
            if ($request->count == 15 || $request->count == 30) {
                $payments = $payments->paginate($request->count);
            } else {
                $payments = $payments->paginate(Payment::count());
            }
        } else {
            $payments = $payments->orderBy('id', 'desc')->paginate(option('pagination', 15));
        }
        if (@$request->export) {
            foreach($payments as $payment) {
                $payment['for'] = $payment->purpose();
                $payment['client'] = $payment->trip->client->first_name . ' ' . $payment->trip->client->last_name;
                $payment['driver'] = $payment->trip->driver->first_name . ' ' . $payment->trip->driver->last_name;
                $payment['amount'] = $payment->amount();
                $payment['paid']   = $payment->paid ? 'ok' : 'fail';
                $payment['detail'] = print_r($payment->detail);
                unset($payment['trip']);
            }
            if (is_null($request->type)) {
                $request->type = 'pdf';
            }
            return Export::from('Payment of the ' . $driver->first_name . ' ' . $driver->last_name, $payments->toArray()['data'], $request->type);
        } else {
            return view('admin.payments.trips', compact('payments', 'driver'));
        }
    }
}
