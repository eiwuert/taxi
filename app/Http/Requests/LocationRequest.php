<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LocationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lat'  => 'required|regex:/^[+-]?\d+\.\d+$/',
            'long' => 'required|regex:/^[+-]?\d+\.\d+$/',
        ];
    }
}
