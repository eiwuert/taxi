<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CarRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // [11-19,21-29,31-39,41-49,51-59,61-69,71-79,81-89,91-99]{2}-[11-19,21-29,31-39,41-49,51-59,61-69,71-79,81-89,91-99]{2}{1}
            'number' => 'required',
            'color'  => 'required',
            'type_id'=> 'required|exists:car_types,id',
        ];
    }
}
