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

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::orderBy('created_at', 'desc')->paginate(config('admin.perPage'));
        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancel($trip)
    {
        flash('Trip ended.', 'success');
        return TripRepository::hardCancel($trip);
    }

    /**
     * Filter trips.
     * @param  string $status
     * @return view
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
            $trips = $trips->paginate(config('admin.perPage'));
        }

        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Search on everything
     * @param  Request $request
     * @return view
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
                        ->paginate(config('admin.perPage'));

        return view('admin.trips.index', compact('trips'));
    }
}
