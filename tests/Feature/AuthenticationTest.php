<?php

use App\Models\User;

it('registers a neighbor with their neighborhood', function () {
    $this->post(route('register'), [
        'name' => 'Robin Alvarez',
        'email' => 'robin@example.com',
        'neighborhood' => 'Leslieville',
        'postal_code' => 'm4m 2c2',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertRedirect(route('listings.index'));

    $this->assertAuthenticated();

    $user = User::firstWhere('email', 'robin@example.com');

    expect($user->neighborhood)->toBe('Leslieville')
        ->and($user->postal_code)->toBe('M4M 2C2');
});

it('rejects an invalid registration', function () {
    $this->from(route('register'))
        ->post(route('register'), [
            'name' => '',
            'email' => 'not-an-email',
            'neighborhood' => '',
            'postal_code' => '',
            'password' => 'short',
            'password_confirmation' => 'different',
        ])
        ->assertRedirect(route('register'))
        ->assertSessionHasErrors(['name', 'email', 'neighborhood', 'postal_code', 'password']);

    $this->assertGuest();
});

it('signs a neighbor in and out', function () {
    $user = User::factory()->create([
        'email' => 'neighbor@example.com',
        'password' => 'password',
    ]);

    $this->post(route('login'), [
        'email' => 'neighbor@example.com',
        'password' => 'password',
    ])->assertRedirect(route('listings.index'));

    $this->assertAuthenticatedAs($user);

    $this->post(route('logout'))->assertRedirect(route('listings.index'));

    $this->assertGuest();
});

it('does not sign in with the wrong password', function () {
    User::factory()->create([
        'email' => 'neighbor@example.com',
        'password' => 'password',
    ]);

    $this->from(route('login'))
        ->post(route('login'), [
            'email' => 'neighbor@example.com',
            'password' => 'wrong-password',
        ])
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors('email');

    $this->assertGuest();
});

it('lets a neighbor update their location', function () {
    $user = User::factory()->create([
        'neighborhood' => 'Old Town',
        'postal_code' => 'M1A 1A1',
    ]);

    $this->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => $user->name,
            'neighborhood' => 'Riverside',
            'postal_code' => 'm4e 1a1',
        ])
        ->assertRedirect(route('profile.edit'));

    expect($user->refresh()->neighborhood)->toBe('Riverside')
        ->and($user->postal_code)->toBe('M4E 1A1');
});
