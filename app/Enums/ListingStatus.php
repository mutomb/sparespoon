<?php

namespace App\Enums;

enum ListingStatus: string
{
    case Available = 'available';
    case Reserved = 'reserved';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::Available => 'Available',
            self::Reserved => 'Reserved',
            self::Completed => 'Completed',
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Available => 'bg-sage-100 text-sage-800 ring-sage-600/20',
            self::Reserved => 'bg-amber-100 text-amber-900 ring-amber-700/20',
            self::Completed => 'bg-stone-200 text-stone-700 ring-stone-500/20',
        };
    }
}
