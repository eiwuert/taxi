<?php

namespace App\Http\Requests\Admin;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
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
            'first_name'    => 'sometimes|max:255',
            'last_name'     => 'sometimes|max:255',
            'email'         => 'sometimes|nullable|email|unique:clients,email,'.Request::get('client_id'),
            'gender'        => 'sometimes|in:"male", "female", "not specified"',
            'address'       => 'sometimes|max:255',
            'state'         => 'sometimes|max:255',
            'country'       => 'sometimes|max:255',
            'zipcode'       => 'sometimes|max:255',
            'lang'          => 'sometimes|in:fa,en,ku',
            'device_token'  => 'sometimes|max:255',
            'device_type'   => 'sometimes|in:manual,ios,android',
            'picture'       => 'sometimes|image',
        ];
    }
}
