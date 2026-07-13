<?php

namespace App\Enums;

enum ReactionType : string
{
    case LIKE = 'post';
    case LOVE = 'comment';
    case LAUGH = 'laugh';
    case SAD = 'sad';
    case ANGRY = 'angry';
    case HAPPY = 'happy';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
