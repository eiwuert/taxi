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
            's_lat'    => 'required|numeric',
            's_long'   => 'required|numeric',
            'd_lat'    => 'required|numeric',
            'd_long'   => 'required|numeric',
            'type'     => 'min:3|max:255',
            'currency' => 'size:3',
        ];
    }
}
