<?php

namespace App\Http\Controllers;

use App\CarType;
use App\Http\Requests;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{
	/**
	 * Get all available car types.
	 * @return json
	 */
    public function all()
    {
    	return CarType::all();
    }

    public function search($term)
    {
    	return CarType::search($term)->get();
    }
}
