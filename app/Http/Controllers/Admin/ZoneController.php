<?php

namespace App\Http\Controllers\Admin;

use App\Zone;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ZoneRequest as Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::where('name', '!=', 'default')
                    ->orderBy('id', 'desc')
                    ->paginate(config('admin.perPage'));
        return view('admin.zones.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.zones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zone = Zone::create($request->all());
        flash(__('admin/general.Zone created'));
        return view('admin.zones.edit', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zone $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        return view('admin.zones.edit', compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zone $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        $zone->update($request->all());
        flash(__('admin/general.Zone updated'));
        return view('admin.zones.edit', compact('zone'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zone $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        if ($zone->name != 'default') {
            $zone->delete();
            flash(__('admin/general.Zone has been deleted'));
        } else {
            flash(__('admin/general.Zone cannot be deleted'), 'danger');
        }
        return redirect()->route('zones.index');
    }
}
