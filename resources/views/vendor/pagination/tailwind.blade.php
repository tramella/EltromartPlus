@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center sm:justify-end py-4">

        <!-- Mobile: Simple previous/next controls with current page indicator -->
        <div class="flex items-center justify-between flex-1 sm:hidden gap-2">
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-xs font-bold text-slate-400 bg-slate-100 rounded-xl cursor-not-allowed border border-slate-200">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn-modern-secondary text-xs py-2 px-4">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            <span class="text-xs font-extrabold text-slate-700 bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

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

        <!-- Desktop: Numbered pagination with automatic ellipsis (...) windowing for > 4 pages -->
        <div class="hidden sm:flex sm:items-center sm:justify-end">
            <span class="relative z-0 inline-flex items-center gap-1.5 shadow-xs rounded-2xl p-1 bg-white border border-slate-200">

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span class="relative inline-flex items-center px-3 py-2 text-xs font-bold text-slate-300 bg-slate-50 rounded-xl cursor-not-allowed" aria-hidden="true">
                            <i class="fa-solid fa-chevron-left text-[10px] mr-1"></i> Prev
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       class="relative inline-flex items-center px-3 py-2 text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 hover:text-blue-600 rounded-xl transition-colors"
                       aria-label="{{ __('pagination.previous') }}">
                        <i class="fa-solid fa-chevron-left text-[10px] mr-1"></i> Prev
                    </a>
                @endif

                {{-- Render elements or custom ellipsis window when total pages > 4 --}}
                @if ($paginator->lastPage() > 4)
                    @php
                        $currentPage = $paginator->currentPage();
                        $lastPage = $paginator->lastPage();
                    @endphp

                    {{-- Always show Page 1 --}}
                    @if ($currentPage == 1)
                        <span aria-current="page">
                            <span class="relative inline-flex items-center px-3.5 py-2 text-xs font-extrabold text-white bg-blue-600 rounded-xl shadow-sm">1</span>
                        </span>
                    @else
                        <a href="{{ $paginator->url(1) }}" class="relative inline-flex items-center px-3.5 py-2 text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 hover:text-blue-600 rounded-xl transition-colors">1</a>
                    @endif

                    {{-- Left Ellipsis "..." --}}
                    @if ($currentPage > 3)
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-2 py-2 text-xs font-bold text-slate-400 bg-white rounded-xl select-none">...</span>
                        </span>
                    @endif

                    {{-- Middle Pages Window --}}
                    @for ($i = max(2, $currentPage - 1); $i <= min($lastPage - 1, $currentPage + 1); $i++)
                        @if ($i == $currentPage)
                            <span aria-current="page">
                                <span class="relative inline-flex items-center px-3.5 py-2 text-xs font-extrabold text-white bg-blue-600 rounded-xl shadow-sm">{{ $i }}</span>
                            </span>
                        @else
                            <a href="{{ $paginator->url($i) }}" class="relative inline-flex items-center px-3.5 py-2 text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 hover:text-blue-600 rounded-xl transition-colors">{{ $i }}</a>
                        @endif
                    @endfor

                    {{-- Right Ellipsis "..." --}}
                    @if ($currentPage < $lastPage - 2)
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-2 py-2 text-xs font-bold text-slate-400 bg-white rounded-xl select-none">...</span>
                        </span>
                    @endif

                    {{-- Always show Last Page --}}
                    @if ($currentPage == $lastPage)
                        <span aria-current="page">
                            <span class="relative inline-flex items-center px-3.5 py-2 text-xs font-extrabold text-white bg-blue-600 rounded-xl shadow-sm">{{ $lastPage }}</span>
                        </span>
                    @else
                        <a href="{{ $paginator->url($lastPage) }}" class="relative inline-flex items-center px-3.5 py-2 text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 hover:text-blue-600 rounded-xl transition-colors">{{ $lastPage }}</a>
                    @endif
                @else
                    {{-- Default array elements loop for <= 4 pages --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-3 py-2 text-xs font-bold text-slate-400 bg-white rounded-xl select-none">{{ $element }}</span>
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-3.5 py-2 text-xs font-extrabold text-white bg-blue-600 rounded-xl shadow-sm">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-3.5 py-2 text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 hover:text-blue-600 rounded-xl transition-colors">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                       class="relative inline-flex items-center px-3 py-2 text-xs font-bold text-slate-700 bg-white hover:bg-slate-100 hover:text-blue-600 rounded-xl transition-colors"
                       aria-label="{{ __('pagination.next') }}">
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
