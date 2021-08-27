<div class="container">
    @if($ordenar == true)
    <nav class="navbar navbar-light bg-light ordenar">
        <div class="container-fluid">
            <ul class="navbar-nav">
              <!-- Dropdown -->
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdownMenuLink"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-expanded="false"
                >
                  Ordenar por:
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li>
                    <a class="dropdown-item" href="{{ route('produtos.ordenacao', 1) }}">Mais relevantes - Menos relevantes</a>
                    </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('produtos.ordenacao', 2) }}">(A-Z)</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('produtos.ordenacao', 3) }}">(Z-A)</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('produtos.ordenacao', 4) }}">(Maior preço - Menor preço)</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('produtos.ordenacao', 5) }}">(Menor preço - Maior preço)</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
    </nav>
    @endif
    <section class="text-center mb-4">
        @auth
            <div class="d-flex justify-content-center">
                <a href="{{ route('produtos.create') }}" type="button" class="btn btn-success">Novo produto</a>
            </div>
        @endauth

        @php($counter = 1)
        <div class="row wow fadeIn d-flex justify-content-center">
            @foreach($produtos as $produto)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card info-produto">
                        <div class="view overlay produto-imagem">
                            @if(isset($produto->imagens[0]))
                                <img
                                    src="{{asset('produtos-imagens/' . $produto->imagens[0])}}"
                                    class="card-img-top"
                                    alt=""
                                >
                            @else
                                <div class="border d-flex align-items-center justify-content-center sem-imagem">
                                    <p>Sem imagem</p>
                                </div>
                            @endif
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
                                @if($produto->disponibilidade)
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
                                        <span class="preco-padrao">
                                            <strong>{{$produto->valor_formatado}}</strong>
                                        </span>
                                    @endif
                                @else
                                    <span class="text-muted">
                                        INDISPONÍVEL
                                    </span>
                                    <span class="blue-text">
                                        <strong><del>{{$produto->valor_formatado}}</del></strong>
                                    </span>
                                @endif
                            </section>
                        </div>
                    </div>

                    @auth
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
                    @endauth
                </div>
            @endforeach
        </div>
    </section>

  <!--Pagination-->
    @if($paginacao)
        @include('components.pagination', [
            'anterior' => $produtos->previousPageUrl(),
            'atual' => url()->current(),
            'proxima' => $produtos->nextPageUrl(),
            'pagina_atual' => $produtos->currentPage()
        ])
    @endif
</div>
