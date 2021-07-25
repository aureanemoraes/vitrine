<div class="container">
    <section class="text-center mb-4">
        <div class="d-flex justify-content-center">
            <a href="{{ route('empresas_parceiras.create') }}" type="button" class="btn btn-success">Nova empresa parceira</a>
        </div>

        @if(count($empresas_parceiras) > 0)
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($empresas_parceiras as $empresa_parceira)
                <div class="col">
                  <div class="card h-100">
                    <div class="card-body text-center">
                        <img
                        src="{{ asset('logos-empresas/' . $empresa_parceira->logo) }}"
                        class="img-fluid rounded logo-empresa-parceira"
                        alt="..."
                        />
                        <h5 class="card-title">{{ $empresa_parceira->nome }}</h5>
                        <p class="card-text">
                            {{ $empresa_parceira->descricao }}
                        </p>
                    </div>
                    <div class="card-footer ">
                        <a
                        href="{{ route('empresas_parceiras.show', $empresa_parceira->id) }}"
                        title=""
                        type="button"
                        class="btn btn-link float-end"
                        data-mdb-ripple-color="dark"
                        >
                            Ver produtos <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                   {{-- @auth --}}
                   <div class="card-footer">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a
                            type="button"
                            href="{{ route('empresas_parceiras.edit', $empresa_parceira->id) }}"
                            class="btn btn-warning"
                            title="Alterar"
                            >
                            <i class="far fa-edit"></i>
                            </a>
                            <button
                                type="button"
                                class="btn btn-danger"
                                title="Excluir"
                                onclick="excluirItem('/empresas_parceiras',{{$empresa_parceira}})"
                            >
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                   {{-- @endauth --}}
                  </div>
                </div>
            @endforeach
        </div>
        @endif
    </section>

  <!--Pagination-->
    @include('components.pagination', [
        'anterior' => $empresas_parceiras->previousPageUrl(),
        'atual' => url()->current(),
        'proxima' => $empresas_parceiras->nextPageUrl(),
        'pagina_atual' => $empresas_parceiras->currentPage()
    ])
</div>
