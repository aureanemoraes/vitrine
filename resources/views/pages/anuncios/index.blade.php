@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Anúncios</h3>
    <section class="novo-item">
        <a type="button" class="btn btn-success btn-md" href="{{ route('anuncios.create') }}">
            <i class="fas fa-plus"></i> <span>Novo anúncio</span>
        </a>
    </section>
    <div class="table-responsive">
        <table  class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Link</th>
                    <th>Ativo</th>
                    <th class="col-sm-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($anuncios as $anuncio)
                <tr>
                    <td>{{$anuncio->nome}}</td>
                    <td>{{$anuncio->link}}</td>
                    <td>{{$anuncio->ativo}}</td>
                    <td class="col-sm-1">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Ações de anuncios">
                            <a
                                type="button"
                                class="btn btn-warning"
                                title="Alterar"
                                href="{{ route('anuncios.edit', $anuncio->id) }}"
                            >
                                <i class="far fa-edit"></i>
                        </a>
                            <button
                                type="button"
                                class="btn btn-danger"
                                title="Excluir"
                                onclick="excluirItem('/anuncios',{{$anuncio}})"
                            >
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('components.alerts')
@stop

@section('js')
@stop
