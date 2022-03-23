<?php

namespace App\Http\Requests;

use App\Rules\BedIsAllocatingToPerson;
use App\Rules\BedIsNotAllocated;
use App\Rules\CheckExpiredAtTime;
use App\Rules\CheckStartAtTime;
use App\Rules\Nationalcode;
use App\Rules\UniqueNationalCodeInAllocateBed;
use Illuminate\Foundation\Http\FormRequest;

class AllocatedToPersonRequest extends FormRequest
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
            'person_id'     => ['nullable', 'integer', new BedIsAllocatingToPerson()],
            'national_code' => ['required', new UniqueNationalCodeInAllocateBed(), new Nationalcode()],
            'name_family'   => 'requiredIf:person_id,null',
            'mobile'        => 'requiredIf:person_id,null',
            'birthday'      => 'requiredIf:person_id,null',
            'place'         => 'required|integer',
            'room'          => 'required|integer',
            'country'       => 'requiredIf:person_id,null',
            'province'      => 'requiredIf:person_id,null',
            'city'          => 'requiredIf:person_id,null',
            'referrer_user' => 'nullable',
            'bed'           => ['required', 'integer', new BedIsNotAllocated()],
            'start_at'      => ['required', 'date', new CheckStartAtTime()],
            'expired_at'    => ['required', 'date', new CheckExpiredAtTime()],
        ];
    }
}
