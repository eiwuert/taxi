<?php

namespace App\Http\Controllers\setting;

use App\Sms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    public function index()
    {
        $codes = Sms::orderBy('id', 'desc')->paginate((int) option('pagination', 15));
        return view('admin.settings.sms', compact('codes'));
    }
}
