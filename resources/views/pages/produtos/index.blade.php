@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app-with-filter.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/produtos.css') }}"/>

@endsection

@section('filtros')
    @include('components.filtros', [
        'filtro_promocao' => $filtro_promocao,
        'filtro_categorias' => $filtro_categorias,
        'filtro_subcategorias' => $filtro_subcategorias,
        'filtro_empresas_parceiras' => $filtro_empresas_parceiras
    ])
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('produtos.index') }}">Produtos</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
           Promoções
        </li>
    </ol>
</nav>
@stop

@section('content')
<main>
    @include('partials.produtos', ['produtos' => $produtos])
</main>
  <!--Main layout-->
@stop
