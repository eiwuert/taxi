<?php

namespace App\Http\Controllers\Car;

use Auth;
use App\Car;
use App\User;
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
    	$car = [];
    	foreach(User::where('phone', Auth::user()->phone)->get() as $user) {
    		if (! $user->car()->get()->isEmpty())
    			$car = $user->car()->get();

    	if (empty($car))
    		return fail([
    				'title'  => 'No car',
    				'detail' => 'you donnot have registered car',
    			]);
    	}
    }
}
