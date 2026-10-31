<x-layouts.app title="Share food">
    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <a href="{{ route('listings.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-stone-500 transition hover:text-sage-700">
            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
            </svg>
            Back to the shelf
        </a>

        <div class="mt-6">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sage-600">Share food</p>
            <h1 class="mt-2 font-display text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">
                Give something a good home.
            </h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-stone-600 sm:text-base">
                A few details help neighbors know what's on offer and how to collect it. You can change or close the listing any time.
            </p>
        </div>

        <div class="mt-8">
            @include('listings.partials.form')
        </div>
    </div>
</x-layouts.app>
