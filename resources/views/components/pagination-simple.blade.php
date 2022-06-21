<div role="navigation" class="page-navigation">
    @if($paginator->onFirstPage())
        <span class="inactive">&blacktriangleleft;</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}">&blacktriangleleft;</a>
    @endif
    <span>Seite {{ $paginator->currentPage() }}</span>
    @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">&blacktriangleright;</a>
    @else
            <span class="inactive">&blacktriangleright;</span>
    @endif
</div>
