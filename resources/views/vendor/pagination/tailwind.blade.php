{{-- resources/views/vendor/pagination/tailwind.blade.php --}}
@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
    {{-- Mobile --}}
    <div class="flex justify-between flex-1 sm:hidden">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm text-gray-500 bg-white border rounded-md cursor-not-allowed">
                ‹ Prev
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled"
                class="px-4 py-2 text-sm bg-white border rounded-md hover:bg-gray-50">
                ‹ Prev
            </button>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled"
                class="px-4 py-2 ml-3 text-sm bg-white border rounded-md hover:bg-gray-50">
                Next ›
            </button>
        @else
            <span class="px-4 py-2 ml-3 text-sm text-gray-500 bg-white border rounded-md cursor-not-allowed">
                Next ›
            </span>
        @endif
    </div>

    {{-- Desktop --}}
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div class="text-sm text-gray-600">
            Showing
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-medium">{{ $paginator->total() }}</span>
            results
        </div>

        <div>
            <span class="inline-flex rounded-md shadow-sm">
                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-2 text-sm text-gray-400 bg-white border rounded-l-md cursor-not-allowed">
                        ‹
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled"
                        class="px-3 py-2 text-sm bg-white border rounded-l-md hover:bg-gray-50">
                        ‹
                    </button>
                @endif

                {{-- Pages --}}
                @foreach ($elements as $element)
                    {{-- Dots --}}
                    @if (is_string($element))
                        <span class="px-4 py-2 text-sm text-gray-500 bg-white border">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-4 py-2 text-sm font-bold text-white bg-[#647FBC] border">
                                    {{ $page }}
                                </span>
                            @else
                                <button wire:click="gotoPage({{ $page }})"
                                    class="px-4 py-2 text-sm bg-white border hover:bg-gray-50">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled"
                        class="px-3 py-2 text-sm bg-white border rounded-r-md hover:bg-gray-50">
                        ›
                    </button>
                @else
                    <span class="px-3 py-2 text-sm text-gray-400 bg-white border rounded-r-md cursor-not-allowed">
                        ›
                    </span>
                @endif
            </span>
        </div>
    </div>
</nav>
@endif
