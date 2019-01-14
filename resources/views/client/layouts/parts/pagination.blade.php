@if ($paginator->lastPage() > 1)
    <div class="paginare">
        @if($paginator->currentPage() != 1)
            <p>
                <a href="{{ $paginator->url(1) }}">
                    <div class="suport_paginare"><i
                                class="fas fa-angle-left ic_pag"></i></div>
                </a>
            </p>
        @endif
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <p class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a href="{{ $paginator->url($i) }}">
                    <div class="suport_paginare"><p class="text_pag">{{ $i }}</p></div></a>
    </p>
    @endfor
    @if($paginator->currentPage() != $paginator->lastPage())
    <p>
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}">
            <div class="suport_paginare">
                <i class="fas fa-angle-right ic_pag"></i></div>
        </a>
    </p>
    @endif
    </div>
@endif