<?php

namespace App\Http\Controllers\Admin;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $car->update($request->except(['_method', '_token']));
        flash(__('admin/general.Driver\'s car updated'), 'success');
        return redirect()->back();
    }
}
