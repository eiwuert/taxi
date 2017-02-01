<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Validator;
use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FilterRepository;
use App\Http\Requests\Admin\DriverRequest;

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
        // It's showing within the index page.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, Driver $driver)
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
        return back();
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
        return back();
    }

    /**
     * Filter status modes.
     * @param  string $status
     * @return view
     */
    public function filter(Request $request, Driver $drivers)
    {
        $drivers = $drivers->with('user');
        if ($request->status == 'online') {
            // online
            $drivers = Driver::online();
        } else if ($request->status == 'offline') {
            // offline
            $drivers = Driver::offline();
        } else if ($request->status == 'onway') {
            // onway
            $drivers = Driver::onway();
        } else if ($request->status == 'inapprove') {
            // inapprove
            $drivers = Driver::inapprove();
        }

        if (isset($request->sortby) && isset($request->orderby) && array_key_exists($request->sortby, Driver::$sortable)) {
            $drivers = $drivers->orderBy($request->sortby, $request->orderby);
        }

        if (isset($request->ids)) {
            $ids = explode(',', str_replace(' ', '', $request->ids));
            // If ids are set of numbers separated with comma 1,2,3,4
            $validate = preg_match('/^[0-9,]+$/', $request->ids);
            if ($validate) {
                $drivers = $drivers->whereIn('id', $ids);
            }
            /**
             * Mark as read notifications for new drivers
             */
            if (isset($request->markAsRead)) {
                Auth::user()->markNewDriversNotificationsAsRead();
            }
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
            $drivers = $drivers->paginate(config('admin.perPage'));
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

        $drivers = Driver::where('first_name', 'ilike', "%$q%")
                        ->orWhere('last_name', 'ilike', "%$q%")
                        ->orWhere('email', 'ilike', "%$q%")
                        ->orWhere('gender', 'ilike', "%$q%")
                        ->orWhere('state', 'ilike', "%$q%")
                        ->orWhere('country', 'ilike', "%$q%")
                        ->orWhere('address', 'ilike', "%$q%")
                        ->orWhere('zipcode', 'ilike', "%$q%")
                        ->orWhereIn('user_id', User::where('phone', 'ilike', "%$q%")
                                                    ->get(['id'])->flatten())
                        ->paginate(config('admin.perPage'));

        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Make an driver offline manually
     * @return view
     */
    public function offline(Driver $driver)
    {
        $driver = Driver::whereId($driver->id)->firstOrFail();
        $driver->online = false;
        $driver->available = false;
        $driver->update();
        flash('Driver is offline now', 'success');
        return redirect(route('drivers.index'));
    }
}
