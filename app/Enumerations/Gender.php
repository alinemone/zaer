<?php

namespace App\Enumerations;

class Gender
{
    const MALE = 1;
    const FEMALE = 2;

    public static function getGenderEnum($type)
    {
        switch ($type) {
            case 'male':
                return self::MALE;
            case 'female':
                return self::FEMALE;
        }
    }
}
