<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Trip;
use App\User;
use App\Client;
use App\Driver;
use App\Status;
use App\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Repositories\FilterRepository;
use App\Repositories\ExportRepository as Export;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trips = Trip::orderBy('created_at', 'desc')->paginate(option('pagination', 15));
        if (@$request->export) {
            return Export::from('Index', $trips->toArray()['data'], $request->type ?? 'pdf');
        } else {
            return view('admin.trips.index', compact('trips'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        $trip->with(['driver', 'client', 'driver.user', 'client.user', 'driver.trips', 'client.trips', 'transaction']);
        return view('admin.trips.show', compact('trip'));
    }

    /**
     * Hard cancel the trip by the admin.
     * 
     * @param  \App\Trip $trip
     * @return \App\Repositories\TripRepository
     */
    public function cancel($trip)
    {
        flash('Trip ended.', 'success');
        return TripRepository::hardCancel($trip);
    }

    /**
     * Filter trips.
     * @param  string $status
     * @return Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $trips = new Trip();

        if (isset($request->date_range)) {
            $trips = FilterRepository::daterange($request->date_range, $trips);
        }

        if (isset($request->status) && array_key_exists($request->status, Trip::$status) && $request->status != 'all') {
            $trips = $trips->whereStatusId(Status::whereName($request->status)->firstOrFail()->id);
        }

        if (isset($request->sortby) && isset($request->orderby) && array_key_exists($request->sortby, Trip::$sortable)) {
            $trips = $trips->orderBy($request->sortby, $request->orderby);
        }

        if (isset($request->count)) {
            if ($request->count == 15 || $request->count == 30) {
                $trips = $trips->paginate($request->count);
            } else {
                $trips = $trips->paginate(Trip::count());
            }
        } else {
            $trips = $trips->paginate(option('pagination', 15));
        }

        if (@$request->export) {
            return Export::from('Filter', $trips->toArray()['data'], $request->type ?? 'pdf');
        } else {
            return view('admin.trips.index', compact('trips'));
        }
    }

    /**
     * Search on everything
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $q = $request->q;
        $trips = Trip::WhereIn('driver_id', Driver::where('first_name', 'ilike', "%$q%")
                                                    ->orWhere('last_name', 'ilike', "%$q%")
                                                    ->orWhereIn('user_id', User::where('phone', 'ilike', "%$q%")->get(['id'])->flatten())
                                                    ->get(['id'])->flatten())
                        ->orWhereIn('client_id', Client::where('first_name', 'ilike', "%$q%")
                                                    ->orWhere('last_name', 'ilike', "%$q%")
                                                    ->orWhereIn('user_id', User::where('phone', 'ilike', "%$q%")->get(['id'])->flatten())
                                                    ->get(['id'])->flatten())
                        ->WhereIn('source', Location::where('name', 'ilike', "%$q%")
                                                    ->get(['id'])->flatten())
                        ->orWhereIn('destination', Location::where('name', 'ilike', "%$q%")
                                                    ->get(['id'])->flatten())
                        ->paginate(option('pagination', 15));

        if (@$request->export) {
            return Export::from('Search', $trips->toArray()['data'], $request->type ?? 'pdf');
        } else {
            return view('admin.trips.index', compact('trips'));
        }
    }
}
