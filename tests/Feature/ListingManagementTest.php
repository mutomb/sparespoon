<?php

use App\Enums\ListingStatus;
use App\Models\Listing;
use App\Models\User;

function listingPayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Extra apples',
        'description' => 'A bag of apples from our tree.',
        'category' => 'produce',
        'type' => 'for_sale',
        'price' => 2.5,
        'quantity' => '1 bag',
        'expiry_date' => now()->addDays(4)->toDateString(),
        'pickup_instructions' => 'Porch pickup after 5pm.',
    ], $overrides);
}

it('lets a signed-in neighbor share a listing', function () {
    $neighbor = User::factory()->create();

    $this->actingAs($neighbor)
        ->post(route('listings.store'), listingPayload())
        ->assertRedirect();

    $listing = $neighbor->listings()->firstWhere('title', 'Extra apples');

    expect($listing)->not->toBeNull()
        ->and($listing->status)->toBe(ListingStatus::Available)
        ->and($listing->type->value)->toBe('for_sale');
});

it('forces giveaways to a zero price', function () {
    $neighbor = User::factory()->create();

    $this->actingAs($neighbor)->post(route('listings.store'), listingPayload([
        'type' => 'giveaway',
        'price' => 12,
    ]));

    $listing = $neighbor->listings()->firstWhere('title', 'Extra apples');

    expect((float) $listing->price)->toBe(0.0)
        ->and($listing->isFree())->toBeTrue();
});

it('requires a neighbor to sign in before sharing food', function () {
    $this->get(route('listings.create'))->assertRedirect(route('login'));
    $this->post(route('listings.store'), listingPayload())->assertRedirect(route('login'));
});

it('stops neighbors from editing someone else\'s listing', function () {
    $owner = User::factory()->create();
    $listing = Listing::factory()->for($owner)->create();

    $this->actingAs(User::factory()->create())
        ->get(route('listings.edit', $listing))
        ->assertForbidden();

    $this->actingAs(User::factory()->create())
        ->patch(route('listings.status.update', $listing), ['status' => 'reserved'])
        ->assertForbidden();

    expect($listing->refresh()->status)->toBe(ListingStatus::Available);
});

it('lets the owner move a listing through its statuses', function () {
    $owner = User::factory()->create();
    $listing = Listing::factory()->for($owner)->create();

    $this->actingAs($owner)
        ->patch(route('listings.status.update', $listing), ['status' => 'reserved'])
        ->assertRedirect()
        ->assertSessionHas('status');

    expect($listing->refresh()->status)->toBe(ListingStatus::Reserved);

    $this->actingAs($owner)
        ->patch(route('listings.status.update', $listing), ['status' => 'completed'])
        ->assertRedirect();

    expect($listing->refresh()->status)->toBe(ListingStatus::Completed);
});

it('shows only the signed-in neighbor\'s listings on the dashboard', function () {
    $neighbor = User::factory()->create();
    $own = Listing::factory()->for($neighbor)->create(['title' => 'My own rhubarb']);
    $other = Listing::factory()->create(['title' => 'Somebody else\'s rhubarb']);

    $this->actingAs($neighbor)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee('My own rhubarb')
        ->assertDontSee($other->title);
});
