<?php

namespace App\Http\Controllers\Car;

use App\CarType;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarTypeController extends Controller
{
    /**
     * Get all available car types.
     * @return json
     */
    public function all()
    {
        return ok(CarType::all(), 200, [], false);
    }
}
