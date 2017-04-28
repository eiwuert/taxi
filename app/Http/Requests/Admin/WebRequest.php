<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WebRequest extends FormRequest
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
            'first_name'   => 'required|max:24',
            'last_name'    => 'required|max:24',
            'picture'      => 'image|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'max:250',
            'permissions'  => 'required',
        ];
    }
}
