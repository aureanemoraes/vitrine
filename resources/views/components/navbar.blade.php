<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navBar"
        aria-controls="navBar"
        aria-expanded="false"
        aria-label="Toggle navigation"
        >
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
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#">Dashboard</a>
            </li>
            <!-- Itens -->
            <li class="nav-item me-3 me-lg-0 dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="itens"
                    role="button"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false"
                    >
                    Itens
                </a>
                <ul class="dropdown-menu" aria-labelledby="itens">
                    <li>
                        <a class="dropdown-item" href="{{ route('categorias.index') }}">Categorias</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('empresas_parceiras.index') }}">Empresas Parceiras</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('produtos.index') }}">Produtos</a>
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                </ul>
            </li>
            <!-- Financeiro -->
            <li class="nav-item me-3 me-lg-0 dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="financeiro"
                    role="button"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false"
                    >
                    Financeiro
                </a>
                <ul class="dropdown-menu" aria-labelledby="financeiro">
                    <li>
                        <a class="dropdown-item" href="{{ route('descontos.index') }}">Descontos</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('parcelamentos.index') }}">Parcelamentos</a>
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                </ul>
            </li>
    </ul>
    <!-- Left links -->
</div>
<!-- Collapsible wrapper -->

<!-- Right elements -->
<div class="d-flex align-items-center">
    <!-- Icon -->
    <a class="text-reset me-3" href="#">
        <i class="fas fa-shopping-cart"></i>
    </a>

    <!-- Notifications -->
    <a
    class="text-reset me-3 dropdown-toggle hidden-arrow"
    href="#"
    id="navbarDropdownMenuLink"
    role="button"
    data-mdb-toggle="dropdown"
    aria-expanded="false"
    >
    <i class="fas fa-bell"></i>
    <span class="badge rounded-pill badge-notification bg-danger">1</span>
</a>
<ul
class="dropdown-menu dropdown-menu-end"
aria-labelledby="navbarDropdownMenuLink"
>
<li>
    <a class="dropdown-item" href="#">Some news</a>
</li>
<li>
    <a class="dropdown-item" href="#">Another news</a>
</li>
<li>
    <a class="dropdown-item" href="#">Something else here</a>
</li>
</ul>

<!-- Avatar -->
<a
class="dropdown-toggle d-flex align-items-center hidden-arrow"
href="#"
id="navbarDropdownMenuLink"
role="button"
data-mdb-toggle="dropdown"
aria-expanded="false"
>
<img
src="https://mdbootstrap.com/img/new/avatars/2.jpg"
class="rounded-circle"
height="25"
alt=""
loading="lazy"
/>
</a>
<ul
class="dropdown-menu dropdown-menu-end"
aria-labelledby="navbarDropdownMenuLink"
>
<li>
    <a class="dropdown-item" href="#">My profile</a>
</li>
<li>
    <a class="dropdown-item" href="#">Settings</a>
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
