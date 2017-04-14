<?php

/**
 * I don't like idea of having PHP code in blade template, but until I'll find
 * way how to prevent it, this will be the less painfull way how to handle
 * pagination.
 */

$linkLimit = 10;
$half_total_links = floor($linkLimit / 2);
$from = $paginator->currentPage() - $half_total_links;
$to = $paginator->currentPage() + $half_total_links;

if ($paginator->currentPage() < $half_total_links) {
    $to += $half_total_links - $paginator->currentPage();
}

if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
    $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
}

?>

@if ($paginator->lastPage() > 1)
    <ul id="pagination">
        @if($paginator->currentPage() != 1)
            <li>
                <a href="{{ $paginator->url($paginator->currentPage()-1) }}">{{ Lang::trans('pagination.previous') }}</a>
            </li>
        @endif
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($from < $i && $i < $to)
                @if ($paginator->currentPage() == $i)
                    <li>{{ $i }}</li>
                @else
                    <li class="{{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                        <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endif
        @endfor
        @if(! ($paginator->currentPage() == $paginator->lastPage()))
            <li>
                <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >{{ Lang::trans('pagination.next') }}</a>
            </li>
        @endif
    </ul>
@endif