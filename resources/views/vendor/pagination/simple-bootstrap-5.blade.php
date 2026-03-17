@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link simplepagination"><i class="bi-chevron-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link simplepagination" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="bi-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link simplepagination" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="bi-chevron-right"></i></a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link simplepagination"><i class="bi-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
