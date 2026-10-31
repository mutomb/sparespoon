@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ? $title . ' · SpareSpoon' : 'SpareSpoon — share good food with your neighbors' }}</title>
        <meta name="description" content="SpareSpoon is a hyper-local food-sharing shelf for neighbors.">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-cream-50 font-sans text-stone-800 antialiased">
        <div class="grid min-h-screen lg:grid-cols-[1.02fr_1fr]">
            <aside class="relative hidden overflow-hidden bg-sage-900 px-12 py-14 text-cream-50 lg:flex lg:flex-col lg:justify-between xl:px-16">
                <div class="pointer-events-none absolute -right-24 -top-24 size-80 rounded-full bg-sage-700/60 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-32 -left-20 size-96 rounded-full bg-sage-600/40 blur-3xl"></div>

                <div class="relative">
                    <x-logo light />
                </div>

                <div class="relative max-w-md">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sage-300">A neighborhood shelf</p>

                    <blockquote class="mt-5 font-display text-4xl font-medium leading-[1.15] text-cream-50 xl:text-[2.75rem]">
                        A little extra is a lot when it's shared.
                    </blockquote>

                    <p class="mt-5 text-sm leading-relaxed text-sage-100/90">
                        Extra tomatoes, a loaf you won't finish, the pantry tin you bought twice — someone around the corner would love it.
                    </p>

                    <ul class="mt-10 space-y-4 text-sm text-sage-100">
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-sage-700 text-sage-200">
                                <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Share what you have, set your own pickup details
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-sage-700 text-sage-200">
                                <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Find fresh food from neighbors in your postal code
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-sage-700 text-sage-200">
                                <svg class="size-3.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            No fees, no delivery vans — just a friendly handoff
                        </li>
                    </ul>
                </div>

                <p class="relative text-xs text-sage-300">Good food, second helpings.</p>
            </aside>

            <main class="flex flex-col">
                <header class="flex items-center justify-between px-5 py-5 sm:px-8 lg:hidden">
                    <x-logo />

                    <a href="{{ route('listings.index') }}" class="text-sm font-semibold text-stone-500 transition hover:text-sage-700">
                        Browse food
                    </a>
                </header>

                <div class="flex flex-1 items-center justify-center px-5 py-10 sm:px-8 lg:py-16">
                    <div class="w-full max-w-md">
                        {{ $slot }}
                    </div>
                </div>

                <footer class="px-5 pb-6 text-center text-xs text-stone-400 sm:px-8 lg:hidden">
                    Less waste. More sharing.
                </footer>
            </main>
        </div>
    </body>
</html>
