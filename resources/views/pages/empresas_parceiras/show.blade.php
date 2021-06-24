@extends('layouts.app')

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
        <div class="card-header">
            <div class="row row-image">
                <div class="col-auto logo-image">
                    {{-- Logo --}}
                    <img
                        src="{{ asset('logos/' . $empresa_parceira->logo) }}"
                        alt="Logo da empresa {{ $empresa_parceira->nome }}"
                        style="max-width:80px;max-height: 80px;"
                    />
                </div>
                <div class="col">
                    <div class="row">
                        <h5 class="card-title">{{ $empresa_parceira->nome }}</h5>
                    </div>
                    <div class="row">
                        <a href="{{ $empresa_parceira->site }}" title="Visitar site">{{ $empresa_parceira->site }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $empresa_parceira->descricao }}</p>
        </div>
        <div class="card-footer">
            <a class="btn btn-primary float-end" href="#" role="button">Produtos <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(function() {
    });
</script>
@stop
