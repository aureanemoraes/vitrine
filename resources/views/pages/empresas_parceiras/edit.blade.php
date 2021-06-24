@extends('layouts.app')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('empresas_parceiras.index') }}">Empresas parceiras</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
            Alterar {{ $empresa_parceira->nome }}
        </li>
    </ol>
</nav>
@stop

@section('content')
    <div class="container">
        <h3>Alterar <strong>{{ $empresa_parceira->nome }}</strong></h3>
        <form action="{{ route('empresas_parceiras.update', $empresa_parceira->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group mb-4">
                <div class="row row-image">
                    <div class="col-auto logo-image">
                        <img
                            src="/logos/{{$empresa_parceira->logo}}"
                            alt="Logo empresa {{$empresa_parceira->nome}}"
                            style="max-width:80px;max-height: 80px;"
                        />
                    </div>
                    <div class="col">
                        <label class="form-label" for="imagem">Logo</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" />
                    </div>
                </div>
            </div>

            <div class="form-outline mb-4">
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    class="form-control"
                    value="{{ $empresa_parceira->nome }}"
                />
                <label class="form-label" for="nome">Nome</label>
            </div>

            <div class="form-outline mb-4">
                <textarea
                    id="descricao"
                    name="descricao"
                    class="form-control"
                    cols="30"
                    rows="10"
                >{{ $empresa_parceira->descricao }}</textarea>
                <label class="form-label" for="descricao">Descrição</label>
            </div>

            <div class="form-outline mb-4">
                <input
                    type="text"
                    id="site"
                    name="site"
                    class="form-control"
                    value="{{ $empresa_parceira->site }}"
                />
                <label class="form-label" for="site">Site</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    </div>
@stop

@section('js')
<script>
</script>

@stop
