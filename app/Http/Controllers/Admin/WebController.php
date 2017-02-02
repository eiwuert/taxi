<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebRequest;

class WebController extends Controller
{
    public function edit()
    {
        $profile = Auth::user()->web;
        return view('admin.webs.edit', compact('profile'));
    }

    public function update(WebRequest $reqeust)
    {
/*        $this->validate($request, [
            'picture' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);*/
        $profile = Auth::user()->web;
        $profile->fill($reqeust->all())->save();
        flash('Profile updated.');
        return back();
    }
}
