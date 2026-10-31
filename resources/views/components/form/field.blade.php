@props(['label', 'name', 'hint' => null, 'required' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-semibold text-stone-700">
        {{ $label }}
        @if ($required)
            <span class="text-clay-600" aria-hidden="true">*</span>
        @endif
    </label>

    {{ $slot }}

    @if ($hint)
        <p id="{{ $name }}-hint" class="mt-1.5 text-xs leading-relaxed text-stone-500">{{ $hint }}</p>
    @endif

    @error($name)
        <p id="{{ $name }}-error" class="mt-1.5 flex items-start gap-1 text-xs font-medium text-clay-600">
            <svg class="mt-px size-3.5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>
