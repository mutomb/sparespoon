<x-layouts.app title="My listings">
    @php
        $user = auth()->user();
        $firstName = Str::before($user->name, ' ');
        $statusCards = [
            [
                'key' => null,
                'label' => 'All shares',
                'value' => $counts['all'],
                'icon' => '🧺',
                'href' => route('dashboard'),
                'active' => $selectedStatus === null,
            ],
            [
                'key' => \App\Enums\ListingStatus::Available->value,
                'label' => 'Available',
                'value' => $counts[\App\Enums\ListingStatus::Available->value],
                'icon' => '🌿',
                'href' => route('dashboard', ['status' => \App\Enums\ListingStatus::Available->value]),
                'active' => $selectedStatus === \App\Enums\ListingStatus::Available,
            ],
            [
                'key' => \App\Enums\ListingStatus::Reserved->value,
                'label' => 'Reserved',
                'value' => $counts[\App\Enums\ListingStatus::Reserved->value],
                'icon' => '🤝',
                'href' => route('dashboard', ['status' => \App\Enums\ListingStatus::Reserved->value]),
                'active' => $selectedStatus === \App\Enums\ListingStatus::Reserved,
            ],
            [
                'key' => \App\Enums\ListingStatus::Completed->value,
                'label' => 'Completed',
                'value' => $counts[\App\Enums\ListingStatus::Completed->value],
                'icon' => '✓',
                'href' => route('dashboard', ['status' => \App\Enums\ListingStatus::Completed->value]),
                'active' => $selectedStatus === \App\Enums\ListingStatus::Completed,
            ],
        ];
    @endphp

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sage-600">Your neighborhood shelf</p>
                <h1 class="mt-2 font-display text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">
                    Hello, {{ $firstName }}.
                </h1>
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-stone-600">
                    Here's everything you've shared, and where each one stands. Keep it fresh so neighbors know what's still up for grabs.
                </p>
            </div>

            <x-button :href="route('listings.create')" size="md">
                <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                </svg>
                Share food
            </x-button>
        </div>

        @unless ($user->hasLocation())
            <div class="mt-8 flex flex-col gap-4 rounded-3xl border border-clay-200 bg-clay-50 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-start gap-3">
                    <span class="grid size-10 shrink-0 place-items-center rounded-2xl bg-white/70 text-lg" aria-hidden="true">📍</span>
                    <div>
                        <p class="font-semibold text-clay-700">Add your neighborhood to complete your shelf</p>
                        <p class="mt-0.5 text-sm text-clay-700/80">Your browse feed uses it to show food around the corner.</p>
                    </div>
                </div>

                <x-button :href="route('profile.edit')" size="sm" variant="secondary" class="shrink-0">
                    Set my location
                </x-button>
            </div>
        @endunless

        <div class="mt-8 grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
            @foreach ($statusCards as $card)
                <a href="{{ $card['href'] }}" @class([
                    'group rounded-3xl border p-4 transition sm:p-5',
                    'border-sage-300 bg-sage-50 ring-1 ring-inset ring-sage-600/10' => $card['active'],
                    'border-cream-200 bg-white hover:border-sage-200 hover:bg-sage-50/40' => ! $card['active'],
                ])>
                    <div class="flex items-start justify-between">
                        <span class="grid size-9 place-items-center rounded-xl bg-white text-lg shadow-sm ring-1 ring-inset ring-stone-900/5" aria-hidden="true">
                            {{ $card['icon'] }}
                        </span>

                        @if ($card['active'])
                            <span class="grid size-6 place-items-center rounded-full bg-sage-600 text-cream-50">
                                <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </div>

                    <p class="mt-4 font-display text-3xl font-semibold text-stone-900">{{ $card['value'] }}</p>
                    <p class="mt-0.5 text-xs font-semibold text-stone-500">{{ $card['label'] }}</p>
                </a>
            @endforeach
        </div>

        <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_20rem]">
            <section>
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <h2 class="font-display text-2xl font-semibold tracking-tight text-stone-900">
                            {{ $selectedStatus ? $selectedStatus->label().' listings' : 'Your listings' }}
                        </h2>
                        <p class="mt-1 text-sm text-stone-500">
                            {{ $listings->total() }} {{ Str::plural('share', $listings->total()) }}{{ $selectedStatus ? ' in this view' : ' in total' }}
                        </p>
                    </div>

                    @if ($selectedStatus)
                        <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-stone-500 underline decoration-cream-300 underline-offset-2 transition hover:text-sage-700">
                            Clear filter
                        </a>
                    @endif
                </div>

                @if ($listings->isEmpty())
                    <div class="mt-5">
                        @if ($counts['all'] === 0)
                            <x-empty-state
                                icon="🧺"
                                title="Your shelf is waiting"
                                description="Share something you won't get through — a garden glut, a spare loaf, or a pantry duplicate. Your neighbors will thank you."
                            >
                                <x-button :href="route('listings.create')" size="sm">Share your first listing</x-button>
                            </x-empty-state>
                        @else
                            <x-empty-state
                                icon="🍃"
                                title="Nothing {{ $selectedStatus->label() }} right now"
                                description="There are no listings in this view. Try another status, or share something new."
                            >
                                <x-button :href="route('dashboard')" size="sm" variant="secondary">Show all listings</x-button>
                                <x-button :href="route('listings.create')" size="sm">Share food</x-button>
                            </x-empty-state>
                        @endif
                    </div>
                @else
                    <div class="mt-5 space-y-4">
                        @foreach ($listings as $listing)
                            <article class="rounded-3xl border border-cream-200 bg-white p-4 shadow-[0_1px_2px_rgba(45,66,24,0.04)] transition hover:border-sage-200 sm:p-5">
                                <div class="flex gap-4">
                                    <a href="{{ route('listings.show', $listing) }}" class="relative grid size-16 shrink-0 place-items-center overflow-hidden rounded-2xl bg-gradient-to-br {{ $listing->category->gradient() }} sm:size-20" aria-hidden="true" tabindex="-1">
                                        <span class="text-3xl sm:text-4xl">{{ $listing->category->emoji() }}</span>
                                    </a>

                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-start justify-between gap-x-3 gap-y-1">
                                            <h3 class="min-w-0 font-display text-lg font-semibold leading-snug text-stone-900">
                                                <a href="{{ route('listings.show', $listing) }}" class="transition hover:text-sage-700">
                                                    {{ $listing->title }}
                                                </a>
                                            </h3>

                                            <span class="shrink-0 font-display text-base font-semibold text-sage-700">{{ $listing->formattedPrice() }}</span>
                                        </div>

                                        <div class="mt-2 flex flex-wrap items-center gap-1.5">
                                            <x-pill class="{{ $listing->status->badgeClasses() }}">{{ $listing->status->label() }}</x-pill>
                                            <x-pill class="{{ $listing->type->badgeClasses() }}">{{ $listing->type->label() }}</x-pill>
                                            <x-pill class="bg-cream-100 text-stone-600 ring-stone-900/5">{{ $listing->category->label() }}</x-pill>
                                        </div>

                                        <p class="mt-2.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-stone-500">
                                            <span>{{ $listing->quantity }}</span>
                                            <span @class(['font-medium text-clay-600' => $listing->expiresSoon()])>{{ $listing->expiryLabel() }}</span>
                                            <span>Shared {{ $listing->created_at->diffForHumans() }}</span>
                                        </p>

                                        <div class="mt-3.5 flex flex-wrap items-center gap-2">
                                            <x-button :href="route('listings.edit', $listing)" size="sm" variant="secondary">Edit</x-button>

                                            @if ($listing->status === \App\Enums\ListingStatus::Available)
                                                <form method="POST" action="{{ route('listings.status.update', $listing) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ \App\Enums\ListingStatus::Reserved->value }}">
                                                    <x-button size="sm" variant="ghost">Reserve</x-button>
                                                </form>
                                            @endif

                                            @if ($listing->status !== \App\Enums\ListingStatus::Completed)
                                                <form method="POST" action="{{ route('listings.status.update', $listing) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ \App\Enums\ListingStatus::Completed->value }}">
                                                    <x-button size="sm" variant="ghost">Complete</x-button>
                                                </form>
                                            @endif

                                            @if ($listing->status !== \App\Enums\ListingStatus::Available)
                                                <form method="POST" action="{{ route('listings.status.update', $listing) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ \App\Enums\ListingStatus::Available->value }}">
                                                    <x-button size="sm" variant="ghost">Reopen</x-button>
                                                </form>
                                            @endif

                                            <form method="POST" action="{{ route('listings.destroy', $listing) }}" onsubmit="return confirm('Remove this listing for good?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-full px-3.5 py-2 text-xs font-semibold text-stone-400 transition hover:bg-clay-50 hover:text-clay-600">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{ $listings->onEachSide(1)->links('components.pagination') }}
                @endif
            </section>

            <aside class="space-y-5">
                <div class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="font-display text-lg font-semibold text-stone-900">Your neighborhood</h2>
                        <span class="grid size-9 place-items-center rounded-xl bg-sage-100 text-sage-700" aria-hidden="true">
                            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.69 18.933a.75.75 0 0 0 .62 0c.28-.129 6.86-3.243 6.86-9.433a5.25 5.25 0 1 0-10.5 0c0 6.19 6.58 9.304 6.86 9.433ZM10 8.75a1.75 1.75 0 1 0 0-3.5 1.75 1.75 0 0 0 0 3.5Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>

                    @if ($user->hasLocation())
                        <p class="mt-4 font-semibold text-stone-800">{{ $user->neighborhood ?: 'Neighborhood not set' }}</p>
                        <p class="mt-0.5 text-sm text-stone-500">{{ $user->postal_code ?: 'No postal code yet' }}</p>
                        <p class="mt-3 text-xs leading-relaxed text-stone-500">
                            Your browse feed is tuned to this area. Change it any time — your listings stay put.
                        </p>
                    @else
                        <p class="mt-4 text-sm leading-relaxed text-stone-600">
                            Add a neighborhood and postal code so SpareSpoon can show you food from around the corner.
                        </p>
                    @endif

                    <x-button :href="route('profile.edit')" size="sm" variant="secondary" class="mt-4 w-full">
                        Edit location
                    </x-button>
                </div>

                <div class="rounded-3xl border border-sage-200 bg-sage-50/70 p-6">
                    <h2 class="font-display text-lg font-semibold text-stone-900">A good shelf listing</h2>
                    <ul class="mt-3 space-y-2.5 text-sm leading-relaxed text-stone-600">
                        <li class="flex gap-2">
                            <span class="text-sage-600" aria-hidden="true">✓</span>
                            Say exactly what and how much it is.
                        </li>
                        <li class="flex gap-2">
                            <span class="text-sage-600" aria-hidden="true">✓</span>
                            Keep the best-before date realistic.
                        </li>
                        <li class="flex gap-2">
                            <span class="text-sage-600" aria-hidden="true">✓</span>
                            Make pickup instructions easy to follow.
                        </li>
                        <li class="flex gap-2">
                            <span class="text-sage-600" aria-hidden="true">✓</span>
                            Mark it reserved once someone's coming.
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.app>
