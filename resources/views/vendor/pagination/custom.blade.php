@if ($paginator->hasPages())
    <div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item--wide first disabled2 d-flex"> <span class="pagination-link--wide first my-auto" >Previous</span> </li>
            @else
                <li class="pagination-item--wide first d-flex"> <a class="pagination-link--wide first my-auto" href="{{ $paginator->previousPageUrl() }}">Previous</a> </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item first-number disabled2"> <span class="pagination-link" >{{ $element }}</span> </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
                            <li class="pagination-item is-active"> <a class="pagination-link" href="{{ $page }}">{{ $page }}</a> </li>
                        @else
                            <li class="pagination-item"> <a class="pagination-link" href="{{ $url }}">{{ $page }}</a> </li>                      
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item--wide last d-flex"> <a class="pagination-link--wide last my-auto" href="{{ $paginator->nextPageUrl() }}">Next</a> </li>
            @else
                <li class="pagination-item--wide last disabled2 d-flex"> <span class="pagination-link--wide last my-auto">Next</span> </li>
            @endif
        
                
            
        </ul>
    </div> 
@endif

    {{-- <li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="#">Previous</a> </li> --}}
    {{-- <li class="pagination-item first-number"> <a class="pagination-link" href="#">1</a> </li>
    <li class="pagination-item"> <a class="pagination-link" href="#">2</a> </li>
    <li class="pagination-item is-active"> <a class="pagination-link" href="#">3</a> </li>
    <li class="pagination-item"> <a class="pagination-link" href="#">4</a> </li>
    <li class="pagination-item"> <a class="pagination-link" href="#">5</a> </li>
    <li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="#">Next</a> </li> --}}
