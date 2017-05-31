<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Fcm;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FcmController extends Controller
{
    /**
     * Show FCM logs.
     * @return [type] [description]
     */
    public function index()
    {
        $projections = ['multicast_id', 'success', 'failure', 'canonical_ids',
        'results', 'head', 'device_token', 'title', 'message'];
        $logs = Fcm::orderBy('_id', 'desc')
                    ->paginate((int) option('pagination', 15), $projections);
        return view('admin.settings.fcm', compact('logs'));
    }

    /**
     * Search on everything
     * @param  Illuminate\Http\Request $request
     * @return view
     */
    public function search(Request $request)
    {
        // No space after and before the query
        $q = trim($request->q);

        $logs = Fcm::where('multicast_id', 'like', "%$q%")
            ->orWhere('canonical_ids', 'like', "%$q%")
            ->orWhere('head', 'like', "%$q%")
            ->orWhere('device_token', 'like', "%$q%")
            ->orWhere('title', 'like', "%$q%")
            ->orWhere('message', 'like', "%$q%")
            ->orWhere('created_at', 'like', "%$q%")
            ->orWhere('zipcode', 'like', "%$q%")
            ->paginate(option('pagination', 15));

        return view('admin.settings.fcm', compact('logs'));
    }

    /**
     * Filter status modes.
     * @param  string $status
     * @return view
     */
    public function filter(Request $request, Fcm $logs)
    {

        if (isset($request->sortby) && isset($request->orderby) && array_key_exists($request->sortby, Fcm::$sortable)) {
            $logs = $logs->orderBy($request->sortby, $request->orderby);
        }
/*
        if (isset($request->date_range)) {
            $logs = FilterRepository::daterange($request->date_range, $logs);
        }*/

        if (isset($request->count)) {
            if ($request->count == 15 || $request->count == 30|| $request->count == 100) {
                $logs = $logs->paginate((integer)$request->count);
            } else {
                $logs = $logs->paginate(Fcm::count());
            }
        } else {
            $logs = $logs->paginate(option('pagination', 15));
        }

        return view('admin.settings.fcm', compact('logs'));
    }
}
