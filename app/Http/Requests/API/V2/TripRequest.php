<?php

namespace App\Http\Requests\API\V2;

use App\CarType;
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
            's_lng'   => ['required', 'regex:/^[+-]?\d+\.\d+$/'],
            'd_lat'    => ['required', 'regex:/^[+-]?\d+\.\d+$/'],
            'd_lng'   => ['required', 'regex:/^[+-]?\d+\.\d+$/'],
            'type'    => '',
        ];
    }
}
