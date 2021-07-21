@extends('layouts.app')

@section('css')
    <style>
        .btn-parcelamentos {
            /* padding: 0; */
            /* margin: 0; */
            text-align: left;
        }
    </style>
@stop

@section('content')
    <div class="container dark-grey-text mt-5">
        <div class="row wow fadeIn">
            <div class="col-md-6 mb-4">
                <div
                    id="produtoImagens"
                    class="carousel slide carousel-fade carousel-dark"
                    data-mdb-ride="carousel"
                >
                <div class="carousel-indicators">
                    @if(count($produto->imagens) > 0)
                        @php($first = false)
                        @php($i=1)
                        @php($j=0)
                        @foreach($produto->imagens as $imagem)
                            @if($first === false)
                                <button
                                    type="button"
                                    class="active"
                                    aria-current="true"
                                    data-mdb-target="#produtoImagens"
                                    data-mdb-slide-to="{{$j}}"
                                    aria-label="Slide {{$i}}"
                                ></button>
                                @php($first = true)
                            @else
                                <button
                                    type="button"
                                    data-mdb-target="#produtoImagens"
                                    data-mdb-slide-to="{{$j}}"
                                    aria-label="Slide {{$i}}"
                                ></button>
                            @endif
                            @php($i++)
                            @php($j++)
                        @endforeach
                    @else
                    @endif
                </div>
                    <div class="carousel-inner">
                        @if(count($produto->imagens) > 0)
                            @php($first = false)
                            @foreach($produto->imagens as $imagem)
                                @if($first === false)
                                    <div class="carousel-item active">
                                        <div class="d-flex justify-content-center">
                                            <img
                                                src="{{ asset('produtos-imagens/' . $imagem) }}"
                                                class="img-fluid"
                                                alt="..."
                                                style="height: 400px; width: 400px"
                                            />
                                        </div>
                                    </div>
                                    @php($first = true)
                                @else
                                    <div class="carousel-item">
                                        <div class="d-flex justify-content-center">
                                            <img
                                                src="{{ asset('produtos-imagens/' . $imagem) }}"
                                                class="img-fluid"
                                                style="height: 400px; width: 400px"
                                                alt="..."
                                            />
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                        @endif
                    </div>
                <button
                  class="carousel-control-prev"
                  type="button"
                  data-mdb-target="#produtoImagens"
                  data-mdb-slide="prev"
                >
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button
                  class="carousel-control-next"
                  type="button"
                  data-mdb-target="#produtoImagens"
                  data-mdb-slide="next"
                >
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-4">
                <h5>{{$produto->nome}}</h5>
                    <div class="mb-3">
                        @if(isset($produto->subcategoria->categoria))
                            <span class="badge bg-secondary">{{ $produto->subcategoria->categoria->nome }}</span>
                        @endif
                        @if(isset($produto->subcategoria))
                            <span class="badge bg-info">{{ $produto->subcategoria->nome }}</span>
                        @endif
                        @if($produto->relevante === true)
                            <span class="badge bg-danger">relevante</span>
                        @endif
                    </div>
                    <p class="lead">
                        @if($produto->desconto > 0)
                            <span class="text-warning">
                                <del>{{ $produto->valor_formatado }}</del>
                            </span>
                            <span class="text-success">{{ $produto->valor_com_desconto_formatado }}</span>
                        @else
                            <span class="text-success">{{ $produto->valor_formatado }}</span>
                        @endif
                    </p>

                    @include('components.formas_pagamento', [
                        'produto' => $produto
                    ])

                    <form class="d-flex justify-content-left" action="{{ route('carrinho.adicionar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="produto_id" id="produto_id" value={{ $produto->id }}>
                        <input
                            type="number"
                            aria-label="Qtd"
                            class="form-control"
                            style="width: 100px"
                            id="quantidade"
                            name="quantidade"
                            min="1"
                            value="1"
                        >
                        <button class="btn btn-primary btn-md my-0 p" type="submit">
                            Adicionar ao <i class="fas fa-shopping-cart ml-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="row d-flex justify-content-center wow fadeIn">
            <div class="col-md-6 text-center">
            <h4 class="my-4 h4">Informação adicional</h4>
            {!! nl2br($produto->descricao) !!}
            </div>
        </div>
        <br><br>
    </div>
@stop

@section('js')
    <script>
        // parcelamentos
        function exibirParcelas() {
            $('#parcelamentos').modal('show');
        }
    </script>
@stop
