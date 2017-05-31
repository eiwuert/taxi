<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StateRequest as Request;
use App\State;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::orderBy('id', 'asc')
            ->paginate(config('admin.perPage'));
        return view('admin.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $state = State::create($request->all());
        flash(__('admin/general.State created'));
        return view('admin.states.edit', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        return view('admin.states.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        $state->update($request->all());
        flash(__('admin/general.State updated'));
        return view('admin.states.edit', compact('state'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        if (! $state->active) {
            $state->delete();
            flash(__('admin/general.State has been deleted'));
            return redirect()->route('states.index');
        } else {
            flash(__('admin/general.State cannot be deleted'), 'danger');
            return redirect()->back()->with('state',$state);

        }

    }
}
