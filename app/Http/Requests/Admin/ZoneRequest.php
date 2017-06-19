<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
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
            'name' => 'required|max:255|unique:zones,name,' . ((is_null($this->zone)) ? '0' : $this->zone->id),
            'latitude' => 'required|regex:/^[+-]?\d+\.\d+$/|max:15',
            'longitude' => 'required|regex:/^[+-]?\d+\.\d+$/|max:15',
            'coordinates' => 'required|json',
        ];
    }
}
