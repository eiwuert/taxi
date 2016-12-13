<?php

namespace App\Http\Controllers\Car;

use Auth;
use App\Car;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    /**
     * Get driver car info.
     * @param  Car    $car
     * @return json
     */
    public function info(Car $car)
    {
    	return Auth::user()->car()->get();
    }
}
