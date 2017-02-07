<?php

namespace App\Http\Controllers\Admin\Setting;

use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    /**
     * Print log file.
     * @return view
     */
    public function index()
    {
        // Log file directory.
        $string = File::get(storage_path() . '/logs/laravel.log');
        $logs = preg_split("/\[[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}\]/", $string);
        // Empty
        unset($logs[0]);
        $logs = array_reverse($logs);
        return view('admin.settings.logs', compact('logs'));
    }
}
