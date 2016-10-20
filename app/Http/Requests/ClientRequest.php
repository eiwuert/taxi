<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'sex'        => 'required|in:male,female',
            'email'      => 'required|email',
            'password'   => 'required',
            'device_type'=> 'required|in:android,ios',
            'picture'    => 'image|size:512',
        ];
    }
}
