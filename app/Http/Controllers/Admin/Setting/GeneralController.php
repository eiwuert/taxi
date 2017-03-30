<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    /**
     * Show general setting to the user.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::orderBy('id', 'desc')->get();
        return view('admin.settings.general', compact('options'));
    }

    public function update(Request $request)
    {
        Option::findAndUpdate($request->except(['_method', '_token']));
        flash('Settings updated.');
        return redirect()->back();
    }
}
