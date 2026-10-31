<?php

namespace Database\Seeders;

use App\Enums\ListingCategory;
use App\Enums\ListingStatus;
use App\Enums\ListingType;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed a small neighborhood of neighbors and food shares.
     */
    public function run(): void
    {
        $maya = User::factory()->create([
            'name' => 'Maya Thompson',
            'email' => 'test@example.com',
            'neighborhood' => 'Riverside',
            'postal_code' => 'M4E 1A1',
        ]);

        $amara = User::factory()->create([
            'name' => 'Amara Okafor',
            'email' => 'amara@example.com',
            'neighborhood' => 'Riverside',
            'postal_code' => 'M4E 1A2',
        ]);

        $ben = User::factory()->create([
            'name' => 'Ben Whitfield',
            'email' => 'ben@example.com',
            'neighborhood' => 'Riverside',
            'postal_code' => 'M4E 2B4',
        ]);

        $priya = User::factory()->create([
            'name' => 'Priya Raman',
            'email' => 'priya@example.com',
            'neighborhood' => 'Leslieville',
            'postal_code' => 'M4M 2C1',
        ]);

        $sofia = User::factory()->create([
            'name' => 'Sofia Marchetti',
            'email' => 'sofia@example.com',
            'neighborhood' => 'Riverside',
            'postal_code' => 'M4E 1B3',
        ]);

        $jonah = User::factory()->create([
            'name' => 'Jonah Lee',
            'email' => 'jonah@example.com',
            'neighborhood' => 'The Beaches',
            'postal_code' => 'M4E 3K2',
        ]);

        $listings = [
            [
                'user' => $maya,
                'title' => 'A glut of garden tomatoes',
                'description' => 'Our two cherry tomato plants went absolutely wild this week. There are more ripe ones than we can eat, sauce, or foist on friends. A mix of sweet cherry and small plum tomatoes, picked this morning. Bring a small bag or tub.',
                'category' => ListingCategory::Garden,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => '2 punnets',
                'expiry_date' => now()->addDays(4),
                'pickup_instructions' => 'Porch pickup any time before 8pm. The box will be by the blue front door — please don\'t ring the bell, the baby is usually asleep.',
                'status' => ListingStatus::Available,
                'hours_ago' => 2,
            ],
            [
                'user' => $amara,
                'title' => 'Half a sourdough loaf',
                'description' => 'Baked yesterday and still lovely, but we only got through half of it. Crusty, seeded, and very good toasted. Wrapped and ready on the kitchen counter.',
                'category' => ListingCategory::Bakery,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => 'Half a loaf',
                'expiry_date' => now()->addDays(2),
                'pickup_instructions' => 'We are on the corner of Pine and Third. Message when you are nearby and I will leave it on the porch bench.',
                'status' => ListingStatus::Available,
                'hours_ago' => 5,
            ],
            [
                'user' => $ben,
                'title' => 'Six eggs from our hens',
                'description' => 'Our four hens are laying faster than we can keep up with. These are large, speckled, and collected this morning. Happy to pass on a half dozen to a neighbor.',
                'category' => ListingCategory::Produce,
                'type' => ListingType::ForSale,
                'price' => 3,
                'quantity' => '6 eggs',
                'expiry_date' => now()->addDays(7),
                'pickup_instructions' => 'Porch pickup, ideally between 4 and 7pm. The egg box is in the cooler bag by the side door.',
                'status' => ListingStatus::Available,
                'hours_ago' => 8,
            ],
            [
                'user' => $priya,
                'title' => 'Fresh coriander + mint',
                'description' => 'My balcony herb pots are out of control. Two generous bunches of coriander and a big handful of mint, roots still on. Perfect for chutney, salads, or a very large mojito.',
                'category' => ListingCategory::Garden,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => '2 bunches',
                'expiry_date' => now()->addDays(3),
                'pickup_instructions' => 'I am in the low-rise on the park side. Pick up from the lobby shelf any evening — just tell me roughly when.',
                'status' => ListingStatus::Available,
                'hours_ago' => 26,
            ],
            [
                'user' => $sofia,
                'title' => 'Two boxes of lentil pasta',
                'description' => 'Bought these on a whim and realised we already have three boxes open. Unopened, best before next year. Red lentil penne — high protein and genuinely good with a chunky tomato sauce.',
                'category' => ListingCategory::Pantry,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => '2 boxes',
                'expiry_date' => now()->addMonths(8),
                'pickup_instructions' => 'Leave a note and I will pop them in the parcel box by the gate. Any weekday after 9am works.',
                'status' => ListingStatus::Available,
                'hours_ago' => 27,
            ],
            [
                'user' => $jonah,
                'title' => 'Lemons from the tree',
                'description' => 'Our little lemon tree has produced a surprisingly good crop this year. Thin-skinned and juicy, picked this morning. Eight lemons, ready for lemonade, baking, or a very enthusiastic marinade.',
                'category' => ListingCategory::Produce,
                'type' => ListingType::ForSale,
                'price' => 2,
                'quantity' => '8 lemons',
                'expiry_date' => now()->addDays(10),
                'pickup_instructions' => 'Front garden gate pickup. I will leave them in a paper bag with your name on it — just let me know when you are coming.',
                'status' => ListingStatus::Available,
                'hours_ago' => 32,
            ],
            [
                'user' => $maya,
                'title' => 'Open jar of local honey',
                'description' => 'We bought a big jar at the market and will never finish it before it crystallises. About three-quarters full, lovely and floral. Spooned out with a clean spoon every time, promise.',
                'category' => ListingCategory::Pantry,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => '1 jar, 3/4 full',
                'expiry_date' => now()->addMonths(6),
                'pickup_instructions' => 'Same blue door as the tomatoes. Porch pickup before 8pm is easiest.',
                'status' => ListingStatus::Available,
                'hours_ago' => 48,
            ],
            [
                'user' => $amara,
                'title' => 'Bananas that ripened too fast',
                'description' => 'Five very ripe bananas. Ideal for banana bread, smoothies, or the freezer. They are past the eating-fresh stage but nowhere near the bin.',
                'category' => ListingCategory::Produce,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => '5 bananas',
                'expiry_date' => now()->addDays(2),
                'pickup_instructions' => 'On the porch bench, first come first served. I will mark it reserved when someone is on their way.',
                'status' => ListingStatus::Reserved,
                'hours_ago' => 53,
            ],
            [
                'user' => $ben,
                'title' => 'Rosemary cuttings',
                'description' => 'We pruned the rosemary hedge and have four healthy cuttings with roots starting. Plant them in a sunny pot or a sunny corner and they will take off. Smells wonderful on the way home.',
                'category' => ListingCategory::Garden,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => '4 cuttings',
                'expiry_date' => now()->addDays(14),
                'pickup_instructions' => 'Side door, in the wooden crate. Take one or all four. No need to ring first.',
                'status' => ListingStatus::Available,
                'hours_ago' => 58,
            ],
            [
                'user' => $priya,
                'title' => 'Cinnamon raisin bagels',
                'description' => 'Bought a pack for the weekend and then we ended up out for brunch both days. Four bagels, still soft and very good split and toasted.',
                'category' => ListingCategory::Bakery,
                'type' => ListingType::ForSale,
                'price' => 4,
                'quantity' => '4 bagels',
                'expiry_date' => now()->addDays(2),
                'pickup_instructions' => 'Lobby shelf pickup after 6pm. I will pop them in a paper bag with your name on it.',
                'status' => ListingStatus::Completed,
                'hours_ago' => 72,
            ],
            [
                'user' => $sofia,
                'title' => 'One butternut squash',
                'description' => 'A big, beautiful squash from the market, but our meal plan changed. Firm, unblemished, and perfect for a tray of roasted squash soup. One very generous squash.',
                'category' => ListingCategory::Produce,
                'type' => ListingType::ForSale,
                'price' => 3.5,
                'quantity' => '1 squash',
                'expiry_date' => now()->addDays(21),
                'pickup_instructions' => 'Parcel box by the gate is fine. Weekdays after 9am or weekend mornings.',
                'status' => ListingStatus::Available,
                'hours_ago' => 76,
            ],
            [
                'user' => $jonah,
                'title' => 'Two cartons of oat milk',
                'description' => 'Bought the wrong kind for a coffee order. Both unopened and long-dated. Barista-style oat milk — the good, foamy stuff.',
                'category' => ListingCategory::Pantry,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => '2 cartons',
                'expiry_date' => now()->addMonths(5),
                'pickup_instructions' => 'Front gate pickup. Leave me a message and I will put them out with a name label.',
                'status' => ListingStatus::Available,
                'hours_ago' => 84,
            ],
            [
                'user' => $maya,
                'title' => 'Seeded crackers',
                'description' => 'A box of really good seeded crackers that we bought for a cheese night which never happened. Opened but almost full. Still crisp, stored in a tin.',
                'category' => ListingCategory::Pantry,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => '1 box',
                'expiry_date' => now()->addMonths(3),
                'pickup_instructions' => 'Blue door porch pickup, any time before 8pm.',
                'status' => ListingStatus::Completed,
                'hours_ago' => 96,
            ],
            [
                'user' => $amara,
                'title' => 'A bag of garden kale',
                'description' => 'Our kale is thriving and we have picked more than our fridge can hold. A big bag of curly kale, washed and ready. Lovely massaged with lemon and olive oil.',
                'category' => ListingCategory::Garden,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => '1 big bag',
                'expiry_date' => now()->addDays(3),
                'pickup_instructions' => 'Porch bench on Pine and Third. Take the whole bag — no need to split it.',
                'status' => ListingStatus::Available,
                'hours_ago' => 104,
            ],
            [
                'user' => $ben,
                'title' => 'Apple crumble (made too much)',
                'description' => 'I made a big tray of apple crumble for Sunday lunch and there is a very generous half left. Oaty topping, not too sweet. Bring a spoon and a friend.',
                'category' => ListingCategory::Bakery,
                'type' => ListingType::Giveaway,
                'price' => 0,
                'quantity' => 'Half a tray',
                'expiry_date' => now()->addDays(2),
                'pickup_instructions' => 'Porch pickup this evening or tomorrow morning. It is in a lidded tray — please return the tray when you can.',
                'status' => ListingStatus::Available,
                'hours_ago' => 120,
            ],
        ];

        foreach ($listings as $data) {
            $owner = $data['user'];
            $hoursAgo = $data['hours_ago'];

            unset($data['user'], $data['hours_ago']);

            $listing = Listing::factory()->for($owner)->create($data);

            $listing->forceFill([
                'created_at' => now()->subHours($hoursAgo),
                'updated_at' => now()->subHours($hoursAgo),
            ])->saveQuietly();
        }
    }
}
