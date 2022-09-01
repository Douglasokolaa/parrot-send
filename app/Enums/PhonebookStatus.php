<?php

namespace App\Enums;

enum PhonebookStatus: int
{
    use EnumHelper;

    case Inactive = 0;
    case Active = 1;
}
