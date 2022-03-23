<?php

namespace App\Http\Requests\Places;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class editPlaceRequest extends FormRequest
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
            'name' => 'required|min:2|unique:places,id,'.$this->user()->id,
            'address' => 'required',
            'phone' => 'required',
            'floor_count' => 'required|int',
            'gender_type' => 'required|in:1,2',
            'is_active' => 'required|in:0,1',
        ];
    }
}
