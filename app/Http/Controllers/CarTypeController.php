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
    	return ok([CarType::all()]);
    }

    /**
     * Search car types.
     * @param  string $term
     * @return json
     */
    public function search($term)
    {
    	return ok([CarType::search($term)->get()]);
    }
}
