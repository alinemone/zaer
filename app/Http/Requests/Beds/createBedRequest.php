<?php

namespace App\Http\Requests\Beds;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class createBedRequest extends FormRequest
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
            'bed_number' => 'required',
            'assigned' => 'required|in:0,1',
            'is_active' => 'required|in:0,1',
        ];
    }
}
