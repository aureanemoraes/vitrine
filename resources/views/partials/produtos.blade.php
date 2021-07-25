<div class="container">
    <section class="text-center mb-4">
        <div class="d-flex justify-content-center">
            <a href="{{ route('produtos.create') }}" type="button" class="btn btn-success">Novo produto</a>
        </div>

        @php($counter = 1)
        @foreach($produtos as $produto)
            @if($counter === 1)
                <div class="row wow fadeIn">
            @endif
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card info-produto">
                    <div class="view overlay produto-imagem">
                        <img
                            src="{{asset('produtos-imagens/' . $produto->imagens[0])}}"
                            class="card-img-top"
                            alt=""
                        >
                        <a href="{{route('produtos.show', $produto->id)}}" title="{{$produto->nome}}">
                        <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                    <div class="card-body">
                        <section class="produto-subcategoria">
                            <p>{{$produto->subcategoria->nome}}</p>
                        </section>
                        <section class="produto-nome">
                            <p>
                                <strong>
                                    {{$produto->nome}}
                                </strong>
                            </p>
                        </section>
                        <section class="produto-preco">
                            @if($produto->desconto > 0)
                                <span class="text-warning valor-sem-desconto">
                                    <del>{{ $produto->valor_formatado }}</del>
                                </span>
                                <span class="text-success valor-com-desconto">
                                    <strong>{{$produto->valor_com_desconto_formatado}}</strong>
                                </span>
                            @else
                                <span class="text-warning valor-sem-desconto">
                                </span>
                                <span class="blue-text">
                                    <strong>{{$produto->valor_formatado}}</strong>
                                </span>
                            @endif
                        </section>
                    </div>
                </div>

                <div class="card-footer">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <a
                    type="button"
                    href="{{ route('produtos.edit', $produto->id) }}"
                    class="btn btn-warning"
                    title="Alterar"
                    >
                    <i class="far fa-edit"></i>
                    </a>
                    <button
                        type="button"
                        class="btn btn-danger"
                        title="Excluir"
                        onclick="excluirItem('/produtos',{{$produto}})"
                    >
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
                </div>
            </div>
            @if($counter === 4)
                </div>
            @endif
            @php($counter < 5 ? $counter = $counter + 1 : $counter = 1)
        @endforeach
    </section>

  <!--Pagination-->
    @include('components.pagination', [
        'anterior' => $produtos->previousPageUrl(),
        'atual' => url()->current(),
        'proxima' => $produtos->nextPageUrl(),
        'pagina_atual' => $produtos->currentPage()
    ])
</div>
