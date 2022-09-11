<style>
    ul {
        /* float:right */
    }

    ul#pager li {       
        display: inline;
        border: 2px solid white;
        padding: 7px;
        color: white;
        text-decoration: none;
        font-size: 14px;
        border-radius: 10px
    }

</style>
@if ($paginator->hasPages())
    <ul id="pager">

        @if ($paginator->onFirstPage())
            <li class="disabled"><span>← Previous</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>
        @endif



        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active" style="color:white"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" style="text-decoration:none">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" style="text-decoration:none" rel="next">Next →</a></li>
        @else
            <li class="disabled"><span>Next →</span></li>
        @endif
    </ul>
@endif
