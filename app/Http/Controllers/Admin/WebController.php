<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebRequest;

class WebController extends Controller
{
    /**
     * Show edit form, to edit current admin data.
     * @return Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = Auth::user()->web;
        return view('admin.webs.edit', compact('profile'));
    }

    /**
     * Perform update request on current admin.
     * @param  App\Http\Requests\Admin\WebRequest $request
     * @return Illuminate\Support\Facades\Redirect
     */
    public function update(WebRequest $request)
    {
        $profile = Auth::user()->web;
        $profile->fill($request->all())->save();
        flash('Profile updated.');
        return back();
    }
}
