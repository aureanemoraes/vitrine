<style>
    .sidebar {
        background:#f5f5f5;
        color: #4f4f4f;
        border-radius: 0.250rem;
        padding: 1rem;
        font-size: 0.825rem;
    }

    .opcao-filtro{
        overflow-y: hidden;
        word-break: break-word;
    }

    .opcao-container:hover {
        background:  rgba(83, 174, 218);
        border-radius: 0.400rem;
        padding-left: 0.225rem;
        color: #f5f5f5;
    }

    .btn-filtro {
        margin-bottom: 0.5rem;
    }

    .btn-pesquisar {
        margin-left: 0.5rem;
    }
</style>
<div class="container">
    <div class="sidebar">
        <section>
            <h5 class="mb-4">Filtros</h5>

            <form action="{{ route('produtos.encontrar.pesquisa') }}">
                <section class="mb-4">
                    <div class="md-form md-outline mt-0 d-flex justify-content-between align-items-center">
                        <input type="text" id="nome" name="nome" class="form-control form-control-sm mb-0" placeholder="Pesquisar...">
                        <button type="submit" class="btn btn-flat btn-sm btn-primary btn-pesquisar"><i class="fas fa-search"></i></button>
                    </div>
                </section>
            </form>

            <form action="{{ route('produtos.encontrar.filtro') }}">
                <section class="mb-4">
                    <div class="opcao-container">
                        <div class="form-check pl-0 mb-3">
                            <input
                                type="checkbox"
                                class="form-check-input filled-in"
                                name="promocao"
                                id="promocao"
                                value="true"
                                {{ isset($filtro_promocao) ? 'checked' : '' }}>
                            <label
                                class="form-check-label small"
                                for="promocao">
                                Promoções
                            </label>
                        </div>
                    </div>
                </section>

                <section class="mb-4">
                    <h6 class="font-weight-bold mb-3">Empresas Parceiras</h6>
                    @php($empresas_parceiras = App\Models\EmpresaParceira::getEmpresasParceiras())
                    @foreach($empresas_parceiras as $empresa_parceira)
                    <div class="opcao-container">
                        <div class="form-check pl-0 mb-3">
                            <input
                                type="checkbox"
                                class="form-check-input filled-in"
                                name="empresas_parceiras[]"
                                id="{{$empresa_parceira->nome .  '-' . $empresa_parceira->id}}"
                                value={{$empresa_parceira->id}}
                                {{isset($filtro_empresas_parceiras) && in_array($empresa_parceira->id, $filtro_empresas_parceiras) ? 'checked' : ''}}>
                            <label
                                class="form-check-label small"
                                for="{{$empresa_parceira->nome .  '-' . $empresa_parceira->id}}">
                                {{ $empresa_parceira->nome }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </section>

                <section class="mb-4">
                    <h6 class="font-weight-bold mb-3">Categorias</h6>
                    @php($categorias = App\Models\Categoria::getCategorias())
                    @foreach($categorias as $categoria)
                    <div class="opcao-container">
                        <div class="form-check pl-0 mb-3">
                            <input
                                type="checkbox"
                                class="form-check-input filled-in"
                                name="categorias[]"
                                id="{{$categoria->nome .  '-' . $categoria->id}}" value={{$categoria->id}}
                                {{isset($filtro_categorias) && in_array($categoria->id, $filtro_categorias) ? 'checked' : ''}}
                                >
                            <label
                                class="form-check-label small"
                                for="{{$categoria->nome .  '-' . $categoria->id}}">
                                {{ $categoria->nome }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </section>

                <section class="mb-4">
                    <h6 class="font-weight-bold mb-3">Subcategorias</h6>
                    @php($subcategorias = App\Models\Subcategoria::getSubcategorias())
                    @foreach($subcategorias as $subcategoria)
                    <div class="opcao-container">
                        <div class="form-check pl-0 mb-3">
                            <input
                                type="checkbox"
                                class="form-check-input filled-in"
                                name="subcategorias[]"
                                id="{{$subcategoria->nome .  '-' . $subcategoria->id}}" value={{$subcategoria->id}}
                                {{isset($filtro_subcategorias) && in_array($subcategoria->id, $filtro_subcategorias) ? 'checked' : ''}}
                                >
                            <label
                                class="form-check-label small opcao-filtro"
                                for="{{$subcategoria->nome .  '-' . $subcategoria->id}}">
                                {{ $subcategoria->nome }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </section>

                <section>
                    <button type="submit" class="btn btn-primary btn-sm btn-filtro">Filtrar</button>
                    @php($url_atual = url()->current())
                    @if(str_contains($url_atual, "encontrar") === true)
                        <a href="{{ route('produtos.index') }}" type="button" class="btn btn-primary btn-sm">Remover filtros</a>
                    @endif
                </section>
            </form>
        </section>
    </div>
</div>
