@props(['active' => false])

<a {{ $attributes->merge([
    'class' => 'rounded-full px-4 py-2 text-sm font-medium transition ' . ($active
        ? 'bg-sage-100 text-sage-800'
        : 'text-stone-600 hover:bg-cream-100 hover:text-stone-900'),
]) }}>
    {{ $slot }}
</a>
