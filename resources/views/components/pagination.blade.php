<nav class="app-pagination">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="?page=1" aria-disabled="true">{{ __('common.components.pagination.first') }}</a>
        </li>
        <li class="page-item">
            @if($page < 1)
                <a class="page-link" href="?page=1" aria-disabled="true">{{ __('common.components.pagination.previous') }}</a>
            @else 
                <a class="page-link" href="?page={{ ($page-1) }}" aria-disabled="true">{{ __('common.components.pagination.previous') }}</a>
            @endif
        </li>

        @if($pages < 8)
            @for($i=1; $i<=$pages; $i++)
                @if($i==$page)
                    <li class="page-item active"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                @else 
                    <li class="page-item"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                @endif
            @endfor
        @else
            @if($page <= 3)
                @for($i=1; $i<=3; $i++)
                    @if($i==$page)
                        <li class="page-item active"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                    @else 
                        <li class="page-item"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                    @endif
                @endfor
                <li class="page-item"><a class="page-link" href="?page=4">...</a></li>
            @elseif($pages - $page <= 3 )
                <li class="page-item"><a class="page-link" href="?page={{ ($pages-4) }}">...</a></li>
                @for($i=($pages-3); $i<=$pages; $i++)
                    @if($i==$page)
                        <li class="page-item active"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                    @else 
                        <li class="page-item"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                    @endif
                @endfor
            @else
                <li class="page-item"><a class="page-link" href="?page={{ ($pages-2) }}">...</a></li>
                @for($i=($page-1); $i<=($page+1); $i++)
                    @if($i==$page)
                        <li class="page-item active"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                    @else 
                        <li class="page-item"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                    @endif
                @endfor
                <li class="page-item"><a class="page-link" href="?page={{ ($pages+2) }}">...</a></li>
            @endif
        @endif

        <li class="page-item">
            @if($page >= $pages)
                <a class="page-link" href="?page={{ $pages }}" aria-disabled="true">{{ __('common.components.pagination.next') }}</a>
            @else 
                <a class="page-link" href="?page={{ ($page+1) }}" aria-disabled="true">{{ __('common.components.pagination.next') }}</a>
            @endif
        </li>

        <li class="page-item">
            <a class="page-link" href="?page={{ $pages }}">{{ __('common.components.pagination.end') }}</a>
        </li>
    </ul>
</nav><!--//app-pagination-->