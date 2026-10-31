@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ? $title . ' · SpareSpoon' : 'SpareSpoon — share good food with your neighbors' }}</title>
        <meta name="description" content="SpareSpoon is a hyper-local food-sharing shelf. Pass on extra produce, garden harvests, bakery, and pantry finds to neighbors around the corner.">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-cream-50 font-sans text-stone-800 antialiased">
        <a href="#main" class="sr-only z-50 rounded-full bg-sage-700 px-5 py-3 text-sm font-semibold text-cream-50 focus:not-sr-only focus:fixed focus:left-4 focus:top-4">
            Skip to content
        </a>

        <header class="sticky top-0 z-40 border-b border-cream-200/80 bg-cream-50/90 backdrop-blur-md">
            <div class="mx-auto flex h-20 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                <x-logo />

                <nav class="hidden items-center gap-1 lg:flex" aria-label="Main navigation">
                    <x-nav-link :href="route('listings.index')" :active="request()->routeIs('listings.index')">
                        Browse food
                    </x-nav-link>

                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            My listings
                        </x-nav-link>

                        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">
                            My neighborhood
                        </x-nav-link>
                    @endauth
                </nav>

                <div class="hidden items-center gap-2.5 lg:flex">
                    @auth
                        <x-button :href="route('listings.create')" size="sm">
                            <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                            </svg>
                            Share food
                        </x-button>

                        <details data-menu class="group relative">
                            <summary class="flex cursor-pointer list-none items-center gap-2 rounded-full border border-cream-200 bg-white py-1 pl-1 pr-3 text-stone-700 shadow-sm transition hover:border-sage-300 [&::-webkit-details-marker]:hidden">
                                <x-avatar :name="auth()->user()->name" size="sm" />
                                <span class="max-w-24 truncate text-sm font-semibold">{{ Str::before(auth()->user()->name, ' ') }}</span>
                                <svg class="size-3.5 text-stone-400 transition group-open:rotate-180" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </summary>

                            <div class="absolute right-0 z-50 mt-2 w-64 overflow-hidden rounded-2xl border border-cream-200 bg-white p-2 shadow-xl shadow-stone-900/10">
                                <div class="mb-1 border-b border-cream-100 px-3 py-2">
                                    <p class="truncate text-sm font-semibold text-stone-800">{{ auth()->user()->name }}</p>
                                    <p class="truncate text-xs text-stone-500">{{ auth()->user()->locationLabel() ?: 'Add your neighborhood' }}</p>
                                </div>

                                <a href="{{ route('dashboard') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-stone-600 transition hover:bg-cream-50 hover:text-stone-900">
                                    My listings
                                </a>
                                <a href="{{ route('listings.create') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-stone-600 transition hover:bg-cream-50 hover:text-stone-900">
                                    Share food
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-stone-600 transition hover:bg-cream-50 hover:text-stone-900">
                                    Neighborhood settings
                                </a>

                                <form method="POST" action="{{ route('logout') }}" class="mt-1 border-t border-cream-100 pt-1">
                                    @csrf
                                    <button type="submit" class="block w-full rounded-xl px-3 py-2 text-left text-sm font-medium text-clay-600 transition hover:bg-clay-50">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </details>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full px-4 py-2 text-sm font-semibold text-stone-600 transition hover:bg-cream-100 hover:text-stone-900">
                            Log in
                        </a>

                        <x-button :href="route('register')" size="sm">
                            Join your neighborhood
                        </x-button>
                    @endauth
                </div>

                <details data-menu class="relative lg:hidden">
                    <summary class="grid size-11 cursor-pointer list-none place-items-center rounded-full border border-cream-200 bg-white text-stone-700 shadow-sm transition hover:border-sage-300 [&::-webkit-details-marker]:hidden" aria-label="Open menu">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                            <path d="M4 7h16M4 12h16M4 17h16" />
                        </svg>
                    </summary>

                    <div class="absolute right-0 z-50 mt-2 w-72 rounded-3xl border border-cream-200 bg-white p-2 shadow-2xl shadow-stone-900/10">
                        @auth
                            <div class="mb-1 flex items-center gap-3 border-b border-cream-100 px-3 py-3">
                                <x-avatar :name="auth()->user()->name" />
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-stone-800">{{ auth()->user()->name }}</p>
                                    <p class="truncate text-xs text-stone-500">{{ auth()->user()->locationLabel() ?: 'Add your neighborhood' }}</p>
                                </div>
                            </div>

                            <x-button :href="route('listings.create')" class="mb-1 w-full" size="sm">
                                <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                                </svg>
                                Share food
                            </x-button>

                            <a href="{{ route('listings.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-medium text-stone-600 transition hover:bg-cream-50 hover:text-stone-900">
                                Browse food
                            </a>
                            <a href="{{ route('dashboard') }}" class="block rounded-xl px-3 py-2.5 text-sm font-medium text-stone-600 transition hover:bg-cream-50 hover:text-stone-900">
                                My listings
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block rounded-xl px-3 py-2.5 text-sm font-medium text-stone-600 transition hover:bg-cream-50 hover:text-stone-900">
                                Neighborhood settings
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="mt-1 border-t border-cream-100 pt-1">
                                @csrf
                                <button type="submit" class="block w-full rounded-xl px-3 py-2.5 text-left text-sm font-medium text-clay-600 transition hover:bg-clay-50">
                                    Sign out
                                </button>
                            </form>
                        @else
                            <a href="{{ route('listings.index') }}" class="block rounded-xl px-3 py-2.5 text-sm font-medium text-stone-600 transition hover:bg-cream-50 hover:text-stone-900">
                                Browse food
                            </a>
                            <a href="{{ route('login') }}" class="block rounded-xl px-3 py-2.5 text-sm font-medium text-stone-600 transition hover:bg-cream-50 hover:text-stone-900">
                                Log in
                            </a>

                            <x-button :href="route('register')" class="mt-2 w-full" size="sm">
                                Join your neighborhood
                            </x-button>
                        @endauth
                    </div>
                </details>
            </div>
        </header>

        @if (session('status'))
            <div class="mx-auto max-w-7xl px-4 pt-5 sm:px-6 lg:px-8">
                <div class="flex items-start gap-3 rounded-2xl border border-sage-200 bg-sage-50 px-4 py-3.5 text-sm text-sage-800" role="status">
                    <svg class="mt-0.5 size-5 shrink-0 text-sage-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                    </svg>
                    <p>{{ session('status') }}</p>
                </div>
            </div>
        @endif

        <main id="main">
            {{ $slot }}
        </main>

        <footer class="mt-20 border-t border-cream-200 bg-cream-100/60">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-10 md:flex-row md:items-start md:justify-between">
                    <div class="max-w-sm">
                        <x-logo />

                        <p class="mt-4 text-sm leading-relaxed text-stone-600">
                            A hyper-local shelf for the food you can't get through. Share it with a neighbor, waste a little less, and know where your next meal came from.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-x-12 gap-y-8 text-sm">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-stone-400">Explore</p>
                            <ul class="mt-3 space-y-2">
                                <li><a href="{{ route('listings.index') }}" class="text-stone-600 transition hover:text-sage-700">Browse food</a></li>
                                <li>
                                    @auth
                                        <a href="{{ route('listings.create') }}" class="text-stone-600 transition hover:text-sage-700">Share food</a>
                                    @else
                                        <a href="{{ route('register') }}" class="text-stone-600 transition hover:text-sage-700">Join SpareSpoon</a>
                                    @endauth
                                </li>
                            </ul>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-stone-400">Your account</p>
                            <ul class="mt-3 space-y-2">
                                @auth
                                    <li><a href="{{ route('dashboard') }}" class="text-stone-600 transition hover:text-sage-700">My listings</a></li>
                                    <li><a href="{{ route('profile.edit') }}" class="text-stone-600 transition hover:text-sage-700">My neighborhood</a></li>
                                @else
                                    <li><a href="{{ route('login') }}" class="text-stone-600 transition hover:text-sage-700">Log in</a></li>
                                    <li><a href="{{ route('register') }}" class="text-stone-600 transition hover:text-sage-700">Create an account</a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-col gap-2 border-t border-cream-300/70 pt-6 text-xs text-stone-500 sm:flex-row sm:items-center sm:justify-between">
                    <p>&copy; {{ date('Y') }} SpareSpoon. Made for neighbors.</p>
                    <p class="inline-flex items-center gap-1.5">
                        <span class="size-1.5 rounded-full bg-sage-500"></span>
                        Less waste. More sharing.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
