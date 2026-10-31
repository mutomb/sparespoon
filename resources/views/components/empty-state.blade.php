@props(['title', 'description', 'icon' => '🥣'])

<div class="rounded-3xl border border-dashed border-cream-300 bg-white/60 px-6 py-16 text-center">
    <div class="mx-auto grid size-16 place-items-center rounded-full bg-cream-100 text-3xl" aria-hidden="true">
        {{ $icon }}
    </div>

    <h3 class="mt-5 font-display text-xl font-semibold text-stone-900">{{ $title }}</h3>
    <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-stone-600">{{ $description }}</p>

    @unless ($slot->isEmpty())
        <div class="mt-6 flex flex-wrap justify-center gap-3">{{ $slot }}</div>
    @endunless
</div>
