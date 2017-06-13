<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Sms;
use SoapClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    /**
     * Show all codes.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Sms::orderBy('id', 'desc')->paginate(option('pagination', 15));
        return view('admin.settings.sms', compact('codes'));
    }
}
