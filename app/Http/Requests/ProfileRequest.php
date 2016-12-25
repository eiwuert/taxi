<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'   => 'max:255',
            'last_name'    => 'max:255',
            'email'        => 'email|unique:clients,email|min:6|max:255',
            'gender'       => 'in:male,female,not specified',
            'address'      => 'min:3',
            'state'        => 'min:2|max:255',
            'country'      => 'min:2|max:255',
            'zipcode'      => 'numeric',
            'picture'      => 'image|max:512',
        ];
    }
}
