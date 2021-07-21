<div class="forma-pagamento">
    <p class="font-weight-bold forma-pagamento-title">Formas de pagamento</p>

    <ul class="list-group list-group-flush forma-pagamento-list">
        @php($formas_pagamento = App\Models\Desconto::formas_pagamento())
        @foreach($formas_pagamento as $forma_pagamento)
            @if(isset($produto->desconto))
                @if($forma_pagamento->id === 4)
                    @php($valor_produto_parcelado = $produto->valor_com_desconto)
                    @if(App\Models\Produto::possuiParcelamento($produto->valor))
                        <button class="btn-parcelamentos list-group-item" onclick="exibirParcelas()">
                            {{ $forma_pagamento->label }} - <i class="far fa-eye"></i> -
                            <strong>{{$produto->valor_com_desconto_formatado}}</strong>
                        </button>
                    @else
                        <button class="btn-parcelamentos list-group-item" disabled>
                            <del>{{ $forma_pagamento->label }} -
                            <strong>{{$produto->valor_com_desconto_formatado}}</strong></del>
                        </button>
                    @endif
                @else
                    <li class="list-group-item">{{$forma_pagamento->label}} -
                        <strong>{{$produto->valor_com_desconto_formatado}}</strong>
                    </li>
                @endif
            @else
                @if($forma_pagamento->id === 4)
                    @if(App\Models\Produto::possuiParcelamento($produto->valor))
                        @if(isset($forma_pagamento->desconto))
                            @php($valor = $produto->valor - ($produto->valor * ($forma_pagamento->desconto->porcentagem/100)))
                            @php($valor_produto_parcelado = $produto->valor - ($produto->valor * ($forma_pagamento->desconto->porcentagem/100)))
                            <button class="btn-parcelamentos list-group-item" onclick="exibirParcelas()">
                                {{ $forma_pagamento->label }} - <i class="far fa-eye"></i> -
                                <strong>{{'R$ ' . number_format($valor, 2, ',', '.')}}</strong>
                            </button>
                        @else
                            <button class="btn-parcelamentos list-group-item" disabled>
                                {{ $forma_pagamento->label }} - <i class="far fa-eye"></i> -
                                <strong>{{$produto->valor_formatado}}</strong>
                            </button>
                        @endif
                    @else
                        <button class="btn-parcelamentos list-group-item">
                            <del>{{ $forma_pagamento->label }} -
                            <strong>{{$produto->valor_formatado}}</strong></del>
                        </button>
                    @endif
                @else
                    <li class="list-group-item">{{ $forma_pagamento->label }} -
                    @if(isset($forma_pagamento->desconto))
                        @php($valor = $produto->valor - ($produto->valor * ($forma_pagamento->desconto->porcentagem/100)))
                        <strong>{{'R$ ' . number_format($valor, 2, ',', '.')}}</strong>
                    @else
                        <strong>{{'R$ ' . number_format($produto->valor, 2, ',', '.')}}</strong>
                    @endif
                    </li>
                @endif
            @endif
        @endforeach
      </ul>
</div>


<!-- Modal Parcelamentos -->
<div
class="modal fade "
id="parcelamentos"
tabindex="-1"
aria-labelledby="parcelamentosLabel"
aria-hidden="true"
>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="parcelamentosLabel">Parcelamento</h5>
            <button
            type="button"
            class="btn-close"
            data-mdb-dismiss="modal"
            aria-label="Close"
            ></button>
        </div>
        <div class="modal-body">
            @include('partials.parcelas', ['valor_parcelado' => $valor_produto_parcelado])
        </div>
    </div>
</div>
</div>



