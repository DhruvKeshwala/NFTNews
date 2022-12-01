
@if ($paginator->hasPages())

  <div id="paginate" class="row">
        <div class="col-md-6 pt-3"><strong>Showing {{$paginator->firstItem()}} to {{$paginator->lastItem()}} of {{ $paginator->total() }}</strong></div>
        <ul class="pagination col-md-6 d-block text-right">
            @if ($paginator->onFirstPage())
            <li class="prev disabled"><a title="Prev"><i class="fa fa-angle-left"></i></a></li>
            @else 
            <li class="prev"><a href="{{ $paginator->previousPageUrl() }}" title="Prev"><i class="fa fa-angle-left"></i></a></li>
            @endif

            @foreach ($elements as $element)
            @if (is_string($element))
            <li class="disabled"><a href="#">{{ $element }}</a></li>
            @endif
    
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="active">
                <a>{{ $page }}</a>
            </li>
            @else
            <li>
                <a
                href="{{ $url }}">{{ $page }}</a>
            </li>
            @endif
            @endforeach
            @endif
            @endforeach
            
            @if ($paginator->hasMorePages())
            <li class="next">
                <a title="Next"
                href="{{ $paginator->nextPageUrl() }}" 
                ><i class="fa fa-angle-right"></i></a>
            </li>
            @else
            <li class="next disabled"><a href="#" title="Next"><i class="fa fa-angle-right"></i></a></li>
            @endif
        </ul>
    </div>
    @endif

  