<x-layouts.auth title="Join your neighborhood">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sage-600">Join SpareSpoon</p>
        <h1 class="mt-3 font-display text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">
            Good food, close by.
        </h1>
        <p class="mt-3 text-sm leading-relaxed text-stone-600">
            Set your neighborhood once, then browse and share food with the people around the corner.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
        @csrf

        <x-form.field label="Your name" name="name" required>
            <x-form.input
                name="name"
                :value="old('name')"
                placeholder="Maya Thompson"
                autocomplete="name"
                maxlength="255"
                required
                autofocus
            />
        </x-form.field>

        <x-form.field label="Email" name="email" required>
            <x-form.input
                name="email"
                type="email"
                :value="old('email')"
                placeholder="you@example.com"
                autocomplete="email"
                required
            />
        </x-form.field>

        <div class="grid gap-5 sm:grid-cols-2">
            <x-form.field label="Neighborhood" name="neighborhood" required>
                <x-form.input
                    name="neighborhood"
                    :value="old('neighborhood')"
                    placeholder="Riverside"
                    maxlength="100"
                    required
                />
            </x-form.field>

            <x-form.field label="Postal code" name="postal_code" required>
                <x-form.input
                    name="postal_code"
                    :value="old('postal_code')"
                    placeholder="M4E 1A1"
                    autocomplete="postal-code"
                    maxlength="20"
                    required
                />
            </x-form.field>
        </div>

        <x-form.field label="Password" name="password" required hint="At least 8 characters.">
            <x-form.input
                name="password"
                type="password"
                placeholder="Choose a password"
                autocomplete="new-password"
                required
            />
        </x-form.field>

        <x-form.field label="Confirm password" name="password_confirmation" required>
            <x-form.input
                name="password_confirmation"
                type="password"
                placeholder="One more time"
                autocomplete="new-password"
                required
            />
        </x-form.field>

        <x-button size="lg" class="w-full">
            Join your neighborhood
            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 4.99a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.968H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
            </svg>
        </x-button>

        <p class="text-center text-xs leading-relaxed text-stone-400">
            Your neighborhood and postal code are used to show nearby food. They are never shown as a street address.
        </p>
    </form>

    <p class="mt-7 text-center text-sm text-stone-600">
        Already have an account?
        <a href="{{ route('login') }}" class="font-semibold text-sage-700 underline decoration-sage-300 underline-offset-2 transition hover:text-sage-800">
            Sign in
        </a>
    </p>
</x-layouts.auth>
