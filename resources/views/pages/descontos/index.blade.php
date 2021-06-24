@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Descontos</h3>
    <section class="novo-item">
        <button type="button" class="btn btn-success btn-md" onclick="novoDesconto()">
            <i class="fas fa-plus"></i> <span>Novo desconto</span>
        </button>
    </section>
    <div class="table-responsive">
        <table  class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Forma de pagamento</th>
                    <th>Porcentagem</th>
                    <th class="col-sm-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($descontos as $desconto)
                <tr>
                    <td>{{$desconto->nome}}</td>
                    <td>{{$desconto->forma_pagamento->label}}</td>
                    <td>{{$desconto->porcentagem_label}}</td>
                    <td class="col-sm-1">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Ações de descontos">
                            <button
                                type="button"
                                class="btn btn-warning"
                                title="Alterar"
                                onclick="alterarDesconto({{$desconto}})"
                            >
                                <i class="far fa-edit"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-danger"
                                title="Excluir"
                                onclick="excluirItem('/descontos',{{$desconto}})"
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

@include('pages.descontos.modal', [
    'id' => 'desconto-modal',
    'label' => 'desconto-label',
    'title' => 'Novo desconto',
    'form_id' => 'desconto-form'
])

@stop

@section('js')
<script>
    function novoDesconto() {
        $('#desconto-label').text('Novo desconto');
        $('.form-group').children(':input').val('');
        $('#submit').attr('onclick', enviarFormulario('post', `descontos`, 'desconto-form'));
        abrirModal();
    }

    function alterarDesconto(desconto) {
        $('#desconto-label').text(`Alterar ${desconto.nome}`);
        $('#nome').val(desconto.nome);
        $('#forma_pagamento').val(desconto.forma_pagamento.id).change();
        $('#porcentagem').val(desconto.porcentagem);
        $('#submit').attr('onclick', enviarFormulario('put', `descontos/${desconto.id}`, 'desconto-form'));
        abrirModal();
    }

    function abrirModal() {
        $('.form-group').children(':input').removeClass('is-valid').removeClass('is-invalid');
        $('#desconto-modal').modal('show');
    }


    $(function() {
        $('#forma_pagamento').select2({
            width: '100%',
            dropdownParent: $('#desconto-modal')
        });

        let descontoCriado = localStorage.getItem('item-criado');
        let descontoAlterado = localStorage.getItem('item-alterado');

        if(descontoCriado) {
            $($('.alert-success').show()).insertBefore( $( "table" ) );
            localStorage.removeItem('item-criado');
        }
        if(descontoAlterado) {
            $($('.alert-warning').show()).insertBefore( $( "table" ) );
            localStorage.removeItem('item-alterado');
        }
    });
</script>
@stop
