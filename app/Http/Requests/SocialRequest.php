<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SocialRequest extends Request
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
            'email'      => 'required|email|max:255|unique:users',
            'social_id'  => 'required|min:6|max:255',
            'login_by'   => 'required|in:manual,google,facebook',
            'picture'    => 'image|size:512',
        ];
    }
}
