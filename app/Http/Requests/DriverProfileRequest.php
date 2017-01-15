<?php

namespace App\Http\Requests;

use Auth;
use App\User;
use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class DriverProfileRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'picture'      => 'required|image|max:512',
        ];
    }
}
