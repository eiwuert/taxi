<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    /**
     * Show request log.
     * @return view
     */
    public function index()
    {
        $projections = ['duration', 'url', 'method', 'ip', 'locale', 'languages', 'charsets',
        'encodings', 'isXml', 'proxies', 'parameters'];
        $requests = Requests::orderBy('id', 'desc')
                            ->paginate(config('admin.perPage'), $projections);
        return view('admin.settings.requests', compact('requests'));
    }
}
