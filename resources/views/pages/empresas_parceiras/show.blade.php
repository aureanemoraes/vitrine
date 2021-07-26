@extends('layouts.app')

@section('css')
    <style>
        img.logo-empresa-parceira {
            height:80px;
            width:80px;
            object-fit:contain;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 0.500rem;
            margin-bottom: 1rem;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/produtos.css') }}"/>
@stop

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('empresas_parceiras.index') }}">Empresas parceiras</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
            {{ $empresa_parceira->nome }}
        </li>
    </ol>
</nav>

@stop

@section('content')
<div class="container">
    @include('components.alerts')
    <div class="card">
        <div class="card-body text-center">
            <section class="header text-center">
                <img
                src="{{ asset('logos-empresas/' . $empresa_parceira->logo) }}"
                alt="Logo da empresa {{ $empresa_parceira->nome }}"
                class="img-fluid rounded logo-empresa-parceira"
                />
                <h5 class="card-title">{{ $empresa_parceira->nome }}</h5>
                <a href="{{ $empresa_parceira->site }}" title="Visitar site">{{ $empresa_parceira->site }}</a>
            </section>
            <p class="card-text">{{ $empresa_parceira->descricao }}</p>
        </div>
        @include('partials.produtos', ['produtos' => $produtos, 'ordenar' => true, 'paginacao' => true])
    </div>
</div>
@stop

@section('js')
<script>
    $(function() {
    });
</script>
@stop
