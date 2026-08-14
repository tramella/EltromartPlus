@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center sm:justify-end py-4">
        
        <!-- Mobile Pagination Controls -->
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-xs font-bold text-slate-400 bg-slate-100 rounded-xl cursor-not-allowed border border-slate-200">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn-modern-secondary text-xs py-2 px-4">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn-modern-secondary text-xs py-2 px-4">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="px-4 py-2 text-xs font-bold text-slate-400 bg-slate-100 rounded-xl cursor-not-allowed border border-slate-200">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <!-- Desktop Pagination Controls -->
        <div class="hidden sm:flex sm:items-center sm:justify-end">
            <span class="relative z-0 inline-flex items-center gap-1.5 shadow-xs rounded-2xl p-1 bg-white border border-slate-200">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span class="relative inline-flex items-center px-3 py-2 text-xs font-bold text-slate-300 bg-slate-50 rounded-xl cursor-not-allowed" aria-hidden="true">
                            <i class="fa-solid fa-chevron-left text-[10px] mr-1"></i> Prev
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 hover:text-blue-600 rounded-xl transition-colors" aria-label="{{ __('pagination.previous') }}">
                            <i class="fa-solid fa-chevron-left text-[10px] mr-1"></i> Prev
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-3 py-2 text-xs font-bold text-slate-400 bg-white rounded-xl select-none">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-3.5 py-2 text-xs font-extrabold text-white bg-blue-600 rounded-xl shadow-sm">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-3.5 py-2 text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 hover:text-blue-600 rounded-xl transition-colors" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 hover:text-blue-600 rounded-xl transition-colors" aria-label="{{ __('pagination.next') }}">
                            Next <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-xs font-bold text-slate-300 bg-slate-50 rounded-xl cursor-not-allowed" aria-hidden="true">
                                Next <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
                            </span>
                        </span>
                    @endif
                </span>
        </div>

    </nav>
@endif
