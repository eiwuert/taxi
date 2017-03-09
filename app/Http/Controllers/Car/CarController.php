<?php

namespace App\Http\Controllers\Car;

use Auth;
use App\Car;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    /**
     * Get driver car info.
     * @param  App\Car    $car
     * @return json
     */
    public function info(Car $car)
    {
        return ok(Auth::user()->car()->get(), 200, [], false);
    }
}
