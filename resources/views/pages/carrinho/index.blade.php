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

        .produto-nome {
            color: #53aeda;

        }

        .disabled {
            color: gray !important;
        }

    </style>
@stop

@section('content')
<div class="container">
    <form action="{{ route('carrinho.alterar') }}" method="POST">
        @csrf
        @method('put')
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
                                            @if(isset($produto->imagens[0]))
                                                <img src="{{ asset('produtos-imagens/' . $produto->imagens[0]) }}" alt="" class="img-fluid z-depth-0" width="80px" height="80px">
                                            @else
                                                <div class="border d-flex align-items-center justify-content-center sem-imagem">
                                                    <p>Sem imagem</p>
                                                </div>
                                            @endif
                                        </th>
                                        <td>
                                            <h6 class="mt-3">
                                            <strong>
                                                <a class="produto-nome" href="{{ route('produtos.show', $produto->id) }}">{{ $produto->nome }}</a>
                                                @if($produto->desconto > 0)
                                                    <sup><span class="text-danger">{{ $produto->desconto }}%</span></sup>
                                                @endif
                                            </strong>
                                            </h6>
                                            {{-- <p class="text-muted">{{ $produto->empresa_parceira->nome}}</p> --}}
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
                                                    name="produtos[{{$produto_id}}]"
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
                                            <a
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Remove item"
                                            href={{ route('carrinho.remover', $produto_id) }}
                                            >
                                                X
                                            </a>
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
                @if(session('produtos'))
                    <div class="float-end">
                        <a
                        type="button"
                        class="btn btn-sm btn-primary"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Remove item"
                        href={{ route('carrinho.limpar') }}
                        >
                            Limpar carrinho <i class="fas fa-trash"></i>
                        </a>
                        <button type="submit" class="btn btn-sm btn-primary">Atualizar carrinho <i class="fas fa-undo"></i></button>
                    </div>
                @endif
            </div>
        </section>
    </form>
    @if(session('produtos'))
        @php($todos_produtos_promocionais = false)
        @php($produtos_promocao = 0)
        @php($subtotal_produtos_promocao = 0)
        @foreach($produtos as  $produto)
            @if(isset($produto['desconto']) && $produto['desconto'] > 0)
                @php($produtos_promocao += 1)
                @php($subtotal_produtos_promocao += $produto['valor_total'])
            @endif
        @endforeach
        @if($produtos_promocao == count($produtos)-1)
            @php($todos_produtos_promocionais = true)
        @endif
        @if($todos_produtos_promocionais)
            <section class="formas-pagamento">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Selecione a forma de pagamento desejada:</p>
                        <div class="list-group">
                            @php($formas_pagamento = App\Models\Desconto::formas_pagamento())
                            @if(count($formas_pagamento) > 0)
                                @foreach($formas_pagamento as $forma_pagamento)
                                    @if($forma_pagamento->id === 4)
                                        @php($parcelamento = App\Models\Produto::parcelasProduto($subtotal))
                                        <label class="list-group-item d-flex justify-content-between align-items-center" id="forma_pagamento_label">
                                            <div class="infos">
                                                @if(isset($parcelamento))
                                                    <span>{{ $forma_pagamento->label }}</span> |
                                                    <span class="text-success" id={{ 'subtotal-produtos-desconto-formatado-' . $forma_pagamento->id }}>
                                                        <strong>{{$subtotal_formatado}}</strong>
                                                    </span>
                                                @else
                                                    <span><del>{{ $forma_pagamento->label }}</del></span> |
                                                    <span class="text-success" id={{ 'subtotal-produtos-desconto-formatado-' . $forma_pagamento->id }}>
                                                        <strong><del>{{$subtotal_formatado}}</del></strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="radio-buttons">
                                                @if(isset($parcelamento))
                                                    @php($parcelamento = (object) $parcelamento)
                                                    @php($texto_parcelas = $parcelamento->parcelas  . 'x de ' . $parcelamento->valor_parcela_formatado)
                                                    <span id="parcelas">
                                                        {{$texto_parcelas}}
                                                    </span>
                                                    <input
                                                    class="form-check-input me-1"
                                                    type="radio"
                                                    value="{{ $forma_pagamento->label . ' - ' . $subtotal_formatado . ' - ' . $texto_parcelas }}"
                                                    name="forma_pagamento"
                                                    />
                                                @else
                                                <span id="parcelas">
                                                </span>
                                                <input
                                                class="form-check-input me-1"
                                                type="radio"
                                                name="forma_pagamento"
                                                disabled
                                                />
                                                @endif
                                            </div>
                                        </label>
                                    @else
                                        @if($forma_pagamento->id === 1)
                                            @php($subtotal_formatado = 'R$ ' . number_format(round($subtotal), 2, ',', '.'))
                                        @else
                                            @php($subtotal_formatado = 'R$ ' . number_format($subtotal, 2, ',', '.'))
                                        @endif
                                        <label class="list-group-item d-flex justify-content-between align-items-center" id="forma_pagamento_label">
                                            <div class="infos">
                                                <span>{{ $forma_pagamento->label }}</span> |
                                                @if(isset($forma_pagamento->desconto) && $forma_pagamento->desconto->porcentagem > 0)
                                                    <span class="text-success subtotal-produtos-formatado">
                                                        {{ $subtotal_formatado }}
                                                    </span>
                                                @else
                                                    <span class="text-success" id={{ 'subtotal-produtos-desconto-formatado-' . $forma_pagamento->id }}>
                                                        <strong>{{$subtotal_formatado}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="radio-buttons">
                                                <input
                                                class="form-check-input me-1"
                                                type="radio"
                                                value="{{ $forma_pagamento->label . ' - ' . $subtotal_formatado }}"
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
        @else
            @php($subtotal -= $subtotal_produtos_promocao)
            <section class="formas-pagamento">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Selecione a forma de pagamento desejada:</p>
                        <div class="list-group">
                            @php($formas_pagamento = App\Models\Desconto::formas_pagamento())
                            @if(count($formas_pagamento) > 0)
                                @foreach($formas_pagamento as $forma_pagamento)
                                    @if($forma_pagamento->id === 4)
                                        @php($parcelamento = App\Models\Produto::parcelasProduto($subtotal_com_desconto))
                                        <label
                                        class="list-group-item d-flex justify-content-between align-items-center {{!isset($parcelamento) ? 'disabled' : ''}}"
                                        id="forma_pagamento_label"
                                        >
                                            <div class="infos">
                                                <span>{{ $forma_pagamento->label }}</span> |
                                                @if(isset($forma_pagamento->desconto) && $forma_pagamento->desconto->porcentagem > 0)
                                                    <span class="text-warning">
                                                        <del class="subtotal-produtos-formatado">{{ $subtotal_formatado }}</del>
                                                    </span> -
                                                    <span class="text-primary">
                                                        {{ $forma_pagamento->desconto->porcentagem_label }}
                                                    </span> =
                                                    @php(
                                                        $subtotal_com_desconto = $subtotal -
                                                        ($subtotal * ($forma_pagamento->desconto->porcentagem/100)) +
                                                        $subtotal_produtos_promocao
                                                    )
                                                    @php($subtotal_com_desconto_formatado = 'R$ ' . number_format($subtotal_com_desconto, 2, ',', '.'))
                                                    <span class="text-success" id={{ 'subtotal-produtos-desconto-formatado-' . $forma_pagamento->id }}>
                                                        <strong>{{$subtotal_com_desconto_formatado}}</strong>
                                                    </span>
                                                @else
                                                    <span class="text-success" id={{ 'subtotal-produtos-desconto-formatado-' . $forma_pagamento->id }}>
                                                        <strong>{{$subtotal_formatado}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="radio-buttons">
                                                @if(isset($parcelamento))
                                                    @php($parcelamento = (object) $parcelamento)
                                                    @php($texto_parcelas = $parcelamento->parcelas  . 'x de ' . $parcelamento->valor_parcela_formatado)
                                                    <span id="parcelas">
                                                        {{$texto_parcelas}}
                                                    </span>
                                                    <input
                                                    class="form-check-input me-1"
                                                    type="radio"
                                                    value="{{ $forma_pagamento->label . ' - ' . $subtotal_com_desconto_formatado . ' - ' . $texto_parcelas }}"
                                                    name="forma_pagamento"
                                                    />
                                                @else
                                                    <span id="parcelas">
                                                    </span>
                                                    <input
                                                    class="form-check-input me-1"
                                                    type="radio"
                                                    name="forma_pagamento"
                                                    disabled
                                                    />
                                                @endif
                                            </div>
                                        </label>
                                    @else
                                        <label class="list-group-item d-flex justify-content-between align-items-center" id="forma_pagamento_label">
                                            <div class="infos">
                                                <span>{{ $forma_pagamento->label }}</span> |
                                                @if(isset($forma_pagamento->desconto) && $forma_pagamento->desconto->porcentagem > 0)
                                                    <span class="text-warning">
                                                        <del class="subtotal-produtos-formatado">{{ $subtotal_formatado }}</del>
                                                    </span> -
                                                    <span class="text-primary">
                                                        {{ $forma_pagamento->desconto->porcentagem_label }}
                                                    </span> =
                                                    @php(
                                                        $subtotal_com_desconto = $subtotal -
                                                        ($subtotal * ($forma_pagamento->desconto->porcentagem/100)) +
                                                        $subtotal_produtos_promocao
                                                    )
                                                    @if($forma_pagamento->id === 1)
                                                        @php($subtotal_com_desconto_formatado = 'R$ ' . number_format(round($subtotal_com_desconto), 2, ',', '.'))
                                                    @else
                                                        @php($subtotal_com_desconto_formatado = 'R$ ' . number_format($subtotal_com_desconto, 2, ',', '.'))
                                                    @endif
                                                    <span class="text-success" id={{ 'subtotal-produtos-desconto-formatado-' . $forma_pagamento->id }}>
                                                        <strong>{{$subtotal_com_desconto_formatado}}</strong>
                                                    </span>
                                                @else
                                                    <span class="text-success" id={{ 'subtotal-produtos-desconto-formatado-' . $forma_pagamento->id }}>
                                                        <strong>{{$subtotal_formatado}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="radio-buttons">
                                                <input
                                                class="form-check-input me-1"
                                                type="radio"
                                                value="{{ $forma_pagamento->label . ' - ' . $subtotal_com_desconto_formatado }}"
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
        @endif

        <section class="finalizar-pedido">
            <div class="card">
                <div class="card-body">
                    <p class="card-title"><strong>Informações do cliente</strong></p>
                    <div class="row">
                        <div class="col">
                            <div class="form-outline mb-4">
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
                        <div class="col">
                            <div class="form-outline mb-4">
                                <input
                                    type="text"
                                    id="cpf"
                                    name="cpf"
                                    class="form-control"
                                    required
                                />
                                <label class="form-label" for="cpf">Seu cpf <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-outline mb-4">
                                <input
                                    type="text"
                                    id="cep"
                                    name="cep"
                                    class="form-control"
                                    required
                                />
                                <label class="form-label" for="cep">CEP</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline mb-4">
                                <input
                                    type="text"
                                    id="cidade"
                                    name="cidade"
                                    class="form-control"
                                    required
                                />
                                <label class="form-label" for="cidade">Cidade</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-outline mb-4">
                                <input
                                    type="text"
                                    id="logradouro"
                                    name="logradouro"
                                    class="form-control"
                                    required
                                />
                                <label class="form-label" for="logradouro">Logradouro</label>
                            </div>
                        </div>
                        <div class="col col-md-2">
                            <div class="form-outline mb-4">
                                <input
                                    type="text"
                                    id="numero"
                                    name="numero"
                                    class="form-control"
                                    required
                                />
                                <label class="form-label" for="numero">Nº</label>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="form-outline mb-4">
                                <input
                                    type="text"
                                    id="bairro"
                                    name="bairro"
                                    class="form-control"
                                    required
                                />
                                <label class="form-label" for="bairro">Bairro</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-outline mb-4">
                        <input
                            type="text"
                            id="nome_clinica"
                            name="nome_clinica"
                            class="form-control"
                            required
                        />
                        <label class="form-label" for="nome_clinica">Qual o nome da sua clínica?</label>
                    </div>
                </div>
            </div>
        </section>
        <section class="finalizar-pedido">
            <div class="card">
                <div class="card-body text-center">
                    <p class="card-title"><strong>Finalizar orçamento</strong></p>
                    <p>
                        <span>Opção selecionada: </span> <strong id="total"></strong>
                    </p>
                    <div class="row">
                        <div class="col ">
                            <div class="form-check float-end">
                                <input
                                class="form-check-input"
                                type="radio"
                                name="forma_envio"
                                id="forma_envio"
                                value="Entrega"
                                />
                                <label class="form-check-label " for="forma_envio">Entrega</label>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="form-check float-start">
                                <input
                                class="form-check-input"
                                type="radio"
                                name="forma_envio"
                                id="forma_envio"
                                value="Retirada"
                                />
                                <label class="form-check-label" for="forma_envio">Retirada</label>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-danger fade show small" role="alert">
                        <span><strong>Atenção!</strong>
                            Realizamos entregas em compras a partir de R$50,00 com frete grátis.
                            A viabilidade da entrega será confirmada via WhatsApp.
                        </span>
                    </div>
                    <div class="row zap ">
                        <p>
                            <button type="button" class="btn btn-success" onclick="enviarPedidoNoZap()">
                                <i class="fab fa-whatsapp"></i> Enviar
                            </button>
                        </p>
                </div>
            </div>
        </section>
    @else
        @php($formas_pagamento = [])
        @php($parcelamentos = [])
        @php($produtos = [])
    @endif
</div>
@stop
@section('js')
<script>
    let valor_final;
    let produtos;
    let forma_envio;

    function excluirItemCarrinho(produto_id) {
        //let pc = {!! json_encode(session('produtos')) !!};
        //delete pc[`${produto_id}`];
        //document.cookie = `produtos_carrinho=${JSON.stringify(pc)}`;
        //location.reload.bind(location);
    }

    function formatar_valor(valor) {
        return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor);
    }

    $('input[type=radio][name=forma_envio]').change(function() {
        if($(this).is(':checked')) {
            forma_envio = $(this).val();
        }
    });

    function enviarPedidoNoZap() {
        let nome = $('#nome').val();
        let cpf = $('#cpf').val();
        let cep = $('#cep').val();
        let logradouro = $('#logradouro').val();
        let numero_casa = $('#numero').val();
        let bairro = $('#bairro').val();
        let nome_clinica = $('#nome_clinica').val();
        let cidade = $('#cidade').val();

        let produtos_pedido = '*Resumo do pedido*:';
        let titulo_1 = `*Meus dados*`;
        let dados = `
        *Nome*: ${nome}
        *Cpf*: ${cpf}
        *Cep*: ${cep}
        *Endereço*: ${logradouro}, ${numero_casa} - ${bairro}, ${cidade}
        *Nome clínica*: ${nome_clinica}
        *Forma de envio selecionada*: ${forma_envio}
        -----
        `;
        console.log(produtos);
        for(id in produtos) {
            if(id !== 'subtotal') {
                let produto = produtos[id];
                produtos_pedido += `\n*Nome*: ${produto.nome}\n*Quantidade*: ${produto.quantidade}\n*Valor unitário*:${produto.valor}\n*Valor Total*:${produto.valor_total}\n-----\n`;
            }
        }
        // produtos_pedido += produtos.forEach(produto => {
        //     return `\n*Nome*: ${produto.nome}\n*Quantidade*:${produto.quantidade}\n-----`;
        // });
        let numero = '5596999751199';
        let final = `${produtos_pedido}\n*Valor Final*: ${valor_final}\n`;
        let msg = `${titulo_1}${dados}${final}`;
        let alvo = `https://api.whatsapp.com/send?phone=${encodeURIComponent(numero)}&text=${encodeURIComponent(msg)}`

        window.open(alvo);
    }

    $('.quantidade').change(function(e) {
        // let target = e.target.id;
        // let id = parseFloat(target.replace('quantidade-produto-', ''));
        // let quantidade = $(`#${target}`).val();

        // // Alterar valor total do produto [DONE]
        // let valor_total_produto = produtos[id].valor * quantidade;
        // let valor_total_anterior = produtos[id].valor_total;
        // $(`#valor-total-produto-${id}-formatado`).text(formatar_valor(valor_total_produto));

        // // Alterar a quantidade de produto no session('produtos');
        // produtos_carrinho = {!! json_encode(session('produtos')) !!}
        // produtos_carrinho[id] = quantidade;
        // document.cookie = `produtos_carrinho=${JSON.stringify(produtos_carrinho)}`;

        // // // Alterar valor do subtotal
        // let subtotal_anterior = produtos['subtotal'];
        // let valor_subtotal = (subtotal_anterior - valor_total_anterior) + valor_total_produto;

        // $('.subtotal-produtos-formatado').text(formatar_valor(valor_subtotal));
        // // Alterar valor dos preços finais nas formas de pagamentos;
        // let formas_pagamento = {!! json_encode($formas_pagamento) !!} || [];
        // let parcelamentos = {!! json_encode($parcelamentos) !!} || [];
        // let parcelamento_selecionado;
        // if(formas_pagamento.length > 0) {
        //     formas_pagamento.forEach(forma_pagamento => {
        //         let valor_total = valor_subtotal - (valor_subtotal * (forma_pagamento.desconto.porcentagem/100));
        //         $(`#subtotal-produtos-desconto-formatado-${forma_pagamento.id}`).text(formatar_valor(valor_total));
        //         if(forma_pagamento.id == 4) {
        //             // Tratar parcelamento
        //             if(parcelamentos.length > 0) {
        //                 parcelamentos.find(parcelamento => {
        //                     if(!parcelamento_selecionado) {
        //                         if(valor_subtotal > parcelamento.valor_minimo) {
        //                             parcelamento_selecionado = parcelamento;
        //                         }
        //                     }
        //                 });
        //             }

        //             if(parcelamento_selecionado) {
        //                 let valor_parcela = valor_total / parcelamento_selecionado.parcelas;
        //                 $('#parcelas').text(`${parcelamento_selecionado.parcelas}x de ${formatar_valor(valor_parcela)}`);
        //             } else {
        //                 $('#parcelas').text('');
        //             }
        //         }
        //     });
        // }

        // // Definir novos valores
        // produtos[id].valor_total = valor_total_produto;
        // produtos['subtotal'] = valor_subtotal;
        // parcelamento_selecionado = null;
    });

    $('input[type=radio][name=forma_pagamento]').change(function() {
        if($(this).is(':checked')) {
            valor_final = $(this).val();
            console.log(valor_final);
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
