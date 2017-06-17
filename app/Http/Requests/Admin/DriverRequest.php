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

            'first_name'      => 'required|max:255',
            'last_name'       => 'required|max:255',
            'email'           => 'required|nullable|email|unique:clients,email,'.Request::get('driver_id'),
            'gender'          => 'required|in:"male", "female", "not specified"',
            'address'         => 'required|max:255',
            'state'           => 'required|max:255',
            'country'         => 'required|max:255',
            'zipcode'         => 'required|digits:10|max:255',
            'lang'            => 'required|in:fa,en,ku',
            'device_token'    => 'required|max:255',
            'device_type'     => 'required|in:manual,ios,android',
            'picture'         => 'sometimes|image',
            'identity_number' => 'required|integer',
            'identity_code'   => 'required|digits:10|integer',
            'abuse_history'   => 'required|boolean',
            'drug_abuse'      => 'required|boolean',
            'credit_card'     => 'required|digits:16|integer',
        ];
    }
}
