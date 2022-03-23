<?php

namespace App\Http\Requests\Group;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            Group::TITLE => 'required|string|unique:groups',
            Group::OWNER_NAME => 'required|string',
            Group::OWNER_MOBILE => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric',
        ];
    }
}
