@props([])

<select {{ $attributes->merge([
    'class' => 'mt-1.5 block w-full appearance-none rounded-2xl border border-cream-300 bg-white px-4 py-3 pr-10 text-sm text-stone-800 shadow-sm transition focus:border-sage-500 focus:outline-none focus:ring-2 focus:ring-sage-500/20',
]) }}>
    {{ $slot }}
</select>
