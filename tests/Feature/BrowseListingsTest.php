<?php

use App\Enums\ListingCategory;
use App\Models\Listing;
use App\Models\User;

it('shows only available food on the browse feed', function () {
    Listing::factory()->create(['title' => 'Available carrots']);
    Listing::factory()->reserved()->create(['title' => 'Reserved sourdough']);
    Listing::factory()->completed()->create(['title' => 'Completed crackers']);

    $this->get('/')
        ->assertOk()
        ->assertSee('Available carrots')
        ->assertDontSee('Reserved sourdough')
        ->assertDontSee('Completed crackers');
});

it('tunes the feed to the signed-in neighbor location', function () {
    $neighbor = User::factory()->create([
        'neighborhood' => 'Riverside',
        'postal_code' => 'M4E 1A1',
    ]);

    Listing::factory()
        ->for(User::factory()->create(['neighborhood' => 'Riverside', 'postal_code' => 'M4E 9Z9']))
        ->create(['title' => 'Nearby garden kale']);

    Listing::factory()
        ->for(User::factory()->create(['neighborhood' => 'Leslieville', 'postal_code' => 'M4M 1A1']))
        ->create(['title' => 'Far away pears']);

    $this->actingAs($neighbor)
        ->get('/')
        ->assertOk()
        ->assertSee('Nearby garden kale')
        ->assertDontSee('Far away pears');
});

it('lets a neighbor search by location and category', function () {
    Listing::factory()
        ->for(User::factory()->create(['neighborhood' => 'Riverside', 'postal_code' => 'M4E 1A1']))
        ->create(['title' => 'Riverside tomatoes', 'category' => ListingCategory::Garden]);

    Listing::factory()
        ->for(User::factory()->create(['neighborhood' => 'Leslieville', 'postal_code' => 'M4M 1A1']))
        ->create(['title' => 'Leslieville bagels', 'category' => ListingCategory::Bakery]);

    $this->get('/?location=Riverside&category=garden')
        ->assertOk()
        ->assertSee('Riverside tomatoes')
        ->assertDontSee('Leslieville bagels');
});

it('shows a listing to guests', function () {
    $listing = Listing::factory()->create(['title' => 'A box of plums']);

    $this->get(route('listings.show', $listing))
        ->assertOk()
        ->assertSee('A box of plums')
        ->assertSee('Pickup instructions');
});
