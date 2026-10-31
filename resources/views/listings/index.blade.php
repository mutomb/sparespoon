<x-layouts.app>
    @php
        $spotlight = $listings->getCollection()->first();
    @endphp

    <section class="relative overflow-hidden border-b border-cream-200">
        <div class="pointer-events-none absolute -right-32 -top-40 size-[28rem] rounded-full bg-sage-200/40 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-48 left-1/4 size-[30rem] rounded-full bg-cream-200/60 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-4 py-14 sm:px-6 sm:py-20 lg:grid-cols-[1.1fr_0.9fr] lg:px-8 lg:py-24">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-sage-200 bg-white/70 px-3.5 py-1.5 text-xs font-semibold text-sage-800 shadow-sm">
                    <span class="relative flex size-2">
                        <span class="absolute inline-flex size-full animate-ping rounded-full bg-sage-500 opacity-60"></span>
                        <span class="relative inline-flex size-2 rounded-full bg-sage-600"></span>
                    </span>
                    Hyper-local food sharing
                </span>

                <h1 class="mt-6 font-display text-4xl font-semibold leading-[1.05] tracking-tight text-stone-900 sm:text-5xl lg:text-[3.75rem]">
                    Good food deserves
                    <span class="relative whitespace-nowrap text-sage-600">
                        a second helping.
                        <svg class="absolute -bottom-2 left-0 h-2.5 w-full text-sage-300" viewBox="0 0 300 12" preserveAspectRatio="none" aria-hidden="true">
                            <path d="M2 8c60-5 120-6 180-2s80 4 116 1" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
                        </svg>
                    </span>
                </h1>

                <p class="mt-7 max-w-xl text-base leading-relaxed text-stone-600 sm:text-lg">
                    Pass on the extra tomatoes, the loaf you won't finish, or the pantry tin you bought twice. SpareSpoon connects you with neighbors on your street — no fees, no fuss, just good food.
                </p>

                @auth
                    @if (auth()->user()->hasLocation())
                        <div class="mt-7 inline-flex flex-wrap items-center gap-x-2 gap-y-1 rounded-full border border-sage-200 bg-white/80 px-4 py-2.5 text-sm shadow-sm">
                            <svg class="size-4 text-sage-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M9.69 18.933a.75.75 0 0 0 .62 0c.28-.129 6.86-3.243 6.86-9.433a5.25 5.25 0 1 0-10.5 0c0 6.19 6.58 9.304 6.86 9.433ZM10 8.75a1.75 1.75 0 1 0 0-3.5 1.75 1.75 0 0 0 0 3.5Z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold text-stone-800">Near you:</span>
                            <span class="text-stone-600">{{ auth()->user()->locationLabel() }}</span>
                            <a href="{{ route('profile.edit') }}" class="text-xs font-semibold text-sage-700 underline decoration-sage-300 underline-offset-2 hover:text-sage-800">
                                Change
                            </a>
                        </div>
                    @else
                        <a href="{{ route('profile.edit') }}" class="mt-7 inline-flex items-center gap-2 rounded-full border border-clay-200 bg-clay-50 px-4 py-2.5 text-sm font-semibold text-clay-700 transition hover:bg-clay-100">
                            Set your neighborhood to see what's nearby
                            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 4.99a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.968H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                @endauth

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <x-button href="#near-you" size="lg">
                        Browse the shelf
                        <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 3a.75.75 0 0 1 .75.75v9.19l2.72-2.72a.75.75 0 1 1 1.06 1.06l-4 4a.75.75 0 0 1-1.06 0l-4-4a.75.75 0 1 1 1.06-1.06l2.72 2.72V3.75A.75.75 0 0 1 10 3Z" clip-rule="evenodd" />
                        </svg>
                    </x-button>

                    @auth
                        <x-button :href="route('listings.create')" variant="secondary" size="lg">
                            Share your extra
                        </x-button>
                    @else
                        <x-button :href="route('register')" variant="secondary" size="lg">
                            Join your neighborhood
                        </x-button>
                    @endauth
                </div>

                <dl class="mt-12 flex flex-wrap gap-x-10 gap-y-6 border-t border-cream-300/70 pt-7">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-stone-400">On the shelf</dt>
                        <dd class="mt-1 font-display text-2xl font-semibold text-stone-900">{{ number_format($communityListings) }} <span class="font-sans text-sm font-medium text-stone-500">shares</span></dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-stone-400">Around the corner</dt>
                        <dd class="mt-1 font-display text-2xl font-semibold text-stone-900">{{ number_format($neighborCount) }} <span class="font-sans text-sm font-medium text-stone-500">neighbors</span></dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-stone-400">Always</dt>
                        <dd class="mt-1 font-display text-2xl font-semibold text-stone-900">Free <span class="font-sans text-sm font-medium text-stone-500">to share</span></dd>
                    </div>
                </dl>
            </div>

            <div class="relative mx-auto w-full max-w-md lg:max-w-none">
                <div class="absolute -inset-4 rotate-3 rounded-[2.5rem] bg-sage-200/60"></div>
                <div class="absolute -inset-4 -rotate-2 rounded-[2.5rem] border border-sage-200/70 bg-cream-100/50"></div>

                @if ($spotlight)
                    <article class="relative overflow-hidden rounded-[2rem] border border-cream-200 bg-white p-3 shadow-2xl shadow-sage-900/10">
                        <a href="{{ route('listings.show', $spotlight) }}" class="relative flex h-48 items-center justify-center overflow-hidden rounded-[1.5rem] bg-gradient-to-br {{ $spotlight->category->gradient() }} sm:h-56">
                            <span class="text-7xl drop-shadow-sm sm:text-8xl" aria-hidden="true">{{ $spotlight->category->emoji() }}</span>

                            <x-pill class="absolute left-4 top-4 bg-white/85 text-stone-700 ring-stone-900/10 backdrop-blur">
                                Just shared
                            </x-pill>

                            <x-pill class="absolute right-4 top-4 {{ $spotlight->type->badgeClasses() }}">
                                {{ $spotlight->type->label() }}
                            </x-pill>
                        </a>

                        <div class="p-4">
                            <div class="flex items-start justify-between gap-3">
                                <h2 class="font-display text-xl font-semibold leading-snug text-stone-900">
                                    <a href="{{ route('listings.show', $spotlight) }}" class="transition hover:text-sage-700">
                                        {{ $spotlight->title }}
                                    </a>
                                </h2>
                                <span class="shrink-0 font-display text-lg font-semibold text-sage-700">{{ $spotlight->formattedPrice() }}</span>
                            </div>

                            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-stone-600">{{ $spotlight->description }}</p>

                            <div class="mt-4 flex items-center gap-2.5 border-t border-cream-100 pt-4">
                                <x-avatar :name="$spotlight->user->name" size="sm" />
                                <div class="min-w-0">
                                    <p class="truncate text-xs font-semibold text-stone-800">{{ $spotlight->user->name }}</p>
                                    <p class="truncate text-[11px] text-stone-500">{{ $spotlight->user->locationLabel() }}</p>
                                </div>
                                <span class="ml-auto inline-flex items-center gap-1 text-xs font-semibold text-sage-700">
                                    Take a look
                                    <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 4.99a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.968H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </article>
                @else
                    <div class="relative overflow-hidden rounded-[2rem] border border-cream-200 bg-white p-8 shadow-2xl shadow-sage-900/10">
                        <div class="grid size-14 place-items-center rounded-2xl bg-sage-100 text-3xl" aria-hidden="true">🧺</div>
                        <h2 class="mt-5 font-display text-2xl font-semibold text-stone-900">A shelf for your street</h2>
                        <p class="mt-2 text-sm leading-relaxed text-stone-600">
                            Every listing starts with one neighbor. Share something today and be the first good thing on your street's shelf.
                        </p>
                        <x-button :href="auth()->check() ? route('listings.create') : route('register')" class="mt-6" size="sm">
                            Share the first thing
                        </x-button>
                    </div>
                @endif

                <div class="absolute -bottom-6 -left-4 hidden rotate-[-3deg] rounded-2xl border border-cream-200 bg-white/95 px-4 py-3 shadow-lg shadow-sage-900/10 sm:flex sm:items-center sm:gap-3">
                    <span class="text-2xl" aria-hidden="true">🌱</span>
                    <div>
                        <p class="text-xs font-semibold text-stone-800">Less in the bin</p>
                        <p class="text-[11px] text-stone-500">More on the table</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="near-you" class="mx-auto max-w-7xl scroll-mt-24 px-4 py-12 sm:px-6 sm:py-16 lg:px-8">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sage-600">Fresh near you</p>
                <h2 class="mt-2 font-display text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">
                    What neighbors are sharing
                </h2>

                <p class="mt-2 max-w-xl text-sm leading-relaxed text-stone-600">
                    @if ($nearOnly)
                        Available food in {{ auth()->user()->locationLabel() }}, newest first.
                    @elseif ($search !== '')
                        Showing shares matching “{{ $search }}”, newest first.
                    @elseif ($showAll)
                        Every available share, from every neighborhood.
                    @else
                        Available food from the SpareSpoon community, newest first.
                    @endif
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                @if ($nearOnly)
                    <x-pill class="bg-sage-100 text-sage-800 ring-sage-600/20">
                        <svg class="size-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9.69 18.933a.75.75 0 0 0 .62 0c.28-.129 6.86-3.243 6.86-9.433a5.25 5.25 0 1 0-10.5 0c0 6.19 6.58 9.304 6.86 9.433ZM10 8.75a1.75 1.75 0 1 0 0-3.5 1.75 1.75 0 0 0 0 3.5Z" clip-rule="evenodd" />
                        </svg>
                        Near you
                    </x-pill>

                    <a href="{{ route('listings.index', ['all' => 1]) }}" class="text-xs font-semibold text-stone-500 underline decoration-cream-300 underline-offset-2 transition hover:text-sage-700">
                        Show every neighborhood
                    </a>
                @elseif ($search !== '')
                    <x-pill class="bg-sage-100 text-sage-800 ring-sage-600/20">Search: {{ $search }}</x-pill>
                    <a href="{{ route('listings.index') }}" class="text-xs font-semibold text-stone-500 underline decoration-cream-300 underline-offset-2 transition hover:text-sage-700">
                        Clear search
                    </a>
                @elseif ($showAll && auth()->check() && auth()->user()->hasLocation())
                    <x-pill class="bg-cream-200 text-stone-700 ring-stone-900/10">All neighborhoods</x-pill>
                    <a href="{{ route('listings.index') }}" class="text-xs font-semibold text-stone-500 underline decoration-cream-300 underline-offset-2 transition hover:text-sage-700">
                        Back to near you
                    </a>
                @endif
            </div>
        </div>

        <form action="{{ route('listings.index') }}" method="GET" class="mt-8 grid gap-3 rounded-3xl border border-cream-200 bg-white p-3.5 shadow-sm sm:p-4 md:grid-cols-[1.5fr_1fr_auto]">
            <div class="relative">
                <label for="location" class="sr-only">Neighborhood or postal code</label>
                <svg class="pointer-events-none absolute left-4 top-1/2 size-4 -translate-y-1/2 text-stone-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                </svg>
                <input
                    id="location"
                    name="location"
                    type="search"
                    value="{{ $search }}"
                    placeholder="Neighborhood or postal code"
                    class="block w-full rounded-2xl border border-cream-300 bg-cream-50/50 py-3 pl-11 pr-4 text-sm text-stone-800 shadow-sm transition placeholder:text-stone-400 focus:border-sage-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sage-500/20"
                >
            </div>

            <div class="relative">
                <label for="category" class="sr-only">Food category</label>
                <select
                    id="category"
                    name="category"
                    class="block w-full appearance-none rounded-2xl border border-cream-300 bg-cream-50/50 px-4 py-3 pr-10 text-sm text-stone-800 shadow-sm transition focus:border-sage-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sage-500/20"
                >
                    <option value="">Every category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->value }}" @selected($selectedCategory === $category)>
                            {{ $category->label() }}
                        </option>
                    @endforeach
                </select>
                <svg class="pointer-events-none absolute right-4 top-1/2 size-3.5 -translate-y-1/2 text-stone-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                </svg>
            </div>

            <x-button size="md" class="w-full py-3">
                Find food
            </x-button>
        </form>

        @if ($listings->isEmpty())
            <div class="mt-10">
                @if (auth()->check() && ! auth()->user()->hasLocation() && $search === '')
                    <x-empty-state
                        icon="📍"
                        title="Set your neighborhood first"
                        description="SpareSpoon shows food around the corner. Add your neighborhood and postal code to see what's on nearby shelves."
                    >
                        <x-button :href="route('profile.edit')" size="sm">Set my location</x-button>
                    </x-empty-state>
                @elseif ($search !== '')
                    <x-empty-state
                        icon="🔍"
                        title="Nothing matched that search"
                        description="Try a nearby neighborhood or a broader postal code. You can also browse every neighborhood at once."
                    >
                        <x-button :href="route('listings.index', ['all' => 1])" size="sm">Browse everywhere</x-button>
                        <x-button :href="route('listings.index')" variant="secondary" size="sm">Start again</x-button>
                    </x-empty-state>
                @elseif ($selectedCategory)
                    <x-empty-state
                        icon="{{ $selectedCategory->emoji() }}"
                        title="No {{ strtolower($selectedCategory->label()) }} nearby just yet"
                        description="The shelf changes every day. Clear the category filter or check back after the next garden harvest."
                    >
                        <x-button :href="route('listings.index', $showAll ? ['all' => 1] : [])" size="sm">Show every category</x-button>
                    </x-empty-state>
                @else
                    <x-empty-state
                        icon="🧺"
                        title="The shelf is empty right now"
                        description="Be the first to put something on it. Extra herbs, a spare loaf, or a pantry item can make someone's day."
                    >
                        @auth
                            <x-button :href="route('listings.create')" size="sm">Share something</x-button>
                        @else
                            <x-button :href="route('register')" size="sm">Join and share</x-button>
                        @endauth
                        @if ($nearOnly)
                            <x-button :href="route('listings.index', ['all' => 1])" variant="secondary" size="sm">Look further afield</x-button>
                        @endif
                    </x-empty-state>
                @endif
            </div>
        @else
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($listings as $listing)
                    <x-listing-card :listing="$listing" />
                @endforeach
            </div>

            {{ $listings->onEachSide(1)->links('components.pagination') }}
        @endif
    </section>
</x-layouts.app>
