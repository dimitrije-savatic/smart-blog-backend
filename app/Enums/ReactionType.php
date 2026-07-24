<?php

namespace App\Enums;

enum ReactionType : string
{
    case LIKE = 'like';
    case HEART = 'heart';
    case HAPPY = 'happy';
    case SAD = 'sad';
    case FIRE = 'fire';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
