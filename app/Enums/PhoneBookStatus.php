<?php

namespace App\Enums;

enum PhoneBookStatus: int
{
    case Inactive = 0;
    case Active = 1;


    public static function asValidationArray()
    {
        return [0, 1];
    }
}
