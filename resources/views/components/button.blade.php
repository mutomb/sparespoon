@props(['variant' => 'primary', 'size' => 'md', 'href' => null])

@php
    $variants = [
        'primary' => 'bg-sage-600 text-cream-50 shadow-sm shadow-sage-900/10 hover:bg-sage-700 focus-visible:outline-sage-600',
        'secondary' => 'border border-cream-300 bg-white text-stone-700 shadow-sm hover:border-sage-300 hover:bg-sage-50 hover:text-sage-800 focus-visible:outline-sage-600',
        'soft' => 'bg-sage-100 text-sage-800 hover:bg-sage-200 focus-visible:outline-sage-600',
        'ghost' => 'text-stone-600 hover:bg-cream-100 hover:text-stone-900 focus-visible:outline-sage-600',
        'danger' => 'border border-clay-200 bg-white text-clay-700 hover:bg-clay-50 focus-visible:outline-clay-600',
    ];

    $sizes = [
        'sm' => 'gap-1.5 rounded-full px-3.5 py-2 text-xs',
        'md' => 'gap-2 rounded-full px-5 py-2.5 text-sm',
        'lg' => 'gap-2 rounded-full px-6 py-3 text-sm',
    ];

    $classes = 'inline-flex items-center justify-center font-semibold transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 disabled:cursor-not-allowed disabled:opacity-60 ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $attributes->get('type', 'submit') }}" {{ $attributes->except('type')->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
