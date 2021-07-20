<nav aria-label="Navegação entre páginas">
    <ul class="pagination pagination-sm justify-content-end">

    </ul>
</nav>

<nav class="d-flex justify-content-center wow fadeIn">
    <ul class="pagination pg-blue">
        @php($pagina_anterior = $pagina_atual - 1)
        @if($pagina_anterior > 0)
            <li class="page-item">
                <a class="page-link" href="{{$anterior}}">
                    {{ $pagina_anterior }}
                </a>
            </li>
        @endif

        <li class="page-item active">
            <a class="page-link" href="{{$atual}}">
                {{ $pagina_atual }}
            </a>
        </li>

        @if(isset($proxima))
            @php($proxima_pagina = $pagina_atual + 1)
            <li class="page-item">
                <a class="page-link" href="{{$proxima}}">
                    {{ $proxima_pagina }}
                </a>
            </li>
        @endif
    </ul>
  </nav>
