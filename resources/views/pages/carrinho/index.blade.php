@extends('layouts.app')

@section('css')
    <style>
        .increase-descrease-container {
            /* box-shadow: none; */
        }

        .product-table {
            vertical-align: middle;
            text-align: center;
        }

        .finalizar-pedido, .zap {
            margin-top: 1rem;
        }

        .total {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: gainsboro;
            border-radius: 1rem;
        }

        .btn-outline-success:hover {
            color: green;
        }

    </style>
@stop

@section('content')
<div class="container">
    <section class="section my-5 pb-5">
        <div class="table-responsive">
            <table class="table product-table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="font-weight-bold">
                            <strong>Produto</strong>
                        </th>
                        <th></th>
                        <th class="font-weight-bold">
                            <strong>Preço</strong>
                        </th>
                        <th class="font-weight-bold">
                            <strong>Qtd.</strong>
                        </th>
                        <th class="font-weight-bold">
                            <strong>Valor total</strong>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{session()->flush()}} --}}
                    @if(session('produtos'))
                        @php($parcelamentos = App\Models\Parcelamento::getParcelamentos())
                        @php($subtotal = 0)
                        @foreach(session('produtos') as $produto_id => $quantidade)
                            <tr>
                                @php($produto = App\Models\Produto::produtoInfo($produto_id))
                                @if(isset($produto))
                                    <th scope="row">
                                        <img src="{{ asset('produtos-imagens/' . $produto->imagens[0]) }}" alt="" class="img-fluid z-depth-0" width="80px" height="80px">
                                    </th>
                                    <td>
                                        <h5 class="mt-3">
                                        <strong>
                                            <a href="{{ route('produtos.show', $produto->id) }}">{{ $produto->nome }}</a>
                                        </strong>
                                        </h5>
                                        <p class="text-muted">{{ $produto->empresa_parceira->nome}}</p>
                                    </td>
                                    <td></td>
                                    <td id="{{ 'valor-produto-' . $produto_id . '-formatado'}}">
                                        {{ isset($produto->desconto) && $produto->desconto > 0 ? $produto->valor_com_desconto_formatado : $produto->valor_formatado }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <input
                                                type="number"
                                                aria-label="Qtd"
                                                class="form-control quantidade"
                                                style="width: 100px"
                                                id="{{ 'quantidade-produto-' . $produto_id }}"
                                                name="{{ 'quantidade-produto-' . $produto_id }}"
                                                min="1"
                                                value="{{$quantidade}}"
                                            >
                                        </div>
                                    </td>
                                    <td class="font-weight-bold">
                                        @php($valor_produto = isset($produto->desconto) && $produto->desconto > 0 ? $produto->valor_com_desconto : $produto->valor)
                                        @php($valor_total = floatval($valor_produto) * $quantidade)
                                        @php($subtotal += $valor_total)
                                        @php($valor_total_formatado = 'R$ ' . number_format($valor_total, 2, ',', '.'))
                                        <strong id="{{ 'valor-total-produto-' . $produto_id  . '-formatado'}}">
                                            {{ $valor_total_formatado }}
                                        </strong>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Remove item">X
                                        </button>
                                    </td>
                                @endif
                            </tr>
                            @php(
                                $produtos[$produto->id] = [
                                    'nome' => $produto->nome,
                                    'quantidade' => intval($quantidade),
                                    'desconto' => isset($produto->desconto) && $produto->desconto > 0 ? $produto->desconto : 0,
                                    'valor' => $valor_produto,
                                    'valor_total' => $valor_total
                                ]
                            )
                        @endforeach
                        <tfoot>
                            <tr>
                                <td colspan="100%">
                                    <div class="float-end">
                                        @php($produtos['subtotal'] = $subtotal)
                                        @php($subtotal_formatado = 'R$ ' . number_format($subtotal, 2, ',', '.'))
                                        <p>
                                            <strong>Subtotal: </strong>
                                            <span class="subtotal-produtos-formatado">{{ $subtotal_formatado }}</span>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    @else
                        <tr>
                            <td colspan="100%">
                                <p>Ainda não há produtos adicionados :(</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>
    @if(session('produtos'))
        <section class="formas-pagamento">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Selecione a forma de pagamento desejada:</p>
                    <div class="list-group">
                        @php($formas_pagamento = App\Models\Desconto::formas_pagamento())
                        @if(count($formas_pagamento) > 0)
                            @foreach($formas_pagamento as $forma_pagamento)
                                @if($forma_pagamento->id === 4)
                                    <label class="list-group-item d-flex justify-content-between align-items-center" id="forma_pagamento_label">
                                        <div class="infos">
                                            <span>{{ $forma_pagamento->label }}</span> |
                                            @if($forma_pagamento->desconto->porcentagem > 0)
                                                <span class="text-warning disabled">
                                                    <del class="subtotal-produtos-formatado">{{ $subtotal_formatado }}</del>
                                                </span> -
                                                <span class="text-primary disabled">
                                                    {{ $forma_pagamento->desconto->porcentagem_label }}
                                                </span> =
                                                @php($subtotal_com_desconto = $subtotal - ($subtotal * ($forma_pagamento->desconto->porcentagem/100)))
                                                @php($subtotal_com_desconto_formatado = 'R$ ' . number_format($subtotal_com_desconto, 2, ',', '.'))
                                                <span class="text-success" id={{ 'subtotal-produtos-desconto-formatado-' . $forma_pagamento->id }}>
                                                    <strong>{{$subtotal_com_desconto_formatado}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="radio-buttons">
                                            @php($parcelamento = App\Models\Produto::parcelasProduto($subtotal_com_desconto))
                                            @if(isset($parcelamento))
                                                @php($parcelamento = (object) $parcelamento)
                                                <span id="parcelas">
                                                    {{ $parcelamento->parcelas }}x de {{ $parcelamento->valor_parcela_formatado }}
                                                </span>
                                            @else
                                            <span id="parcelas">
                                            </span>
                                            @endif
                                            <input
                                            class="form-check-input me-1"
                                            type="radio"
                                            value="{{ $subtotal_com_desconto }}"
                                            name="forma_pagamento"
                                            />
                                        </div>
                                    </label>
                                @else
                                    <label class="list-group-item d-flex justify-content-between align-items-center" id="forma_pagamento_label">
                                        <div class="infos">
                                            <span>{{ $forma_pagamento->label }}</span> |
                                            @if($forma_pagamento->desconto->porcentagem > 0)
                                                <span class="text-warning disabled">
                                                    <del class="subtotal-produtos-formatado">{{ $subtotal_formatado }}</del>
                                                </span> -
                                                <span class="text-primary disabled">
                                                    {{ $forma_pagamento->desconto->porcentagem_label }}
                                                </span> =
                                                @php($subtotal_com_desconto = $subtotal - ($subtotal * ($forma_pagamento->desconto->porcentagem/100)))
                                                @php($subtotal_com_desconto_formatado = 'R$ ' . number_format($subtotal_com_desconto, 2, ',', '.'))
                                                <span class="text-success" id={{ 'subtotal-produtos-desconto-formatado-' . $forma_pagamento->id }}>
                                                    <strong>{{$subtotal_com_desconto_formatado}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="radio-buttons">
                                            <input
                                            class="form-check-input me-1"
                                            type="radio"
                                            value="{{ $subtotal_com_desconto }}"
                                            name="forma_pagamento"
                                            />
                                        </div>
                                    </label>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="finalizar-pedido">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p class="card-title">Informações do cliente</p>
                            <div class="form-outline">
                                <input
                                    type="text"
                                    id="nome"
                                    name="nome"
                                    class="form-control"
                                    required
                                />
                                <label class="form-label" for="nome">Seu nome <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col total">
                            <p class="card-title"><strong>Total:</strong></p>
                            <span id="total"></span>
                        </div>
                    </div>
                    <div class="row zap float-end">
                        <p>
                            <button type="button" class="btn btn-outline-success" onclick="enviarPedidoNoZap()">
                                <i class="fab fa-whatsapp"></i> Enviar pedido
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
@stop
@section('js')
<script>
    let valor_final;
    let produtos;

    function formatar_valor(valor) {
        return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor);
    }

    function enviarPedidoNoZap() {
        let produtos_pedido = '';
        for(id in produtos) {
            if(id !== 'subtotal') {
                let produto = produtos[id];
                produtos_pedido += `\n*Nome*: ${produto.nome}\n*Quantidade*:${produto.quantidade}\n-----`;
            }
        }
        // produtos_pedido += produtos.forEach(produto => {
        //     return `\n*Nome*: ${produto.nome}\n*Quantidade*:${produto.quantidade}\n-----`;
        // });
        let numero = '5596999751199'
        let msg = `
        *Resumo do pedido*:
        ${produtos_pedido}
        \n*Valor Final*: ${valor_final}
        `;
        let alvo = `https://api.whatsapp.com/send?phone=${encodeURIComponent(numero)}&text=${encodeURIComponent(msg)}`

        window.open(alvo);
    }

    $('.quantidade').change(function(e) {
        let target = e.target.id;
        let id = parseFloat(target.replace('quantidade-produto-', ''));
        let quantidade = $(`#${target}`).val();

        // Alterar valor total do produto [DONE]
        let valor_total_produto = produtos[id].valor * quantidade;
        let valor_total_anterior = produtos[id].valor_total;
        $(`#valor-total-produto-${id}-formatado`).text(formatar_valor(valor_total_produto));

        // Alterar a quantidade de produto no session('produtos');
        produtos_carrinho = {!! json_encode(session('produtos')) !!}
        produtos_carrinho[id] = quantidade;
        document.cookie = `produtos_carrinho=${JSON.stringify(produtos_carrinho)}`;

        // // Alterar valor do subtotal
        let subtotal_anterior = produtos['subtotal'];
        let valor_subtotal = (subtotal_anterior - valor_total_anterior) + valor_total_produto;

        $('.subtotal-produtos-formatado').text(formatar_valor(valor_subtotal));
        // Alterar valor dos preços finais nas formas de pagamentos;
        let formas_pagamento = {!! json_encode($formas_pagamento) !!} || [];
        let parcelamentos = {!! json_encode($parcelamentos) !!} || [];
        let parcelamento_selecionado;
        if(formas_pagamento.length > 0) {
            formas_pagamento.forEach(forma_pagamento => {
                let valor_total = valor_subtotal - (valor_subtotal * (forma_pagamento.desconto.porcentagem/100));
                $(`#subtotal-produtos-desconto-formatado-${forma_pagamento.id}`).text(formatar_valor(valor_total));
                if(forma_pagamento.id == 4) {
                    // Tratar parcelamento
                    if(parcelamentos.length > 0) {
                        parcelamentos.find(parcelamento => {
                            if(!parcelamento_selecionado) {
                                if(valor_subtotal > parcelamento.valor_minimo) {
                                    parcelamento_selecionado = parcelamento;
                                }
                            }
                        });
                    }

                    if(parcelamento_selecionado) {
                        let valor_parcela = valor_total / parcelamento_selecionado.parcelas;
                        $('#parcelas').text(`${parcelamento_selecionado.parcelas}x de ${formatar_valor(valor_parcela)}`);
                    } else {
                        $('#parcelas').text('');
                    }
                }
            });
        }

        // Definir novos valores
        produtos[id].valor_total = valor_total_produto;
        produtos['subtotal'] = valor_subtotal;
        parcelamento_selecionado = null;
    });

    $('input[type=radio][name=forma_pagamento]').change(function() {
        if($(this).is(':checked')) {
            let forma_pagamento = $(this).val();
            valor_final = formatar_valor(forma_pagamento);
            $('#total').text(valor_final);
        }
    });

    // $('#forma_pagamento_label').click(function() {

    // });

    // $('#forma_pagamento').change(function() {
    //     let forma_pagamento = $('#forma_pagamento').val();
    //     console.log(forma_pagamento);
    //     // let number = '5596999751199'
    //     // // o texto ou algo vindo de um <textarea> ou <input> por exemplo
    //     // let msg = 'Um texto qualquer'

    //     // // montar o link (apenas texto) (web)
    //     // let target = `https://api.whatsapp.com/send?text=${encodeURIComponent(msg)}`

    //     // // montar o link (número e texto) (web)
    //     // let target = `https://api.whatsapp.com/send?phone=${encodeURIComponent(number)}&text=${encodeURIComponent(msg)}`
    // });

    $(function() {
        produtos = {!! json_encode($produtos) !!};
    });
</script>
@stop
