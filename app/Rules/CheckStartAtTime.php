<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckStartAtTime implements Rule
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
        $startAt = jalali_to_carbon($value);

        return !$startAt->isBefore(today());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('messages.custom.dateIsBeforeToday');
    }
}
