<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeLogController extends Controller
{
    /**
     * Latest changes on the admin side.
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.changelog.index');
    }
}
