<?php

namespace App\Enums;

enum ListingCategory: string
{
    case Produce = 'produce';
    case Bakery = 'bakery';
    case Pantry = 'pantry';
    case Garden = 'garden';
    case Other = 'other';

    public function label(): string
    {
        return match ($this) {
            self::Produce => 'Produce',
            self::Bakery => 'Bakery',
            self::Pantry => 'Pantry',
            self::Garden => 'Garden',
            self::Other => 'Other',
        };
    }

    public function emoji(): string
    {
        return match ($this) {
            self::Produce => '🥕',
            self::Bakery => '🥖',
            self::Pantry => '🥫',
            self::Garden => '🌱',
            self::Other => '🍲',
        };
    }

    public function gradient(): string
    {
        return match ($this) {
            self::Produce => 'from-sage-200 via-cream-200 to-amber-100',
            self::Bakery => 'from-amber-100 via-cream-200 to-orange-100',
            self::Pantry => 'from-stone-200 via-cream-200 to-amber-100',
            self::Garden => 'from-sage-300 via-sage-100 to-cream-100',
            self::Other => 'from-rose-100 via-cream-100 to-sage-100',
        };
    }
}
