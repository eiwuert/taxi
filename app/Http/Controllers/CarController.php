<?php

namespace App\Http\Controllers;

use Auth;
use App\Car;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;

class CarController extends Controller
{
	/**
	 * Register new car.
	 * 
	 * @return json
	 */
    public function register(CarRequest $request)
    {
    	$request['type_id'] = $request['type_id'];
    	$request['user_id'] = Auth::user()->id;

    	return Car::create($request->all());
    }

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
