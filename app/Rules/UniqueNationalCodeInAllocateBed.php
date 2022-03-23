<?php

namespace App\Rules;

use App\Models\People;
use Faker\Provider\Person;
use Illuminate\Contracts\Validation\Rule;
use phpDocumentor\Reflection\Types\Expression;

class UniqueNationalCodeInAllocateBed implements Rule
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
        if (request()->post('person_id') == null) {
            return !(People::where(People::NATIONAL_CODE, $value)->count() > 0);
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
        return 'The validation error message.';
    }
}
