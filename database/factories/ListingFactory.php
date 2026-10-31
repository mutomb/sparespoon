<?php

namespace Database\Factories;

use App\Enums\ListingCategory;
use App\Enums\ListingStatus;
use App\Enums\ListingType;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = fake()->randomElement(ListingCategory::cases());
        $type = fake()->randomElement([ListingType::Giveaway, ListingType::Giveaway, ListingType::ForSale]);

        return [
            'user_id' => User::factory(),
            'title' => fake()->randomElement([
                'A bag of garden tomatoes',
                'Fresh sourdough loaf',
                'Half a bunch of bananas',
                'Homegrown herbs',
                'Extra pantry pasta',
                'Lemons from our tree',
                'Six fresh eggs',
                'Open jar of honey',
            ]),
            'description' => fake()->paragraph(),
            'category' => $category,
            'type' => $type,
            'price' => $type === ListingType::Giveaway ? 0 : fake()->randomElement([2, 3, 4.5, 6]),
            'quantity' => fake()->randomElement(['1 bag', '2 bunches', '6 pieces', '1 loaf', '3 portions']),
            'expiry_date' => fake()->dateTimeBetween('today', '+10 days'),
            'pickup_instructions' => fake()->randomElement([
                'Leave a message and pop by the front porch. The box is by the door.',
                'Porch pickup any time before 8pm. Please don\'t ring the bell.',
                'We are home most evenings. Text when you are on your way.',
                'Meet me by the community garden gate at the corner.',
            ]),
            'status' => ListingStatus::Available,
            'created_at' => fake()->dateTimeBetween('-5 days', 'now'),
        ];
    }

    public function reserved(): static
    {
        return $this->state(fn () => ['status' => ListingStatus::Reserved]);
    }

    public function completed(): static
    {
        return $this->state(fn () => ['status' => ListingStatus::Completed]);
    }

    public function giveaway(): static
    {
        return $this->state(fn () => [
            'type' => ListingType::Giveaway,
            'price' => 0,
        ]);
    }
}
