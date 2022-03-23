<?php

namespace App\Rules;

use App\Models\Place;
use Illuminate\Contracts\Validation\Rule;

class FloorRoomCheck implements Rule
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
        $place = Place::where(Place::ID, (int)request()->segment(3))
            ->first();

        if ($value > $place->{Place::FLOOR_COUNT}) {
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
        return __('messages.custom.floorCountNotValid');
    }
}
