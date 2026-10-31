@props(['name', 'size' => 'md'])

@php
    $initials = collect(explode(' ', trim($name)))
        ->filter()
        ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
        ->take(2)
        ->implode('');

    $sizes = [
        'sm' => 'size-8 text-[11px]',
        'md' => 'size-10 text-sm',
        'lg' => 'size-14 text-lg',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-grid shrink-0 place-items-center rounded-full bg-sage-100 font-semibold text-sage-800 ring-1 ring-inset ring-sage-600/10 ' . $sizes[$size]]) }}>
    {{ $initials }}
</span>
