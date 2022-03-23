<?php

namespace App\Rules;

use App\Models\AllocatedBed;
use App\Models\Bed;
use Illuminate\Contracts\Validation\Rule;

class BedIsNotAllocated implements Rule
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
    public function passes($attribute, $value): bool
    {
        $startAt = jalali_to_carbon(request()->post('start_at'));

        $expiredAt = jalali_to_carbon(request()->post('expired_at'));

        $result = AllocatedBed::where('bed_id', $value)
            ->where(function ($query) use ($startAt, $expiredAt) {
                $query->whereBetWeen(AllocatedBed::START_AT, [$startAt, $expiredAt])
                    ->orWhereBetWeen(AllocatedBed::EXPIRED_AT, [$startAt, $expiredAt]);
            })
            ->count();

        return !($result > 0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('messages.allocated_bed.bedIsAllocated');
    }
}
