@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Empresas Parceiras</h3>
    <section class="novo-item">
        <a type="button" class="btn btn-success btn-md" href="{{ route('empresas_parceiras.create') }}">
            <i class="fas fa-plus"></i>
            <span>
                Nova empresa parceira
            </span>
        </a>
    </section>
    <div class="table-responsive">
        <table  class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nome</th>
                    <th>Site</th>
                    <th class="col-sm-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($empresas_parceiras as $empresa_parceira)
                <tr>
                    <td>
                        <img
                            src="{{ asset('logos/' . $empresa_parceira->logo)}}"
                            alt="Logo da empresa {{$empresa_parceira->nome}}"
                            style="max-width:80px;max-height: 80px;"
                        />
                    </td>
                    <td>{{$empresa_parceira->nome}}</td>
                    <td>{{$empresa_parceira->site}}</td>
                    <td class="col-sm-1">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Ações de empresas parceiras">
                            <a
                                type="button"
                                class="btn btn-info"
                                title="Ver subcategorias"
                                href="{{ route('empresas_parceiras.show', $empresa_parceira->id) }}"
                            >
                                <i class="far fa-eye"></i>
                            </a>
                            <a
                                type="button"
                                class="btn btn-warning"
                                title="Alterar"
                                href="{{ route('empresas_parceiras.edit', $empresa_parceira->id) }}"
                            >
                                <i class="far fa-edit"></i>
                            </a>
                            <button
                                type="button"
                                class="btn btn-danger"
                                title="Excluir"
                                onclick="excluirItem('/empresas_parceiras',{{$empresa_parceira}})"
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
@stop

@section('js')
<script>
</script>
@stop
