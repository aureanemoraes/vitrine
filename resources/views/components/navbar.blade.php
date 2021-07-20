<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navBar"
            aria-controls="navBar"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navBar">
            <a class="navbar-brand mt-2 mt-lg-0" href="/">
                <img
                src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png"
                height="15"
                alt=""
                loading="lazy"
                />
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/produtos/encontrar/filtro?promocao=true">Promoções</a>
                </li>
                <!-- Categorias -->
                @php($categorias = App\Models\Categoria::getCategorias())
                @if(count($categorias) > 0)
                    @php($counter = 1)
                    @foreach($categorias as $categoria)
                        @if($counter <= 8)
                            <li class="nav-item me-3 me-lg-0 dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="{{$categoria->id}}"
                                    role="button"
                                    data-mdb-toggle="dropdown"
                                    aria-expanded="false"
                                    >
                                    {{ $categoria->nome }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="{{$categoria->id}}">
                                    <!-- subcategorias --->
                                    @if(count($categoria->subcategorias) > 0)
                                        @foreach($categoria->subcategorias as $subcategoria)
                                            <li>
                                                <a class="dropdown-item" href="#">{{ $subcategoria->nome }}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @php($counter = $counter + 1)
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="d-flex align-items-center">
            <a class="text-reset me-3" href="{{ route('carrinho.index') }}">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge rounded-pill badge-notification bg-danger">
                    {{session('produtos') ? count(session('produtos')) : '0'}}
                </span>
            </a>
            </a>
            <a
                class="dropdown-toggle d-flex align-items-center hidden-arrow"
                href="#"
                id="navbarDropdownMenuLink"
                role="button"
                data-mdb-toggle="dropdown"
                aria-expanded="false">
                Usuário
            </a>
            <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="navbarDropdownMenuLink" >
                <li>
                    <a class="dropdown-item" href="{{ route('produtos.index') }}">Produtos</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('categorias.index') }}">Categorias</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('empresas_parceiras.index') }}">Empresas Parceiras</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('descontos.index') }}">Descontos</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('parcelamentos.index') }}">Parcelamentos</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">Logout</a>
                </li>
            </ul>
        </div>
        <!-- Right elements -->
    </div>
<!-- Container wrapper -->
</nav>
<!-- Navbar -->
