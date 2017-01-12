<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TripRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            's_lat'    => ['required', 'regex:/^[+-]?\d+\.\d+$/'],
            's_long'   => ['required', 'regex:/^[+-]?\d+\.\d+$/'],
            'd_lat'    => ['required', 'regex:/^[+-]?\d+\.\d+$/'],
            'd_long'   => ['required', 'regex:/^[+-]?\d+\.\d+$/'],
            // 'type'     => ['min:3', 'max:255', 'exists:car_types,name'],
            // 'currency' => ['size:3'],
        ];
    }
}
