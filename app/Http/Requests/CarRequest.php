<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
