<x-layouts.app title="My neighborhood">
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-sage-600">Your corner of the map</p>
            <h1 class="mt-2 font-display text-3xl font-semibold tracking-tight text-stone-900 sm:text-4xl">
                Your neighborhood
            </h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-stone-600">
                SpareSpoon is deliberately small. Your neighborhood and postal code decide which shelf you see first, so keep them current when you move.
            </p>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_18rem]">
            <form method="POST" action="{{ route('profile.update') }}" class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm sm:p-8">
                @csrf
                @method('PATCH')

                <div class="flex items-center gap-3">
                    <span class="grid size-10 place-items-center rounded-2xl bg-sage-100 text-lg" aria-hidden="true">🏡</span>
                    <div>
                        <h2 class="font-display text-xl font-semibold text-stone-900">Neighborhood details</h2>
                        <p class="text-sm text-stone-500">What neighbors see when you share food.</p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mt-5 flex items-start gap-3 rounded-2xl border border-clay-200 bg-clay-50 px-4 py-3.5 text-sm text-clay-700" role="alert">
                        <svg class="mt-0.5 size-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10A8 8 0 1 1 2 10a8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                        </svg>
                        <p>Please check the highlighted fields.</p>
                    </div>
                @endif

                <div class="mt-6 space-y-5">
                    <x-form.field label="Your name" name="name" required>
                        <x-form.input name="name" :value="old('name', $user->name)" maxlength="255" required />
                    </x-form.field>

                    <x-form.field label="Email" name="email" hint="Your email is used to sign in and is never shown publicly.">
                        <x-form.input name="email" type="email" :value="$user->email" disabled class="cursor-not-allowed bg-cream-50 text-stone-500" />
                    </x-form.field>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <x-form.field label="Neighborhood" name="neighborhood" required hint="The name you'd use with a neighbor, e.g. Riverside.">
                            <x-form.input
                                name="neighborhood"
                                :value="old('neighborhood', $user->neighborhood)"
                                placeholder="Riverside"
                                maxlength="100"
                                required
                            />
                        </x-form.field>

                        <x-form.field label="Postal code" name="postal_code" required hint="Used to find food around the corner.">
                            <x-form.input
                                name="postal_code"
                                :value="old('postal_code', $user->postal_code)"
                                placeholder="M4E 1A1"
                                maxlength="20"
                                required
                            />
                        </x-form.field>
                    </div>
                </div>

                <div class="mt-7 flex items-center justify-end gap-3 border-t border-cream-200 pt-5">
                    <x-button size="md">Save changes</x-button>
                </div>
            </form>

            <aside class="space-y-5">
                <div class="rounded-3xl border border-sage-200 bg-sage-50/70 p-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-sage-600">Your shelf</p>

                    <div class="mt-4 flex items-start gap-3">
                        <span class="grid size-11 shrink-0 place-items-center rounded-2xl bg-white text-lg shadow-sm ring-1 ring-inset ring-sage-600/10" aria-hidden="true">📍</span>
                        <div>
                            <p class="font-semibold text-stone-900">{{ $user->neighborhood ?: 'No neighborhood yet' }}</p>
                            <p class="mt-0.5 text-sm text-stone-500">{{ $user->postal_code ?: 'No postal code yet' }}</p>
                        </div>
                    </div>

                    <p class="mt-4 text-sm leading-relaxed text-stone-600">
                        This is what appears next to your name on every listing. It helps neighbors know if they can pop by on foot.
                    </p>
                </div>

                <div class="rounded-3xl border border-dashed border-cream-300 p-5 text-sm leading-relaxed text-stone-500">
                    <span class="font-semibold text-stone-700">Just a neighborhood.</span>
                    SpareSpoon never shows your street address. Pickup details are shared in the listing itself, on your terms.
                </div>

                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-sage-700 transition hover:text-sage-800">
                    Back to my listings
                    <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 4.99a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.968H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                    </svg>
                </a>
            </aside>
        </div>
    </div>
</x-layouts.app>
