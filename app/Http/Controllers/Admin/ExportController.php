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
            return Export::from($name, $request->model, $request->type ?? 'pdf', $request->sheet ?? 'sheet');
        } else {
            return redirect()->back();
        }
    }
}
