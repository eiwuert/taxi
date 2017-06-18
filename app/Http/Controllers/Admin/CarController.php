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
        $car->update(array_merge($request->all(), ['number' => Car::formatNumber($request)]));
        flash(__('admin/general.Driver\'s car updated'), 'success');
        return redirect()->back();
    }
}
