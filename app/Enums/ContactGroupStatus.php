<?php

namespace App\Enums;

enum ContactGroupStatus: int
{
    case Inactive = 0;
    case Active = 1;


    public static function asValidationArray()
    {
        return [0, 1];
    }
}
