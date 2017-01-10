<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::paginate(config('admin.perPage'));
        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Driver cannot be registered through web application at current moment they should go and
        // register through the mobile application.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // No creation.
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        return view('admin.drivers.show', compact('driver'));
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
    public function update(Request $request, Driver $driver)
    {
        $driver->update($request->all());
        flash('Driver updated', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        flash('Driver soft deleted', 'success');
        return redirect(route('drivers.index'));
    }

    /**
     * Approve a driver.
     * @param  \App\Driver $driver
     * @return redirect
     */
    public function approve(Driver $driver)
    {
        $driver = Driver::whereId($driver->id)->firstOrFail();
        $driver->approve = true;
        $driver->online = false;
        $driver->available = false;
        $driver->update();
        flash('Driver approved', 'success');
        return redirect(route('drivers.index'));
    }

    /**
     * Decline a driver.
     * @param  \App\Driver $driver
     * @return redirect
     */
    public function decline(Driver $driver)
    {
        $driver = Driver::whereId($driver->id)->firstOrFail();
        $driver->approve = false;
        $driver->online = false;
        $driver->available = false;
        $driver->update();
        flash('Driver declined', 'success');
        return redirect(route('drivers.index'));
    }

    /**
     * Filter status modes.
     * @param  string $status
     * @return view
     */
    public function status(Request $request)
    {
        if ($request->status == 'online') {
            // online
            $drivers = Driver::online()->paginate(config('admin.perPage'));
        } else if ($request->status == 'offline') {
            // offline
            $drivers = Driver::offline()->paginate(config('admin.perPage'));
        } else if ($request->status == 'onway') {
            // onway
            $drivers = Driver::onway()->paginate(config('admin.perPage'));
        } else if ($request->status == 'inapprove') {
            // inapprove
            $drivers = Driver::inapprove()->paginate(config('admin.perPage'));
        } else {
            $drivers = Driver::paginate(config('admin.perPage'));
        }
        
        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Search on everything
     * @param  Request $request
     * @return view
     */
    public function search(Request $request)
    {
        // No space after and before the query
        $q = trim($request->q);

        $drivers = Driver::where('first_name', 'like', "%$q%")
                        ->orWhere('last_name', 'like', "%$q%")
                        ->orWhere('gender', 'like', "%$q%")
                        ->orWhere('state', 'like', "%$q%")
                        ->orWhere('country', 'like', "%$q%")
                        ->orWhere('address', 'like', "%$q%")
                        ->orWhere('zipcode', 'like', "%$q%")
                        ->orWhereIn('user_id', User::where('phone', 'like', "%$q%")
                                                    ->get(['id'])->flatten())
                        ->paginate(config('admin.perPage'));

        return view('admin.drivers.index', compact('drivers'));
    }
}
