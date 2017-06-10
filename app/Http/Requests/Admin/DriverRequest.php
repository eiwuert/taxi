<?php

namespace App\Http\Requests\Admin;

use App\Driver;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
            'first_name'      => 'sometimes|max:255',
            'last_name'       => 'sometimes|max:255',
            'email'           => 'sometimes|nullable|email|unique:drivers,email,'.Request::get('driver_id'),
            'gender'          => 'sometimes|in:"male", "female", "not specified"',
            'address'         => 'sometimes|max:255',
            'state'           => 'sometimes|max:255',
            'country'         => 'sometimes|max:255',
            'zipcode'         => 'sometimes|max:255',
            'lang'            => 'sometimes|in:fa,en,ku',
            'device_token'    => 'sometimes|max:255',
            'device_type'     => 'sometimes|in:manual,ios,android',
            'picture'         => 'sometimes|image',
            'identity_number' => 'required|integer', 
            'identity_code'   => 'required|integer', 
            'abuse_history'   => 'required|boolean',
            'drug_abuse'      => 'required|boolean', 
            'credit_card'     => 'required|integer',
        ];
    }
}
