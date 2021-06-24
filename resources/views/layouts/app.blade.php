<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vitrine</title>

        @include('layouts.css')
    </head>
    <body>
        @include('components.navbar')
        <main>
            <div class="breadcrumb">
                @yield('breadcrumb')
            </div>
            @yield('content')
        </main>
        @include('layouts.js')
    </body>
</html>
