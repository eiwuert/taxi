<?php

namespace App\Http\Controllers\Admin;

use App\Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CarRequest as Request;

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
        $request->number = Car::formatNumber($request);
        $car->update($request->all());
        flash(__('admin/general.Driver\'s car updated'), 'success');
        return redirect()->back();
    }
}
