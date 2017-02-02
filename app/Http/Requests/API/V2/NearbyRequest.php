<?php

namespace App\Http\Requests\API\V2;

use App\Http\Requests\Request;

class NearbyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lat'      => ['required', 'regex:/^[+-]?\d+\.\d+$/'],
            'lng'      => ['required', 'regex:/^[+-]?\d+\.\d+$/'],
            'type'     => ['min:3', 'max:255', 'exists:car_types,name'],
            'currency' => ['size:3'],
            'distance' => ['numeric', 'min:1', 'max:5'],
            'limit'    => ['numeric', 'min:5', 'max:100'],
        ];
    }
}
