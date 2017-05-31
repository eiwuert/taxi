<?php

namespace App\Http\Requests\API\V3;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CalculateRequest extends FormRequest
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
            's_lat'  => 'required|regex:/^[+-]?\d+\.\d+$/',
            's_lng'  => 'required|regex:/^[+-]?\d+\.\d+$/',
            'd_lat'  => 'required|regex:/^[+-]?\d+\.\d+$/',
            'd_lng'  => 'required|regex:/^[+-]?\d+\.\d+$/',
            'type'   => 'required|exists:car_types,id',
        ];
    }
}
