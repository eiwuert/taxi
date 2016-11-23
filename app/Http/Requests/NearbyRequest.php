<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NearbyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lat'      => 'required',
            'long'     => 'required',
            'distance' => 'numeric|min:1|max:5',
            'limit'    => 'numeric|min:5|max:100',
        ];
    }
}
