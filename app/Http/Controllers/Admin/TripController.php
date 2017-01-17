<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::paginate(config('admin.perPage'));
        $count = DB::table('trips')
                    ->select('status_id', DB::raw('count(*) as total'))
                    ->whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])
                    ->groupby('status_id')
                    ->get();
        $total = Trip::whereBetween('created_at', [Carbon::today()->startOfMonth(), Carbon::today()->endOfMonth()])
                    ->count();
        return view('admin.trips.index', compact('trips', 'count', 'total'));
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
}
