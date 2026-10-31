<?php

namespace App\Enums;

enum ListingType: string
{
    case Giveaway = 'giveaway';
    case ForSale = 'for_sale';

    public function label(): string
    {
        return match ($this) {
            self::Giveaway => 'Giveaway',
            self::ForSale => 'For Sale',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Giveaway => 'bg-sage-100 text-sage-800 ring-sage-600/20',
            self::ForSale => 'bg-amber-100 text-amber-900 ring-amber-700/20',
        };
    }
}
