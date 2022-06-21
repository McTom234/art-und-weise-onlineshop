@php
if ($paginator->currentPage() > $paginator->lastPage())
{
    $parameters = request()->route()->parameters();
    $parameters['page'] = $paginator->lastPage();
    redirect()->route(request()->route()->getName(), $parameters)->send();
}
@endphp

<div role="navigation" class="page-navigation">
    @if($paginator->onFirstPage())
        <span class="inactive">&blacktriangleleft;</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}">&blacktriangleleft;</a>
    @endif
    <span>Seite {{ $paginator->currentPage() }} von {{ $paginator->lastPage() }}</span>
    @if($paginator->onLastPage())
        <span class="inactive">&blacktriangleright;</span>
    @else
        <a href="{{ $paginator->nextPageUrl() }}">&blacktriangleright;</a>
    @endif
</div>
