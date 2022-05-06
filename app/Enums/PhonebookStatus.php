<?php

namespace App\Enums;

enum PhonebookStatus: int
{
    case Inactive = 0;
    case Active = 1;


    public static function asValidationArray(): array
    {
        return [0, 1];
    }
}
