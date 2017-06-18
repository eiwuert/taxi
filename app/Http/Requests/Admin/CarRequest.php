<?php

namespace App\Http\Requests\Admin;

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
            'number' => 'sometimes',
            'color' => 'sometimes',
            'type_id' => 'sometimes',
            'hull_insurance_expire' => 'sometimes|date:Y/m/d',
            'third_party_insurance_expire' => 'sometimes|date:Y/m/d',
            'technical_diagnosis_expire' => 'sometimes|date:Y/m/d',
            'technical_diagnosis_number' => 'sometimes',
            'card' => 'sometimes',
            'type_of' => 'sometimes',
            'system' => 'sometimes',
            'brigade' => 'sometimes',
            'year' => 'sometimes',
            'fuel' => 'sometimes',
            'capacity' => 'sometimes',
            'cylinder' => 'sometimes',
            'axis' => 'sometimes',
            'wheel' => 'sometimes',
            'motor' => 'sometimes',
            'chassis' => 'sometimes',
            'vin' => 'sometimes',
        ];
    }
}
