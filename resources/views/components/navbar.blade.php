<style>
    .navbar-norteodonto  {
        background-color: #25558b;
    }

    a.nav-link {
        color:#f5f5f5 ;

    }

    .nav-link.active {
        /* border-start-end-radius: 0.400rem; */
        font-weight: 600;
    }

    .dropdown-item.active {
        border-radius: 0 !important;
    }

</style>
@php($subcategoria_selecionada = request()->get('subcategorias'))
@php($categoria_selecionada = request()->get('categorias'))
@php($outros = false)

<nav class="navbar navbar-expand-lg navbar-norteodonto">
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
                <!-- Categorias Relevantes -->
                @php($categorias = App\Models\Categoria::getCategoriasPrincipais())
                @if(count($categorias) > 0)
                    @foreach($categorias as $categoria)
                        <li class="nav-item me-3 me-lg-0 dropdown">
                            @if(isset($subcategoria_selecionada) && count($subcategoria_selecionada) == 1)
                                @if($categoria->id == $subcategoria_selecionada[0])
                                    @php($outros = false)
                                    @php($class = "nav-link dropdown-toggle active")
                                @else
                                    @php($outros = true)
                                    @php($class = "nav-link dropdown-toggle")
                                @endif
                            @else
                                @php($class = "nav-link dropdown-toggle")
                            @endif
                            <a
                                class="{{$class}}"
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
                                        @php($current = url()->full() == route('produtos.encontrar.filtro', ['subcategorias' => [$subcategoria->id]]) ? true : false)
                                        <li>
                                            <a class="dropdown-item {{ $current ? 'active' : '' }}" href="{{ route('produtos.encontrar.filtro', ['subcategorias' => [$subcategoria->id]])}}"
                                            >{{ $subcategoria->nome }}
                                        </a>
                                        </li>
                                    @endforeach
                                @endif
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <a
                                    class="dropdown-item"
                                    href="{{ route('produtos.encontrar.filtro', ['categorias' => [$categoria->id]]) }}"
                                    >
                                        Todos
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endforeach
                @endif
                <!-- Categorias Secundárias -->
                @php($categorias = App\Models\Categoria::getCategoriasSecundarias())
                         <li class="nav-item me-3 me-lg-0 dropdown">
                             <a
                                 class="nav-link dropdown-toggle {{ $outros ? 'active' : '' }}"
                                 href="#"
                                 id="outras"
                                 role="button"
                                 data-mdb-toggle="dropdown"
                                 aria-expanded="false"
                                 >
                                 Outras
                             </a>
                             <ul class="dropdown-menu" aria-labelledby="outras">
                                @if(count($categorias) > 0)
                                    @foreach($categorias as $categoria)
                                        <!-- categorias --->
                                        <li>
                                            <a class="dropdown-item  text-end" href="{{ route('produtos.encontrar.filtro', ['categorias' => [$categoria->id]]) }}">
                                                <strong>{{ $categoria->nome }}</strong>
                                            </a>
                                        </li>
                                        <!-- subcategorias --->
                                        @if(count($categoria->subcategorias) > 0)
                                            @foreach($categoria->subcategorias as $subcategoria)
                                                <li>
                                                    <a class="dropdown-item text-end" href="{{ route('produtos.encontrar.filtro', ['subcategorias' => [$subcategoria->id]])}}">
                                                        <span>{{ $subcategoria->nome }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                        <li><hr class="dropdown-divider" /></li>
                                 @endforeach
                                 @endif
                             </ul>
                         </li>
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
