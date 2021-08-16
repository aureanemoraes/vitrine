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
        <h3>Entidade</h3>
        @if(count($entidade) > 0)
            <form action="{{ route('entidades.update', $entidade[0]->id) }}" method="POST" enctype="multipart/form-data" id="entidade-form">
                @csrf
                @method('PUT')
                <div class="form-outline {{$errors->has('nome') ? 'mb-5' : 'mb-4'}}">
                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}"
                        value="{{ $entidade[0]->nome }}"
                    />
                    <label class="form-label" for="nome">Nome</label>

                    @if ($errors->has('nome'))
                        <div class="invalid-feedback">{{$errors->first('nome')}}</div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <textarea
                        id="descricao"
                        name="descricao"
                        class="ckeditor form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}"
                        cols="30"
                        rows="10"
                    >{{$entidade[0]->descricao}}</textarea>

                    @if ($errors->has('descricao'))
                        <div class="invalid-feedback">{{$errors->first('descricao')}}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
            </form>
        @else
            <form action="{{ route('entidades.send') }}" method="POST" enctype="multipart/form-data" id="entidade-form">
                @csrf
                <div class="form-outline {{$errors->has('nome') ? 'mb-5' : 'mb-4'}}">
                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}"
                        value="{{old('nome')}}"
                    />
                    <label class="form-label" for="nome">Nome</label>

                    @if ($errors->has('nome'))
                        <div class="invalid-feedback">{{$errors->first('nome')}}</div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <textarea
                        id="descricao"
                        name="descricao"
                        class="ckeditor form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}"
                        cols="30"
                        rows="10"
                    >{{old('descricao')}}</textarea>

                    @if ($errors->has('descricao'))
                        <div class="invalid-feedback">{{$errors->first('descricao')}}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
            </form>
        @endif
    </div>
@stop

@section('js')
    <script>
        ClassicEditor
        .create( document.querySelector( '.ckeditor' ) , {
            filebrowserUploadUrl: "{{route('imagem.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        })
        .catch( error => {
            console.error( error );
        } );
    </script>
@stop
