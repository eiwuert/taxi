<?php

namespace App\Http\Controllers\Admin;

use App\CarType as Type;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarTypeRequest as Request;
use App\Http\Requests\Admin\UpdateCarTypeRequest as UpdateRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::parents()->orderBy('id', 'desc')
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
        $types = $this->types();
        $position = range(0, Type::count());
        return view('admin.types.create', compact('types', 'position'));
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
        $this->storeChildren($type, $request->children);
        $types = $this->selectedTypesAndAvailableTypes($type);
        flash(__('admin/general.New car type added'));
        return view('admin.types.edit', compact('type', 'types'));
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
        $position = range(0, Type::count());
        $types = $this->selectedTypesAndAvailableTypes($type);
        return view('admin.types.edit', compact('type', 'types', 'position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarType $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Type $type)
    {
        $type->update($request->all());
        $types = $this->updateAndGetTypes($type, $request->children);
        $position = range(0, Type::count());
        flash(__('admin/general.Car type updated'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarType $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        if ($type->canDelete()) {
            $type->delete();
            flash(__('admin/general.Car type deleted'));
            return redirect()->route('types.index');
        } else {
            flash(__('admin/general.Cannot delete car types'));
            return redirect()->route('types.index');
        }
    }

    /**
     * Get available car types.
     *
     * @return array
     */
    protected function types()
    {
        $type_ids = [];
        foreach (Type::parents()->get() as $type) {
            if ($type->children()->count() == 0) {
                $type_ids[] = $type->id;
            }
        }
        return Type::whereIn('id', $type_ids)->pluck('name', 'id');
    }

    /**
     * Store new children for given type
     *
     * @param  \App\CarType $type
     * @param  array $children
     * @return void
     */
    protected function storeChildren($type, $children)
    {
        foreach ($children as $child) {
            Type::find($child)->forceFill(['car_type_id' => $type->id])->save();
        }
    }

    /**
     * Array of selected types and available types.
     *
     * @param  \App\CarType $type
     * @return array
     */
    protected function selectedTypesAndAvailableTypes($type)
    {
        $types = [];
        $type_ids = [];
        $type_ids[] = $type->children()->get(['id'])->flatten()->toArray();
        foreach (Type::parents()->get() as $t) {
            if ($t->children()->count() == 0 && $t->id != $type->id) {
                $type_ids[0][] = ['id' => $t->id];
            }
        }
        foreach ($type_ids[0] as $value) {
            $types[] = $value['id'];
        }
        return Type::whereIn('id', $types)->pluck('name', 'id');
    }

    /**
     * Update types and get the types for the updated model.
     *
     * @param  \App\CarType $type
     * @param  array $children
     * @return array
     */
    protected function updateAndGetTypes($type, $children)
    {
        foreach (Type::where('car_type_id', $type->id)->get() as $child) {
            Type::find($child->id)->forceFill(['car_type_id' => null])->save();
        }
        if (!is_null($children)) {
            foreach ($children as $child) {
                Type::find($child)->forceFill(['car_type_id' => $type->id])->save();
            }
        }
        $type_ids = [];
        $type_ids[] = $type->children()->get(['id'])->flatten()->toArray();
        foreach (Type::parents()->get() as $t) {
            if ($t->children()->count() == 0) {
                $type_ids[0][] = ['id' => $t->id];
            }
        }
        $types = [];
        foreach ($type_ids[0] as $value) {
            $types[] = $value['id'];
        }
        return Type::whereIn('id', $types)->pluck('name', 'id');
    }
}
