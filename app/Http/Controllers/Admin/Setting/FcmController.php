<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Fcm;
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
                    ->paginate(config('admin.perPage'), $projections);
        return view('admin.settings.fcm', compact('logs'));
    }
}
