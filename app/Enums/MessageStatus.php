<?php

namespace App\Enums;

enum MessageStatus: int
{
    use EnumHelper;

    case scheduled = 0;
    case failed = 1;
    case bounced = 2;
    case sent = 3;
    case delivered = 4;

    public static function getRandomInstance(): self
    {
        return collect(self::cases())->shuffle()->first();
    }

    public function name(): string
    {
        return __($this->name);
    }
}
