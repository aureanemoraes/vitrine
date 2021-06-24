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
        @if(count($subcategorias) > 0)
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
                        @foreach($subcategorias as $subcategoria)
                        <tr>
                            <td>{{$subcategoria->nome}}</td>
                            <td>{{$subcategoria->descricao}}</td>
                            <td class="col-sm-1">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Ações de subcategoria">
                                    <button
                                        type="button"
                                        class="btn btn-warning"
                                        title="Alterar"
                                        onclick="alterarSubcategoria({{$subcategoria}})"
                                    >
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        title="Excluir"
                                        onclick="excluirItem('/subcategorias',{{$subcategoria}})"
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

        @include('components.pagination', [
            'anterior' => $subcategorias->previousPageUrl(),
            'atual' => url()->current(),
            'proxima' => $subcategorias->nextPageUrl(),
            'pagina_atual' => $subcategorias->currentPage()
        ])
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
        $('#categoria_id').val(subcategoria.categoria_id).change();
        $('#submit').attr('onclick', enviarFormulario('put', `/subcategorias/${subcategoria.id}`, 'subcategoria-form'));
        abrirModal();
    }

    function abrirModal() {
        $('.form-group').children(':input').removeClass('is-valid').removeClass('is-invalid');
        $('#subcategoria-modal').modal('show');
    }


    $(function() {

    });
</script>
@stop
