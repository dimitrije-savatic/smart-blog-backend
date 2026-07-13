<?php

namespace App\Enums;

enum ReactableType: string
{
    case POST = 'post';
    case COMMENT = 'comment';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
