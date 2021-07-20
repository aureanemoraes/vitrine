<div class="forma-pagamento">
    <p class="font-weight-bold forma-pagamento-title">Formas de pagamento</p>

    <ul class="list-group list-group-flush forma-pagamento-list">
        @php($formas_pagamento = App\Models\Desconto::formas_pagamento())
        @foreach($formas_pagamento as $forma_pagamento)
            @if(isset($produto->desconto))
                @if($forma_pagamento->id === 4)
                    @if(App\Models\Produto::possuiParcelamento($produto->valor))
                        <a href="#" class="list-group-item">
                            {{ $forma_pagamento->label }} - <i class="far fa-eye"></i> -
                            <strong>{{$produto->valor_com_desconto_formatado}}</strong>
                        </a>
                    @else
                        <a class="list-group-item">
                            <del>{{ $forma_pagamento->label }} -
                            <strong>{{$produto->valor_com_desconto_formatado}}</strong></del>
                        </a>
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
                            <a href="#" class="list-group-item">
                                {{ $forma_pagamento->label }} - <i class="far fa-eye"></i> -
                                <strong>{{'R$ ' . number_format($valor, 2, ',', '.')}}</strong>
                            </a>
                        @else
                            <a href="#" class="list-group-item">
                                {{ $forma_pagamento->label }} - <i class="far fa-eye"></i> -
                                <strong>{{$produto->valor_formatado}}</strong>
                            </a>
                        @endif
                    @else
                        <a class="list-group-item">
                            <del>{{ $forma_pagamento->label }} -
                            <strong>{{$produto->valor_formatado}}</strong></del>
                        </a>
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
