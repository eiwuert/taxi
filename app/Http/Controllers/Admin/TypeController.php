<?php

namespace App\Http\Controllers\Admin;

use App\CarType as Type;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarTypeRequest as Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::orderBy('id', 'desc')
                          ->paginate(config('admin.perPage'));
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = Type::create($request->all());
        flash(__('admin/general.New car type added'));
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarType  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarType $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarType $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $type->update($request->all());
        flash(__('admin/general.Car type updated'));
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarType $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        // $type->delete();
        flash(__('admin/general.Cannot delete car types'));
        return redirect()->route('types.index');
    }
}
