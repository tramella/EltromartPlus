@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true" class="prev-icon"><i class="fa-solid fa-chevron-left"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"
                        class="prev-icon"><i class="fa-solid fa-chevron-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                {{-- @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>...</span></li>
                @endif --}}
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled px-3 py-2 text-gray-500"><span>...</span></li>
                @endif



                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active1" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="non-active">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')"class="prev-icon" class="prev-icon"><i
                            class="fa-solid fa-chevron-right"></i></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true" class="prev-icon"><i class="fa-solid fa-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
