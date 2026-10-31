<x-layouts.auth title="Log in">
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sage-600">Welcome back</p>
        <h1 class="mt-3 font-display text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">
            Pull up a chair.
        </h1>
        <p class="mt-3 text-sm leading-relaxed text-stone-600">
            Sign in to see what's fresh around the corner, update your shelf, or share something new.
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <x-form.field label="Email" name="email" required>
            <x-form.input
                name="email"
                type="email"
                :value="old('email')"
                placeholder="you@example.com"
                autocomplete="email"
                required
                autofocus
            />
        </x-form.field>

        <x-form.field label="Password" name="password" required>
            <x-form.input
                name="password"
                type="password"
                placeholder="Your password"
                autocomplete="current-password"
                required
            />
        </x-form.field>

        <label class="flex cursor-pointer items-center gap-2.5 text-sm text-stone-600">
            <input
                type="checkbox"
                name="remember"
                class="size-4 rounded border-cream-300 text-sage-600 shadow-sm focus:ring-sage-500/30"
            >
            Keep me signed in on this device
        </label>

        <x-button size="lg" class="w-full">
            Sign in
            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 4.99a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.968H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
            </svg>
        </x-button>
    </form>

    <p class="mt-7 text-center text-sm text-stone-600">
        New to the neighborhood?
        <a href="{{ route('register') }}" class="font-semibold text-sage-700 underline decoration-sage-300 underline-offset-2 transition hover:text-sage-800">
            Create an account
        </a>
    </p>
</x-layouts.auth>
