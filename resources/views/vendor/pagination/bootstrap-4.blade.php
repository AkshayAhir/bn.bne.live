@if ($paginator->hasPages())
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')" style="color: #0A35C2;">
                <span aria-hidden="true">&laquo;</span>
            </li>
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')" style="color: #0A35C2;">
                <span aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li>
                <a href="{{ \Request::url() }}" rel="prev" aria-label="@lang('pagination.previous')" style="color: #0A35C2;">&laquo;</a>
            </li>

            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" style="color: #0A35C2;">&lsaquo;</a>
            </li>
        @endif

        <!--@if ($paginator->currentPage() > 3)-->
        <!--    <li>-->
        <!--        <a href="{{ $paginator->url(1) }}">1</a>-->
        <!--    </li>-->
        <!--@endif-->

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!--@if ($paginator->currentPage() < $paginator->lastPage() - 2)-->
        <!--    <li>-->
        <!--        <a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>-->
        <!--    </li>-->
        <!--@endif-->

        @if ($paginator->hasMorePages())
            <li >
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" style="color: #0A35C2;">&rsaquo;</a>
            </li>
            <li>
                <a href="{{ \Request::url().'?page='.$paginator->lastPage() }}" rel="next" aria-label="@lang('pagination.next')" style="color: #0A35C2;">&raquo;</a>
            </li>

        @else
            <li class="disabled " aria-disabled="true" aria-label="@lang('pagination.next')" style="color: #0A35C2;">
                <span aria-hidden="true">&rsaquo;</span>
            </li>
            <li class="disabled " aria-disabled="true" aria-label="@lang('pagination.next')" style="color: #0A35C2;">
                <span aria-hidden="true">&raquo;</span>
            </li>
        @endif
    </ul>
@endif
