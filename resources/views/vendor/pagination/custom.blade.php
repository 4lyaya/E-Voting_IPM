@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between px-4 py-3 sm:px-6">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-xl">
                    <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-xl">
                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Menampilkan
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    sampai
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    hasil
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-xl">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-xl"
                                aria-hidden="true">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-xl hover:bg-gray-50 transition"
                            aria-label="{{ __('pagination.previous') }}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-600 border border-blue-600 cursor-default">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 transition"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-xl hover:bg-gray-50 transition"
                            aria-label="{{ __('pagination.next') }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-r-xl"
                                aria-hidden="true">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
