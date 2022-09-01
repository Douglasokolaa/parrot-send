<?php
namespace App\Enums;

enum MessageRoute: string
{
    use EnumHelper;

    case generic = 'generic';
    case dnd = 'dnd';
}
