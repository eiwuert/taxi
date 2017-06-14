<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebRequest;
use App\User;
use App\Web;
use Auth;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;

class WebController extends Controller
{
    public function __construct()
    {
        $this->middleware('superadmin')->only(['store', 'create', 'index']);
    }

    /**
     * Get all Administrators.
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Web::orderBy('created_at', 'desc')
                    ->paginate(config('admin.perPage'));
        return view('admin.webs.index', compact('admins'));
    }

    /**
     * Show edit form, to edit current admin data.
     * @return Illuminate\Http\Response
     */
    public function edit($web)
    {
        if (!Auth::user()->web->superadmin()) {
            $profile = Auth::user()->web;
        } else {
            $profile = Web::findOrFail($web);
        }
        return view('admin.webs.edit', compact('profile'));
    }

    /**
     * Perform update request on current admin.
     * @param  App\Http\Requests\Admin\WebRequest $request
     * @return Illuminate\Support\Facades\Redirect
     */
    public function update(Request $request, Web $user)
    {
        if (!Auth::user()->web->superadmin()) {
            $request = [
                'first_name' => $request->first_name,
                'picture' => $request->picture,
                'last_name' => $request->last_name,
            ];
            Auth::user()->fill($request)->save();
        } else {
            $request = [
                'first_name' => $request->first_name,
                'picture' => $request->picture,
                'last_name' => $request->last_name,
                'permissions' => $request->permissions,
            ];
            $user->fill($request)->save();
        }
        flash(__('admin/general.Profile updated'));
        return back();
    }

    /**
     * Update web user email.
     * @param  Request $request
     * @param  Web     $user
     * @return Redirect
     */
    public function updateEmail(Request $request, Web $user)
    {
        if (!Auth::user()->web->superadmin()) {
            Auth::user()->user->fill(['email' => $request->email])->save();
        } else {
            $user->user->fill(['email' => $request->email])->save();
        }
        flash(__('admin/general.Profile updated'));
        return back();
    }

    /**
     * Update web user password
     * @param  Request $request
     * @param  Web     $user
     * @return Redirect
     */
    public function updatePassword(Request $request, Web $user)
    {
        if (!Auth::user()->web->superadmin()) {
            Auth::user()->user->fill(['password' => $request->password])->save();
        } else {
            $user->user->fill(['password' => $request->password])->save();
        }
        flash(__('admin/general.Profile updated'));
        return back();
    }

    /**
     * Return create view.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.webs.create');
    }

    /**
     * Create new admin
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(WebRequest $request)
    {
        $user = User::forceCreate([
            'uuid' => Uuid::generate(1)->string,
            'email' => $request->email,
            'phone' => '000000',
            'role'  => 'web',
            'verified' => true,
            'password' => $request->password,
        ]);

        $request['user_id'] = $user->id;
        $request['permissions'] = collect($request->permissions)->values()->toArray();
        $profile = Web::create($request->all());
        return view('admin.webs.edit', compact('profile'));
    }

    /**
     * Delete admin.
     * @param  integer  $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            flash(__('admin/general.You cannot delete yourself'));
            return back();            
        } else {
            Web::find($id)->user->delete();
            flash(__('admin/general.Admin user deleted'));
            return back();
        }
    }
}
