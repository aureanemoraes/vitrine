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
            {{---Link--}}
            <div class="form-outline {{$errors->has('link') ? 'mb-5' : 'mb-4'}}">
                <input
                    type="text"
                    id="link"
                    name="link"
                    class="form-control {{$errors->has('link') ? 'is-invalid' : ''}}"
                    value="{{old('link')}}"
                />
                <label class="form-label" for="link">Link</label>

                @if ($errors->has('link'))
                    <div class="invalid-feedback">{{$errors->first('link')}}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    </div>
@stop
