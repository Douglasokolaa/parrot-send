<?php

namespace App\Enums;

use BackedEnum;

trait EnumHelper
{
    public static function asValidationArray(): array
    {
        return [0, 1];
    }

    public static function getRandomInstance(): self
    {
        return collect(self::cases())->shuffle()->first();
    }

    public function name(): string
    {
        return __($this->name);
    }

    public static function names(): array
    {
        return array_column(static::cases(), 'name');
    }

    public static function values(): array
    {
        $cases = static::cases();

        return isset($cases[0]) && $cases[0] instanceof BackedEnum
            ? array_column($cases, 'value')
            : array_column($cases, 'name');
    }

    public static function options(): array
    {
        $cases = static::cases();
        return isset($cases[0]) && $cases[0] instanceof BackedEnum
            ? array_column($cases, 'value', 'name')
            : array_column($cases, 'name');
    }
}
