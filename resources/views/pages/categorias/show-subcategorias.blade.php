@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Categoria: {{$categoria->nome}}</h3>
        <h5>Subcategorias</h5>
        <section class="novo-item">
            <button type="button" class="btn btn-success btn-md" onclick="novaSubcategoria()">
                <i class="fas fa-plus"></i> <span>Nova subcategoria</span>
            </button>
        </section>
        @if(count($categoria->subcategorias) > 0)
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
                        @foreach($categoria->subcategorias as $subcategoria)
                        <tr>
                            <td>{{$subcategoria->nome}}</td>
                            <td>{{$subcategoria->descricao}}</td>
                            <td class="col-sm-1">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Ações de subcategoria">
                                    <button
                                        type="button"
                                        class="btn btn-warning"
                                        title="Alterar"
                                        onclick="alterarSubcategoria({{$subcategoria}}, {{$categoria}})"
                                    >
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        title="Excluir"
                                        onclick="excluirItem('/categorias',{{$subcategoria}})"
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
        @endif
    </div>

    @include('pages.subcategorias.modal', [
        'id' => 'subcategoria-modal',
        'label' => 'subcategoria-label',
        'title' => 'Nova categoria',
        'form_id' => 'subcategoria-form',
        'categorias' => $categorias
    ])

@stop

@section('js')
<script>
    function excluirSubcategoria(subcategoria) {
        Swal.fire({
            title: `Você realmente deseja excluir a subcategoria ${subcategoria.nome}`,
            showDenyButton: true,
            confirmButtonText: `Sim!`,
            denyButtonText: `Não...`
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('ok');
                enviarFormulario('delete', `/subcategorias/${subcategoria.id}`);
                Swal.fire('O item foi excluído com sucesso!', '', 'success');
            } else if (result.isDenied) {
                Swal.fire('Item <b>não</b> excluído', '', 'info');
            }
        });
    }

    function novaSubcategoria() {
        $('#subcategoria-label').text('Nova subcategoria');
        $('.form-group').children(':input').val('');
        $('#submit').attr('onclick', enviarFormulario('post', `/subcategorias`, 'subcategoria-form'));
        abrirModal();
    }

    function alterarSubcategoria(subcategoria, categoria) {
        $('#subcategoria-label').text(`Alterar ${subcategoria.nome}`);
        $('#nome').val(subcategoria.nome);
        $('#descricao').val(subcategoria.descricao);
        $('#categoria_id').val(categoria.id).change();
        $('#submit').attr('onclick', enviarFormulario('put', `/subcategorias/${subcategoria.id}`, 'subcategoria-form'));
        abrirModal();
    }

    function abrirModal() {
        $('.form-group').children(':input').removeClass('is-valid').removeClass('is-invalid');
        $('#subcategoria-modal').modal('show');
    }


    $(function() {
        let subcategoriaCriadaAlert = `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong>Criada nova subcategoria.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        `;

        let subcategoriaAlteradaAlert = `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> Alterada subcategoria
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        `;
        $('#subcategoria-modal').modal({
            keyboard: false,
            show: false
        });

        let subcategoriaCriada = localStorage.getItem('subcategoria-criada');
        let subcategoriaAlterada = localStorage.getItem('subcategoria-alterada');
        if(subcategoriaCriada) {
            $(subcategoriaCriadaAlert).insertBefore( $( "table" ) );
            localStorage.removeItem('subcategoria-criada');
        }
        if(subcategoriaAlterada) {
            $(subcategoriaAlteradaAlert).insertBefore( $( "table" ) );
            localStorage.removeItem('subcategoria-alterada');
        }

        $('#categoria_id').select2({
            width: '100%',
            dropdownParent: $('#subcategoria-modal')
        });
    });
</script>
@stop
