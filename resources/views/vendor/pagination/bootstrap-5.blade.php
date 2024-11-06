@if ($paginator->hasPages())
    <a href="#"
        class="pagination-item text-decoration-none tk-basic-sans font13 leading22 space-0_13 text-808080 fw-normal me-3">
        <span class="text-black">
            {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}</span> of {{ $paginator->total() }}</a>
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <a href="#"
            class="text-decoration-none pagination-arrow  text-black d-flex align-items-center justify-content-center radius4 me-3 prev">
            <img src="{{ asset('images/left.svg') }}" alt="">
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="text-decoration-none pagination-arrow  text-black d-flex align-items-center justify-content-center radius4 me-3 prev">
                <img src="{{ asset('images/left.svg') }}" alt="">
            </a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}"
        class="text-decoration-none pagination-arrow  text-black d-flex align-items-center justify-content-center radius4 me-3 next">
        <img src="{{ asset('images/right.svg') }}" alt="">
    </a>
    @else
    <a href="#"
        class="text-decoration-none pagination-arrow  text-black d-flex align-items-center justify-content-center radius4 me-3 next">
        <img src="{{ asset('images/right.svg') }}" alt="">
    </a>
    @endif
@endif
