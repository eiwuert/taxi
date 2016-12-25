<?php

namespace App\Http\Requests;

use Auth;
use App\User;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

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
            'email'        => [
                    Rule::unique('clients')->ignore(User::wherePhone(Auth::user()->phone)
                                    ->orderBy('id', 'desc')
                                    ->first()->client()->first()->email, 'email'),
                    'min:6',
                    'max:255',
                    'email'
                ],
            'gender'       => 'in:male,female,not specified',
            'address'      => 'min:3',
            'state'        => 'min:2|max:255',
            'country'      => 'min:2|max:255',
            'zipcode'      => 'numeric',
            'picture'      => 'image|max:512',
        ];
    }
}
