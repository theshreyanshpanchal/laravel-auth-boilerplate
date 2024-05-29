<?php

namespace App\Traits;

trait BaseEnum
{
    public static function values(): array
    {
        return collect(self::cases())->pluck('value')->toArray();
    }
}
