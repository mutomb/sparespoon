@props(['light' => false])

<a href="{{ route('listings.index') }}" {{ $attributes->merge(['class' => 'group inline-flex items-center gap-2.5']) }}>
    <span @class([
        'grid size-10 shrink-0 place-items-center rounded-full shadow-sm transition group-hover:-rotate-6',
        'bg-sage-600 text-cream-50' => ! $light,
        'bg-cream-50 text-sage-700' => $light,
    ])>
        <svg class="size-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <ellipse cx="8.6" cy="7.6" rx="4.3" ry="5.4" transform="rotate(-38 8.6 7.6)" stroke="currentColor" stroke-width="1.7" />
            <path d="m11.9 11.4 8.2 8.2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
        </svg>
    </span>

    <span @class([
        'font-display text-[1.4rem] font-semibold leading-none tracking-tight',
        'text-stone-900' => ! $light,
        'text-cream-50' => $light,
    ])>
        Spare<span @class(['text-sage-600' => ! $light, 'text-sage-300' => $light])>Spoon</span>
    </span>
</a>
