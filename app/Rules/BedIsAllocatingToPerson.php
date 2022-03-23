<?php

namespace App\Rules;

use App\Models\AllocatedBed;
use App\Models\People;
use App\Models\Servant;
use Illuminate\Contracts\Validation\Rule;

class BedIsAllocatingToPerson implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $status = AllocatedBed::where(AllocatedBed::PEOPLE_ID, $value)
            ->whereDate(AllocatedBed::EXPIRED_AT, '>=', now())
            ->where(AllocatedBed::PEOPLE_TYPE,(request()->type?? 1) == 1 ? People::class : Servant::class)
            ->get();

        if ($status->count() > 0) {
            alert()->error('این شخص پذیرش شده است');
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'این شخص پذیرش شده است';
    }
}
