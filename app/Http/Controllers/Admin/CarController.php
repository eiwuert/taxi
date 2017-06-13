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
        $car->update([
            'color'   => $request->color,
            'type_id' => $request->type_id,
            // Hard coded
            'number'  => $request->platePart1 . $request->platePart2 . $request->platePart3 . ' - ایران ' . $request->platePart4,
        ]);
        flash(__('admin/general.Driver\'s car updated'), 'success');
        return redirect()->back();
    }
}
