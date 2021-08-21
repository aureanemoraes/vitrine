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
                            src="/logos-empresas/{{$empresa_parceira->logo}}"
                            alt="Logo empresa {{$empresa_parceira->nome}}"
                            style="max-width:80px;max-height: 80px;"
                        />
                    </div>
                    <div class="col">
                        <label class="form-label" for="imagem">Logo</label>
                        <input type="file" class="form-control {{$errors->has('imagem') ? 'is-invalid' : ''}}" id="imagem" name="imagem" />
                    </div>
                </div>
                @if ($errors->has('imagens'))
                    <div class="invalid-feedback">{{$errors->first('imagens')}}</div>
                @endif
            </div>

            <div class="form-outline mb-4">
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}"
                    value="{{ $empresa_parceira->nome }}"
                />
                <label class="form-label" for="nome">Nome</label>
                @if ($errors->has('nome'))
                    <div class="invalid-feedback">{{$errors->first('nome')}}</div>
                @endif
            </div>

            <div class="form-outline mb-4">
                <textarea
                    id="descricao"
                    name="descricao"
                    class="form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}"
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
                    class="form-control {{$errors->has('site') ? 'is-invalid' : ''}}"
                    value="{{ $empresa_parceira->site }}"
                />
                <label class="form-label" for="site">Site</label>
            </div>

            <div class="form-check form-switch mb-4">
                <input
                class="form-check-input {{$errors->has('relevante') ? 'is-invalid' : ''}}"
                type="checkbox"
                id="relevante"
                name="relevante"
                value="1"
                {{($empresa_parceira->relevante) ? 'checked' : ''}}
                />
                <label class="form-check-label" for="relevante" name="relevante">
                    Relevante
                </label>
                @if ($errors->has('relevante'))
                    <div class="invalid-feedback">{{$errors->first('relevante')}}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    </div>
@stop

@section('js')
<script>
</script>

@stop
