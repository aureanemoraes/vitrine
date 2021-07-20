@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app-with-filter.css') }}"/>
@endsection

@section('filtros')
    @include('components.filtros')
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('produtos.index') }}">Produtos</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
           Promoções
        </li>
    </ol>
</nav>
@stop

@section('css')
@endsection

@section('content')
<main>
    <div class="container">
        <section class="text-center mb-4">
            <div class="d-flex justify-content-center">
                <a href="{{ route('produtos.create') }}" type="button" class="btn btn-success">Novo produto</a>
            </div>

            @php($counter = 1)
            @foreach($produtos as $produto)
                @if($counter === 1)
                    <div class="row wow fadeIn">
                @endif
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card">
                        <div class="view overlay produto-imagem">
                            <img
                                src="{{asset('produtos-imagens/' . $produto->imagens[0])}}"
                                class="card-img-top"
                                alt=""
                            >
                            <a href="{{route('produtos.show', $produto->id)}}">
                            <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <a href="" class="grey-text">
                            <h5>{{$produto->subcategoria->nome}}</h5>
                            </a>
                            <h5>
                            <strong>
                                <a class="dark-grey-text">
                                    {{$produto->nome}}
                                </a>
                            </strong>
                            </h5>

                            <p>
                                @if($produto->desconto > 0)
                                    <span class="text-warning valor-sem-desconto">
                                        <del>{{ $produto->valor_formatado }}</del>
                                    </span>
                                    <h4 class="text-success valor-com-desconto">
                                        <strong>{{$produto->valor_com_desconto_formatado}}</strong>
                                    </h4>
                                @else
                                    <span class="text-warning valor-sem-desconto">
                                    </span>
                                    <h4 class="blue-text">
                                        <strong>{{$produto->valor_formatado}}</strong>
                                    </h4>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="card-footer">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a
                        type="button"
                        href="{{ route('produtos.edit', $produto->id) }}"
                        class="btn btn-warning"
                        title="Alterar"
                        >
                        <i class="far fa-edit"></i>
                        </a>
                        <button
                            type="button"
                            class="btn btn-danger"
                            title="Excluir"
                            onclick="excluirItem('/produtos',{{$produto}})"
                        >
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                    </div>
                </div>
                @if($counter === 4)
                    </div>
                @endif
                @php($counter < 5 ? $counter = $counter + 1 : $counter = 1)
            @endforeach
        </section>

      <!--Pagination-->
        @include('components.pagination', [
            'anterior' => $produtos->previousPageUrl(),
            'atual' => url()->current(),
            'proxima' => $produtos->nextPageUrl(),
            'pagina_atual' => $produtos->currentPage()
        ])
    </div>
</main>
  <!--Main layout-->
@stop
