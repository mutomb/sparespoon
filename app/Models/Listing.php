<?php

namespace App\Models;

use App\Enums\ListingCategory;
use App\Enums\ListingStatus;
use App\Enums\ListingType;
use Database\Factories\ListingFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'title',
    'description',
    'category',
    'type',
    'price',
    'quantity',
    'expiry_date',
    'pickup_instructions',
    'status',
])]
class Listing extends Model
{
    /** @use HasFactory<ListingFactory> */
    use HasFactory;

    protected $attributes = [
        'price' => 0,
        'status' => 'available',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => ListingCategory::class,
            'type' => ListingType::class,
            'status' => ListingStatus::class,
            'price' => 'decimal:2',
            'expiry_date' => 'date',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    #[Scope]
    protected function available(Builder $query): void
    {
        $query->where('status', ListingStatus::Available);
    }

    #[Scope]
    protected function inLocation(Builder $query, ?string $postalCode, ?string $neighborhood): void
    {
        $query->whereHas('user', function (Builder $userQuery) use ($postalCode, $neighborhood) {
            $userQuery->when($postalCode, fn (Builder $q) => $q->where('postal_code', $postalCode))
                ->when($neighborhood, fn (Builder $q) => $q->orWhere('neighborhood', $neighborhood));
        });
    }

    #[Scope]
    protected function matchingLocation(Builder $query, string $search): void
    {
        $query->whereHas('user', function (Builder $userQuery) use ($search) {
            $userQuery->where('postal_code', 'like', "%{$search}%")
                ->orWhere('neighborhood', 'like', "%{$search}%");
        });
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }

    public function isFree(): bool
    {
        return $this->type === ListingType::Giveaway || (float) $this->price === 0.0;
    }

    public function formattedPrice(): string
    {
        if ($this->isFree()) {
            return 'Free';
        }

        $amount = number_format((float) $this->price, 2, '.', '');

        if (str_ends_with($amount, '.00')) {
            $amount = mb_substr($amount, 0, -3);
        }

        return '$'.$amount;
    }

    public function expiresSoon(): bool
    {
        return $this->expiry_date->lte(today()->addDays(2));
    }

    public function expiryLabel(): string
    {
        return match (true) {
            $this->expiry_date->isToday() => 'Best before today',
            $this->expiry_date->isTomorrow() => 'Best before tomorrow',
            default => 'Best before '.$this->expiry_date->format('M j'),
        };
    }
}
