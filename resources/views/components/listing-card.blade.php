@props(['listing'])

<article class="group flex h-full flex-col overflow-hidden rounded-3xl border border-cream-200 bg-white shadow-[0_1px_2px_rgba(45,66,24,0.04)] transition duration-300 hover:-translate-y-1 hover:border-sage-200 hover:shadow-xl hover:shadow-sage-900/5">
    <a href="{{ route('listings.show', $listing) }}" class="relative flex h-40 shrink-0 items-center justify-center overflow-hidden bg-gradient-to-br {{ $listing->category->gradient() }}" tabindex="-1" aria-hidden="true">
        <span class="text-6xl drop-shadow-sm transition duration-300 group-hover:scale-110">{{ $listing->category->emoji() }}</span>

        <div class="absolute inset-x-3 top-3 flex items-start justify-between gap-2">
            <x-pill class="bg-white/85 text-stone-700 ring-stone-900/10 backdrop-blur">
                {{ $listing->category->label() }}
            </x-pill>

            <x-pill class="{{ $listing->type->badgeClasses() }}">
                {{ $listing->type->label() }}
            </x-pill>
        </div>
    </a>

    <div class="flex flex-1 flex-col p-5">
        <div class="flex items-start justify-between gap-3">
            <h3 class="font-display text-lg font-semibold leading-snug text-stone-900">
                <a href="{{ route('listings.show', $listing) }}" class="transition hover:text-sage-700">
                    {{ $listing->title }}
                </a>
            </h3>

            <span class="shrink-0 font-display text-lg font-semibold text-sage-700">{{ $listing->formattedPrice() }}</span>
        </div>

        <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-stone-600">{{ $listing->description }}</p>

        <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-stone-500">
            <span class="inline-flex items-center gap-1.5">
                <svg class="size-3.5 text-sage-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path d="M10 1.75a.75.75 0 0 1 .67.415l1.46 2.958 3.265.475a.75.75 0 0 1 .415 1.279l-2.362 2.302.557 3.251a.75.75 0 0 1-1.088.79L10 11.685l-2.917 1.535a.75.75 0 0 1-1.088-.79l.557-3.25L4.19 6.877a.75.75 0 0 1 .415-1.28l3.265-.474 1.46-2.958A.75.75 0 0 1 10 1.75Z" />
                </svg>
                {{ $listing->quantity }}
            </span>

            <span @class([
                'inline-flex items-center gap-1.5',
                'font-medium text-clay-600' => $listing->expiresSoon(),
            ])>
                <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .2.08.39.22.53l3 3a.75.75 0 1 0 1.06-1.06l-2.78-2.78V5Z" clip-rule="evenodd" />
                </svg>
                {{ $listing->expiryLabel() }}
            </span>
        </div>

        <div class="mt-auto pt-5">
            <div class="flex items-center gap-2.5 border-t border-cream-100 pt-4">
                <x-avatar :name="$listing->user->name" size="sm" />

                <div class="min-w-0">
                    <p class="truncate text-xs font-semibold text-stone-800">{{ $listing->user->name }}</p>
                    <p class="truncate text-[11px] text-stone-500">{{ $listing->user->locationLabel() ?: 'Neighborhood not set' }}</p>
                </div>

                <span class="ml-auto inline-flex items-center gap-1 text-xs font-semibold text-sage-700">
                    View
                    <svg class="size-3.5 transition group-hover:translate-x-0.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 4.99a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.968H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                    </svg>
                </span>
            </div>
        </div>
    </div>
</article>
