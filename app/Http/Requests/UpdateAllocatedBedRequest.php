<?php

namespace App\Http\Requests;

use App\Rules\CheckStartAtTime;
use App\Rules\BedIsNotAllocated;
use App\Rules\CheckExpiredAtTime;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAllocatedBedRequest extends FormRequest
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
            'bed'        => ['required', 'integer', new BedIsNotAllocated()],
            'start_at'   => ['required', 'date', new CheckStartAtTime()],
            'expired_at' => ['required', 'date', new CheckExpiredAtTime()],
        ];
    }
}
