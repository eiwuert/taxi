<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendDriverNotification;
use DB;
use Auth;
use App\User;
use Validator;
use App\Driver;
use App\UserMeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Repositories\FilterRepository;
use App\Http\Requests\Admin\DriverRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\ExportRepository as Export;


class DriverController extends Controller
{
    /**
     * List of drivers.
     * @var \App\Driver
     */
    private $drivers;

    public function __construct()
    {
        $this->middleware('states')->only('update');
        $this->drivers = Driver::select('drivers.*', 'users.phone')
                            ->join('users', 'drivers.user_id', '=', 'users.id')
                            ->whereVerified(true)
                            ->orderBy('drivers.created_at', 'desc');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $drivers = $this->drivers->paginate(config('admin.perPage'));
        if (@$request->export) {
            if (is_null($request->type)) {
                $request->type = 'pdf';
            }
            return Export::from('Index', $drivers->toArray()['data'], $request->type);
        } else {
            return view('admin.drivers.index', compact('drivers'));
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, Driver $driver)
    {
        $this->uploadDocuments($request->documents, $driver->user->id);
        $driver->update($request->all());
        flash(__('admin/general.Driver updated'), 'success');
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
        flash(__('admin/general.Driver soft deleted'), 'success');
        return redirect(route('drivers.index'));
    }

    /**
     * Approve a driver.
     * @param  \App\Driver $driver
     * @return Illuminate\Support\Facades\Redirect
     */
    public function approve(Driver $driver)
    {
        // If driver info is not complete
        if (! empty($driver->summary())) {
            return back();
        }
        $driver = Driver::whereId($driver->id)->firstOrFail();
        $driver->approve = true;
        $driver->online = false;
        $driver->available = false;
        $driver->update();
        dispatch(new SendDriverNotification('driver_approved_by_admin', '9', $driver->device_token));
        flash(__('admin/general.Driver approved'), 'success');
        return back();
    }

    /**
     * Decline a driver.
     * @param  \App\Driver $driver
     * @return Illuminate\Support\Facades\Redirect
     */
    public function decline(Driver $driver)
    {
        $driver = Driver::whereId($driver->id)->firstOrFail();
        $driver->approve = false;
        $driver->online = false;
        $driver->available = false;
        $driver->update();
        dispatch(new SendDriverNotification('driver_disapproved_by_admin', '10', $driver->device_token));
        flash(__('admin/general.Driver declined'), 'success');
        return back();
    }

    /**
     * Filter status modes.
     * @param  App\Http\Requests\Request $request
     * @return Illuminate\Http\Response
     */
    public function filter(Request $request, Driver $drivers)
    {
        // $drivers = $drivers->join('')
        if ($request->status == 'online') {
            // online
            $drivers = Driver::online();
        } elseif ($request->status == 'offline') {
            // offline
            $drivers = Driver::offline();
        } elseif ($request->status == 'onway') {
            // onway
            $drivers = Driver::onway();
        } elseif ($request->status == 'inapprove') {
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
            $drivers = $drivers->paginate(option('pagination', 15));
        }

        if (@$request->export) {
            if (is_null($request->type)) {
                $request->type = 'pdf';
            }
            return Export::from('Filters', $drivers->toArray()['data'], $request->type);
        } else {
            return view('admin.drivers.index', compact('drivers'));
        }
    }

    /**
     * Search on everything
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // No space after and before the query
        $q = trim($request->q);
        $q = convert_back($q);

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
                        ->paginate(option('pagination', 15));

        if (@$request->export) {
            if (is_null($request->type)) {
                $request->type = 'pdf';
            }
            return Export::from('Search', $drivers->toArray()['data'], $request->type);
        } else {
            return view('admin.drivers.index', compact('drivers'));
        }
    }

    /**
     * Make an driver offline manually
     * @return Illuminate\Http\Response
     */
    public function offline(Driver $driver)
    {
        if (! $this->canChangeState($driver)) {
            return response('', 409);
        }
        // $driver->online = false;
        // $driver->available = false;
        $driver->forceFill(['online' => false, 'available' => false])->save();
        return response('', 200);
    }

    /**
     * Make an driver online manually
     * @return Illuminate\Http\Response
     */
    public function online(Driver $driver)
    {
        if (! $this->canChangeState($driver)) {
            return response('', 409);
        }
        $driver->forceFill(['online' => true, 'available' => true])->save();
        return response('', 200);
    }

    /**
     * Can driver change state.
     *
     * @param  \App\Driver $driver
     * @return void|Illuminate\Support\Facades\Redirect
     */
    private function canChangeState($driver)
    {
        if (! is_null($driver->trips())) {
            $trip = $driver->trips()->whereNotIn('status_id', \App\Trip::$ended)->orderBy('id', 'desc')->first();
            if (!is_null($trip)) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Upload driver documentation if exists.
     * @param  Illuminate\Http\UploadedFile $file
     * @param  integer $for
     * @return void
     */
    private function uploadDocuments($file, $for)
    {
        if (is_null($file)) {
            return;
        } else {
            UserMeta::create([
                'name' => 'documents_' . $for,
                'value' => basename($file->store('public/documents/')),
                'user_id' => $for,
            ]);
        }
    }

    /**
     * Delete driver document.
     * @param  Driver $driver
     * @return Illuminate\Support\Facades\Redirect
     */
    public function deletePicture(Driver $driver)
    {
        DB::table('drivers')->where('id', $driver->id)
            ->update(['picture' => 'no-profile.png']);
        flash(__('admin/general.Driver picture deleted'), 'success');
        return redirect(route('drivers.show', ['driver'=>$driver]));
    }

    /**
     * Delete driver document.
     * @param  App\Driver $driver
     * @return Illuminate\Support\Facades\Redirect
     */
    public function deleteDocument(Driver $driver)
    {
        UserMeta::where('user_id', $driver->user->id)->delete();
        flash(__('admin/general.Driver documents deleted'), 'success');
        return redirect(route('drivers.show', ['driver'=>$driver]));
    }
}
