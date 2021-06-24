@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Categorias</h3>
    <section class="novo-item">
        <button type="button" class="btn btn-success btn-md" onclick="novaCategoria()">
            <i class="fas fa-plus"></i> <span>Nova categoria</span>
        </button>
    </section>
    <div class="table-responsive">
        <table  class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th class="col-sm-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->nome}}</td>
                    <td>{{$categoria->descricao}}</td>
                    <td class="col-sm-1">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Ações de categorias">
                            <button
                                type="button"
                                class="btn btn-info"
                                title="Ver subcategorias"
                                onclick="verSubcategorias({{$categoria}})"
                            >
                                <i class="far fa-eye"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-warning"
                                title="Alterar"
                                onclick="alterarCategoria({{$categoria}})"
                            >
                                <i class="far fa-edit"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                title="Excluir"
                                onclick="excluirItem('/categorias',{{$categoria}})"
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

@include('pages.categorias.modal', [
    'id' => 'categoria-modal',
    'label' => 'categoria-label',
    'title' => 'Nova categoria',
    'form_id' => 'categoria-form'
])

@stop

@section('js')
<script>
    function verSubcategorias(categoria) {
        location.href = `categorias/${categoria.id}`;
    }

    function novaCategoria() {
        $('#categoria-label').text('Nova categoria');
        $('.form-group').children(':input').val('');
        $('#submit').attr('onclick', enviarFormulario('post', `categorias`, 'categoria-form'));
        abrirModal();
    }

    function alterarCategoria(categoria) {
        $('#categoria-label').text(`Alterar ${categoria.nome}`);
        $('#nome').val(categoria.nome);
        $('#descricao').val(categoria.descricao);
        $('#submit').attr('onclick', enviarFormulario('put', `categorias/${categoria.id}`, 'categoria-form'));
        abrirModal();
    }

    function abrirModal() {
        $('.form-group').children(':input').removeClass('is-valid').removeClass('is-invalid');
        $('#categoria-modal').modal('show');
    }


    $(function() {

        let categoriaCriada = localStorage.getItem('item-criado');
        let categoriaAlterada = localStorage.getItem('item-alterado');

        if(categoriaCriada) {
            $($('.alert-success').show()).insertBefore( $( "table" ) );
            localStorage.removeItem('item-criado');
        }
        if(categoriaAlterada) {
            $($('.alert-warning').show()).insertBefore( $( "table" ) );
            localStorage.removeItem('item-alterado');
        }
    });
</script>
@stop
