<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vitrine</title>

        @include('layouts.css')
    </head>
    <body>
        <div class="main">
            <nav>
                @include('components.navbar')
            </nav>

            <header>
                <div class="container-fluid">
                    <nav class="breadcrumb-container">
                        @yield('breadcrumb')
                    </nav>
                </div>
            </header>
            <main>
                    @yield('content')
            </main>

            <aside>
                <div class="container">
                    @yield('filtros')
                </div>
            </aside>

            <footer>
              footer
            </footer>
          </div>
        {{-- <div class="wrapper">
            <header class="main-head">
                @include('components.navbar')
            </header>
            <nav class="main-nav">
                @yield('breadcrumb')
            </nav>
            <article class="content">
                @yield('content')
            </article>
            <aside class="side">
                @yield('filtros')
            </aside>
            <div class="ad">Advertising</div>
            <footer class="main-footer">The footer</footer>
        </div> --}}

        {{-- <div class="main">
            <div class="breadcrumb">
            </div>
            <div class="filtros">
            </div>
            <main class="conteudo">
            </main>
        </div> --}}
        @include('layouts.js')
    </body>
</html>
