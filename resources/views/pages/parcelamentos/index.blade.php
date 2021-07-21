@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Parcelamentos</h3>
    <section class="novo-item">
        <button type="button" class="btn btn-success btn-md" onclick="novoParcelamento()">
            <i class="fas fa-plus"></i> <span>Novo parcelamento</span>
        </button>
    </section>
    <div class="table-responsive">
        <table  class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Parcelas</th>
                    <th>Valor (R$)</th>
                    <th class="col-sm-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($parcelamentos as $parcelamento)
                <tr>
                    <td>{{$parcelamento->nome}}</td>
                    <td>{{$parcelamento->parcelas}}</td>
                    <td>{{$parcelamento->valor_minimo}}</td>
                    <td class="col-sm-1">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Ações de parcelamentos">
                            <button
                                type="button"
                                class="btn btn-warning"
                                title="Alterar"
                                onclick="alterarParcelamento({{$parcelamento}})"
                            >
                                <i class="far fa-edit"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                title="Excluir"
                                onclick="excluirItem('/parcelamentos',{{$parcelamento}})"
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

@include('pages.parcelamentos.modal', [
    'id' => 'parcelamento-modal',
    'label' => 'parcelamento-label',
    'title' => 'Novo parcelamento',
    'form_id' => 'parcelamento-form'
])

@stop

@section('js')
<script>
    function novoParcelamento() {
        $('#parcelamento-label').text('Novo parcelamento');
        $('.form-group').children(':input').val('');
        $('#submit').attr('onclick', enviarFormulario('post', `parcelamentos`, 'parcelamento-form'));
        abrirModal('criacao');
    }

    function alterarParcelamento(parcelamento) {
        $('#parcelamento-label').text(`Alterar ${parcelamento.nome}`);
        $('#nome').val(parcelamento.nome);
        $('#parcelas').val(parcelamento.parcelas);
        $('#valor_minimo').val(parcelamento.valor_minimo);
        $('#submit').attr('onclick', enviarFormulario('put', `parcelamentos/${parcelamento.id}`, 'parcelamento-form'));
        abrirModal();
    }

    function abrirModal(tipo='alteracao') {
        if(tipo !== 'alteracao') {
            $('.form-outline').children(':input').val('');
        }
        $('.form-outline').children(':input').removeClass('is-valid').removeClass('is-invalid');
        $('#parcelamento-modal').modal('show');
    }


    $(function() {
        let parcelamentoCriado = localStorage.getItem('item-criado');
        let parcelamentoAlterado = localStorage.getItem('item-alterado');

        if(parcelamentoCriado) {
            $($('.alert-success').show()).insertBefore( $( "table" ) );
            localStorage.removeItem('item-criado');
        }
        if(parcelamentoAlterado) {
            $($('.alert-warning').show()).insertBefore( $( "table" ) );
            localStorage.removeItem('item-alterado');
        }
    });
</script>
@stop
