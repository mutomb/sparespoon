<x-layouts.app :title="$listing->title">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <a href="{{ route('listings.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-stone-500 transition hover:text-sage-700">
            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
            </svg>
            Back to the shelf
        </a>

        <div class="mt-6 grid gap-8 lg:grid-cols-[1.55fr_1fr]">
            <article class="overflow-hidden rounded-3xl border border-cream-200 bg-white shadow-[0_1px_2px_rgba(45,66,24,0.04)]">
                <div class="relative flex h-56 items-center justify-center overflow-hidden bg-gradient-to-br {{ $listing->category->gradient() }} sm:h-72">
                    <span class="text-8xl drop-shadow-sm sm:text-9xl" aria-hidden="true">{{ $listing->category->emoji() }}</span>

                    <div class="absolute inset-x-4 top-4 flex flex-wrap items-start justify-between gap-2 sm:inset-x-6 sm:top-6">
                        <div class="flex flex-wrap gap-2">
                            <x-pill class="bg-white/85 text-stone-700 ring-stone-900/10 backdrop-blur">
                                {{ $listing->category->label() }}
                            </x-pill>
                            <x-pill class="{{ $listing->type->badgeClasses() }}">
                                {{ $listing->type->label() }}
                            </x-pill>
                        </div>

                        <x-pill class="{{ $listing->status->badgeClasses() }}">
                            {{ $listing->status->label() }}
                        </x-pill>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h1 class="font-display text-3xl font-semibold leading-tight tracking-tight text-stone-900 sm:text-4xl">
                                {{ $listing->title }}
                            </h1>

                            <p class="mt-2 text-sm text-stone-500">
                                Shared by {{ $listing->user->name }} in {{ $listing->user->locationLabel() ?: 'the neighborhood' }}
                                · {{ $listing->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <span class="inline-flex shrink-0 items-center rounded-2xl bg-sage-50 px-4 py-2.5 font-display text-2xl font-semibold text-sage-700 ring-1 ring-inset ring-sage-600/10">
                            {{ $listing->formattedPrice() }}
                        </span>
                    </div>

                    <div class="mt-7 border-t border-cream-200 pt-7">
                        <h2 class="text-xs font-semibold uppercase tracking-[0.16em] text-stone-400">About this share</h2>
                        <p class="mt-3 whitespace-pre-line text-[15px] leading-relaxed text-stone-600">{{ $listing->description }}</p>
                    </div>

                    <dl class="mt-7 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl border border-cream-200 bg-cream-50/60 px-4 py-3.5">
                            <dt class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-stone-400">
                                <span aria-hidden="true">{{ $listing->category->emoji() }}</span>
                                Category
                            </dt>
                            <dd class="mt-1 text-sm font-semibold text-stone-800">{{ $listing->category->label() }}</dd>
                        </div>

                        <div class="rounded-2xl border border-cream-200 bg-cream-50/60 px-4 py-3.5">
                            <dt class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-stone-400">
                                <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10 1.75a.75.75 0 0 1 .67.415l1.46 2.958 3.265.475a.75.75 0 0 1 .415 1.279l-2.362 2.302.557 3.251a.75.75 0 0 1-1.088.79L10 11.685l-2.917 1.535a.75.75 0 0 1-1.088-.79l.557-3.25L4.19 6.877a.75.75 0 0 1 .415-1.28l3.265-.474 1.46-2.958A.75.75 0 0 1 10 1.75Z" />
                                </svg>
                                Amount
                            </dt>
                            <dd class="mt-1 text-sm font-semibold text-stone-800">{{ $listing->quantity }}</dd>
                        </div>

                        <div @class([
                            'rounded-2xl border px-4 py-3.5',
                            'border-clay-200 bg-clay-50' => $listing->expiresSoon(),
                            'border-cream-200 bg-cream-50/60' => ! $listing->expiresSoon(),
                        ])>
                            <dt class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-stone-400">
                                <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .2.08.39.22.53l3 3a.75.75 0 1 0 1.06-1.06l-2.78-2.78V5Z" clip-rule="evenodd" />
                                </svg>
                                Best before
                            </dt>
                            <dd @class([
                                'mt-1 text-sm font-semibold',
                                'text-clay-700' => $listing->expiresSoon(),
                                'text-stone-800' => ! $listing->expiresSoon(),
                            ])>
                                {{ $listing->expiry_date->format('l, F j, Y') }}
                            </dd>
                        </div>

                        <div class="rounded-2xl border border-cream-200 bg-cream-50/60 px-4 py-3.5">
                            <dt class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-stone-400">
                                <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4h.25V2.75A.75.75 0 0 1 5.75 2Z" clip-rule="evenodd" />
                                </svg>
                                Shared
                            </dt>
                            <dd class="mt-1 text-sm font-semibold text-stone-800">{{ $listing->created_at->format('F j, Y') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-7 rounded-2xl bg-sage-50 p-5 ring-1 ring-inset ring-sage-600/10">
                        <h2 class="flex items-center gap-2 text-sm font-semibold text-sage-900">
                            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9.69 18.933a.75.75 0 0 0 .62 0c.28-.129 6.86-3.243 6.86-9.433a5.25 5.25 0 1 0-10.5 0c0 6.19 6.58 9.304 6.86 9.433ZM10 8.75a1.75 1.75 0 1 0 0-3.5 1.75 1.75 0 0 0 0 3.5Z" clip-rule="evenodd" />
                            </svg>
                            Pickup instructions
                        </h2>
                        <p class="mt-2 whitespace-pre-line text-sm leading-relaxed text-sage-800">{{ $listing->pickup_instructions }}</p>
                    </div>
                </div>
            </article>

            <aside class="space-y-5">
                <div class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-stone-400">Your neighbor</p>

                    <div class="mt-4 flex items-center gap-3">
                        <x-avatar :name="$listing->user->name" size="lg" />

                        <div class="min-w-0">
                            <p class="truncate font-display text-lg font-semibold text-stone-900">{{ $listing->user->name }}</p>
                            <p class="mt-0.5 truncate text-sm text-stone-500">{{ $listing->user->locationLabel() ?: 'Neighborhood not set' }}</p>
                            <p class="mt-0.5 text-xs text-stone-400">Neighbor since {{ $listing->user->created_at->format('F Y') }}</p>
                        </div>
                    </div>

                    <a href="{{ route('listings.index', ['location' => $listing->user->postal_code ?: $listing->user->neighborhood]) }}" class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-sage-700 transition hover:text-sage-800">
                        More from this neighborhood
                        <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 4.99a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.968H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                @can('update', $listing)
                    <div class="rounded-3xl border border-sage-200 bg-sage-50/70 p-6">
                        <div class="flex items-center justify-between gap-3">
                            <h2 class="font-display text-lg font-semibold text-stone-900">Manage this share</h2>
                            <x-pill class="{{ $listing->status->badgeClasses() }}">{{ $listing->status->label() }}</x-pill>
                        </div>

                        <p class="mt-1.5 text-sm text-stone-600">Keep neighbors in the loop as this one finds a home.</p>

                        <div class="mt-4 flex flex-wrap gap-2">
                            @if ($listing->status === \App\Enums\ListingStatus::Available)
                                <form method="POST" action="{{ route('listings.status.update', $listing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ \App\Enums\ListingStatus::Reserved->value }}">
                                    <x-button size="sm" variant="secondary">Mark reserved</x-button>
                                </form>
                            @endif

                            @if ($listing->status !== \App\Enums\ListingStatus::Completed)
                                <form method="POST" action="{{ route('listings.status.update', $listing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ \App\Enums\ListingStatus::Completed->value }}">
                                    <x-button size="sm" variant="secondary">Mark completed</x-button>
                                </form>
                            @endif

                            @if ($listing->status !== \App\Enums\ListingStatus::Available)
                                <form method="POST" action="{{ route('listings.status.update', $listing) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ \App\Enums\ListingStatus::Available->value }}">
                                    <x-button size="sm" variant="soft">Put back on the shelf</x-button>
                                </form>
                            @endif
                        </div>

                        <div class="mt-5 flex flex-wrap items-center gap-2 border-t border-sage-200/70 pt-4">
                            <x-button :href="route('listings.edit', $listing)" size="sm" variant="secondary">
                                Edit listing
                            </x-button>

                            <form method="POST" action="{{ route('listings.destroy', $listing) }}" onsubmit="return confirm('Remove this listing for good?')">
                                @csrf
                                @method('DELETE')
                                <x-button size="sm" variant="danger">Delete</x-button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="rounded-3xl border border-cream-200 bg-cream-100/60 p-6">
                        <h2 class="font-display text-lg font-semibold text-stone-900">How pickup works</h2>

                        <ol class="mt-4 space-y-4">
                            <li class="flex gap-3">
                                <span class="grid size-7 shrink-0 place-items-center rounded-full bg-white text-xs font-semibold text-sage-700 ring-1 ring-inset ring-sage-600/10">1</span>
                                <p class="text-sm leading-relaxed text-stone-600">Read the pickup instructions and choose a time that works for both of you.</p>
                            </li>
                            <li class="flex gap-3">
                                <span class="grid size-7 shrink-0 place-items-center rounded-full bg-white text-xs font-semibold text-sage-700 ring-1 ring-inset ring-sage-600/10">2</span>
                                <p class="text-sm leading-relaxed text-stone-600">Pop by at the agreed time. Bring a bag or container if you can.</p>
                            </li>
                            <li class="flex gap-3">
                                <span class="grid size-7 shrink-0 place-items-center rounded-full bg-white text-xs font-semibold text-sage-700 ring-1 ring-inset ring-sage-600/10">3</span>
                                <p class="text-sm leading-relaxed text-stone-600">Enjoy it, and pass on anything you can't finish. That's the whole idea.</p>
                            </li>
                        </ol>
                    </div>
                @endcan

                <div class="rounded-3xl border border-dashed border-cream-300 p-5 text-sm leading-relaxed text-stone-500">
                    <span class="font-semibold text-stone-700">A small kindness.</span>
                    SpareSpoon runs on neighbors being generous and flexible. If plans change, let each other know.
                </div>
            </aside>
        </div>

        @if ($related->isNotEmpty())
            <section class="mt-16">
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sage-600">More like this</p>
                        <h2 class="mt-2 font-display text-2xl font-semibold tracking-tight text-stone-900 sm:text-3xl">
                            Also on the shelf nearby
                        </h2>
                    </div>

                    <a href="{{ route('listings.index', ['category' => $listing->category->value]) }}" class="hidden text-sm font-semibold text-sage-700 transition hover:text-sage-800 sm:inline-flex sm:items-center sm:gap-1.5">
                        All {{ strtolower($listing->category->label()) }}
                        <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 4.99a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.968H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $relatedListing)
                        <x-listing-card :listing="$relatedListing" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layouts.app>
