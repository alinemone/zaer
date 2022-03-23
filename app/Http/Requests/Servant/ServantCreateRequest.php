<?php

namespace App\Http\Requests\Servant;

use App\Rules\Nationalcode;
use Illuminate\Foundation\Http\FormRequest;

class ServantCreateRequest extends FormRequest
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
            'name_family' => 'required|string',
            'national_code' => ['required','unique:servants',new Nationalcode()],
            'mobile' => 'required|unique:people|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'birthday' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'city' => 'nullable',
            'town' => 'nullable',
            'degree' => 'required',
            'job' => 'required',
            'how_to' => 'nullable',
            'phone' => 'required',
            'workplace' => 'nullable',
            'quota' => 'required',
            'start_at' => 'required',
            'expired_at' => 'required'
        ];
    }
}
