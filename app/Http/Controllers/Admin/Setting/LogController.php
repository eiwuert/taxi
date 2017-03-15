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
        $logs = array_slice($logs, 0, 100);
            // ENV
            $logs = preg_replace("/^ [a-z]+/", '<b class="text-primary">${0}</b>', $logs);
            // LEVEL
            $logs = preg_replace_callback("/.[A-Z]+:/", 'static::color', $logs);
            //preg_match("/[a-z]+.[A-Z]+: /", $log, $length);
        return view('admin.settings.logs', compact('logs'));
    }

    private static function color($match)
    {
        $text = trim(strtolower($match[0]));
        $text = str_replace('.', '', $text);
        $text = str_replace(':', '', $text);
        if (str_contains($text, 'error') || str_contains($text, 'emergency') ||
            str_contains($text, 'emergency') || str_contains($text, 'critical')) {
            return '.<b class="text-danger">' . strtoupper($text) . '</b>: ';
        } elseif (str_contains($text, 'alert') || str_contains($text, 'warning') ||
                   str_contains($text, 'alert')) {
            return '.<b class="text-info">' . $text . '</b>: ';
        } else {
            return '.<b class="text-primary">' . $text . '</b>: ';
        }
    }
}
