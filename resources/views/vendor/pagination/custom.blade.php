@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between px-4 py-3 sm:px-6">
        <!-- Mobile pagination -->
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-xl shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl shadow-sm hover:bg-gray-50 hover:shadow-md transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="relative inline-flex items-center px-4 py-3 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl shadow-sm hover:bg-gray-50 hover:shadow-md transition-all duration-200">
                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @else
                <span
                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-xl shadow-sm">
                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </span>
            @endif
        </div>

        <!-- Desktop pagination -->
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 bg-white px-4 py-2 rounded-lg shadow-sm inline-block">
                    <span class="font-medium text-blue-600">{{ $paginator->firstItem() }}</span>
                    <span class="text-gray-500"> sampai </span>
                    <span class="font-medium text-blue-600">{{ $paginator->lastItem() }}</span>
                    <span class="text-gray-500"> dari </span>
                    <span class="font-medium text-blue-600">{{ $paginator->total() }}</span>
                    <span class="text-gray-500"> hasil</span>
                </p>
            </div>

            <div>
                <div class="inline-flex items-center shadow-sm rounded-xl overflow-hidden">
                    <!-- Previous Page Link -->
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-400 bg-white border-r border-gray-300 cursor-default">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="next"
                            class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-700 bg-white border-r border-gray-300 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200"
                            aria-label="{{ __('pagination.previous') }}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    <!-- Pagination Elements -->
                    @foreach ($elements as $element)
                        <!-- "Three Dots" Separator -->
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-700 bg-white border-r border-gray-300">
                                    {{ $element }}
                                </span>
                            </span>
                        @endif

                        <!-- Array Of Links -->
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-3 text-sm font-bold text-white bg-blue-600 border-r border-blue-600">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-700 bg-white border-r border-gray-300 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    <!-- Next Page Link -->
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-700 bg-white hover:bg-blue-50 hover:text-blue-600 transition-all duration-200"
                            aria-label="{{ __('pagination.next') }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="relative inline-flex items-center px-4 py-3 text-sm font-medium text-gray-400 bg-white cursor-default">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </nav>
@endif
