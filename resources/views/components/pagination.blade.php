@if ($paginator->hasPages())
    <nav class="mt-10 flex flex-col items-center justify-between gap-4 sm:flex-row" aria-label="Pagination">
        <p class="text-sm text-stone-500">
            Showing <span class="font-semibold text-stone-700">{{ $paginator->firstItem() }}</span>–<span class="font-semibold text-stone-700">{{ $paginator->lastItem() }}</span>
            of <span class="font-semibold text-stone-700">{{ $paginator->total() }}</span>
        </p>

        <div class="flex items-center gap-1.5">
            @if ($paginator->onFirstPage())
                <span class="inline-grid size-9 place-items-center rounded-full border border-cream-200 text-stone-300" aria-disabled="true">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 0 1-.02 1.06L8.832 10l3.938 3.71a.75.75 0 1 1-1.04 1.08l-4.5-4.25a.75.75 0 0 1 0-1.08l4.5-4.25a.75.75 0 0 1 1.06.02Z" clip-rule="evenodd" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-grid size-9 place-items-center rounded-full border border-cream-300 bg-white text-stone-600 transition hover:border-sage-300 hover:bg-sage-50 hover:text-sage-800" rel="prev" aria-label="Previous page">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 0 1-.02 1.06L8.832 10l3.938 3.71a.75.75 0 1 1-1.04 1.08l-4.5-4.25a.75.75 0 0 1 0-1.08l4.5-4.25a.75.75 0 0 1 1.06.02Z" clip-rule="evenodd" />
                    </svg>
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="inline-grid size-9 place-items-center text-sm text-stone-400">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-grid size-9 place-items-center rounded-full bg-sage-600 text-sm font-semibold text-cream-50" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="inline-grid size-9 place-items-center rounded-full border border-cream-200 text-sm font-medium text-stone-600 transition hover:border-sage-300 hover:bg-sage-50 hover:text-sage-800">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-grid size-9 place-items-center rounded-full border border-cream-300 bg-white text-stone-600 transition hover:border-sage-300 hover:bg-sage-50 hover:text-sage-800" rel="next" aria-label="Next page">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd" />
                    </svg>
                </a>
            @else
                <span class="inline-grid size-9 place-items-center rounded-full border border-cream-200 text-stone-300" aria-disabled="true">
                    <svg class="size-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L11.168 10 7.23 6.29a.75.75 0 1 1 1.04-1.08l4.5 4.25a.75.75 0 0 1 0 1.08l-4.5 4.25a.75.75 0 0 1-1.06-.02Z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
