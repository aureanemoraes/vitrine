@extends('layouts.app')

@section('layout-app')
<link rel="stylesheet" href="{{ asset('css/app-without-filter.css') }}"/>
@stop

@section('css')

    <style>
        .container  {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h3>Novo produto</h3>
        <form action="{{ route('anuncios.store') }}" method="POST" enctype="multipart/form-data" id="anuncio-form">
            @csrf
            <div class="form-outline {{$errors->has('nome') ? 'mb-5' : 'mb-4'}}">
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}"
                    value="{{ $anuncio->nome }}"
                />
                <label class="form-label" for="nome">Nome</label>

                @if ($errors->has('nome'))
                    <div class="invalid-feedback">{{$errors->first('nome')}}</div>
                @endif
            </div>
            {{---Imagem--}}
            <div class="form-group mb-4">
                <div class="row row-images">
                    <i class="far fa-image fa-5x imagem"></i>
                </div>
                <div class="row">
                    <label class="form-label" for="imagem">Imagens</label>
                    <input
                        type="file"
                        class="form-control {{$errors->has('imagem') ? 'is-invalid' : ''}}"
                        id="imagem"
                        name="imagem"
                    />
                </div>
                @if ($errors->has('imagem'))
                    <div class="invalid-feedback">{{$errors->first('imagem')}}</div>
                @endif
            </div>
            <div class="form-outline {{$errors->has('descricao') ? 'mb-5' : 'mb-4'}}">
                <input
                    type="text"
                    id="descricao"
                    name="descricao"
                    class="form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}"
                    value="{{ $anuncio->descricao }}"
                />
                <label class="form-label" for="descricao">Breve descrição imagem</label>

                @if ($errors->has('descricao'))
                    <div class="invalid-feedback">{{$errors->first('descricao')}}</div>
                @endif
            </div>

            {{---Link--}}
            <div class="form-outline {{$errors->has('link') ? 'mb-5' : 'mb-4'}}">
                <input
                    type="text"
                    id="link"
                    name="link"
                    class="form-control {{$errors->has('link') ? 'is-invalid' : ''}}"
                    value="{{ $anuncio->link }}"
                />
                <label class="form-label" for="link">Link</label>

                @if ($errors->has('link'))
                    <div class="invalid-feedback">{{$errors->first('link')}}</div>
                @endif
            </div>

            <div class="form-check form-switch mb-4">
                <input
                class="form-check-input"
                type="checkbox"
                id="ativo"
                name="ativo"
                value="1"
                {{ $anuncio->ativo ? 'checked' : '' }}
                />
                <label class="form-check-label" for="ativo" name="ativo">
                    Ativo
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    </div>
@stop
