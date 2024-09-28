@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Array Of Links --}}
            @foreach ($paginator->links()->elements[0] as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        </ul>
    </nav>
@endif
