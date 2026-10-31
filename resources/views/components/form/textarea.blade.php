@props([])

<textarea {{ $attributes->merge([
    'rows' => 4,
    'class' => 'mt-1.5 block w-full rounded-2xl border border-cream-300 bg-white px-4 py-3 text-sm text-stone-800 shadow-sm transition placeholder:text-stone-400 focus:border-sage-500 focus:outline-none focus:ring-2 focus:ring-sage-500/20',
]) }}>{{ $slot }}</textarea>
