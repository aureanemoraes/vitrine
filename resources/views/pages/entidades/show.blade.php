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
            <h3>{{ $entidade->nome }}</h3>
            <section>
                {!! nl2br($entidade->descricao) !!}
            </section>
    </div>
@stop
