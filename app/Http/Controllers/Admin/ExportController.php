<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ExportRepository as Export;

class ExportController extends Controller
{
    public function export($name, Request $request)
    {
        if (!is_null($request->model)) {
            if (is_null($request->type)) {
                $request->type = 'pdf';
            }
            if (is_null($request->sheet)) {
                $request->sheet = 'sheet';
            }
            return Export::from($name, $request->model, $request->type, $request->sheet);
        } else {
            return redirect()->back();
        }
    }
}
