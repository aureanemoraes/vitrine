@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <div class="row row-image">
                    <div class="col">
                        <i class="far fa-image"></i>
                    </div>
                    <div class="col">
                        <label class="form-label" for="imagem">Imagens</label>
                        <input type="file" class="form-control" id="imagem" name="imagem[]" multiple />
                    </div>
                </div>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="nome" name="nome" class="form-control" />
                <label class="form-label" for="nome">Nome</label>
            </div>

            <div class="form-outline mb-4">
                <textarea id="descricao" name="descricao" class="form-control" cols="30" rows="10"></textarea>
                <label class="form-label" for="descricao">Descrição</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="desconto" name="desconto" class="form-control"/>
                <label class="form-label" for="desconto">Preço (R$)</label>
            </div>

            <section>
                <h5>Descontos</h5>
                @foreach($descontos as $desconto)
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="descontos" name="descontos[]" checked />
                        <label class="form-check-label" for="descontos" name="descontos">
                            {{$desconto->nome}} ({{$desconto->porcentagem}}%)
                        </label>
                    </div>
                @endforeach
            </section>

            <section>
                <h5>Opções</h5>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="disponibilidade" name="disponibilidade" checked />
                    <label class="form-check-label" for="disponibilidade" name="disponibilidade">
                        Disponível
                    </label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="relevante" name="relevante" />
                    <label class="form-check-label" for="relevante" name="relevante">
                        Relevante
                    </label>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="possui-desconto" name="possui-desconto" />
                            <label class="form-check-label" for="possui-desconto">
                                Desconto (Individual)
                            </label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-outline mb-4">
                            <input type="text" id="desconto" name="desconto" class="form-control" disabled/>
                            <label class="form-label" for="desconto">Porcentagem (%)</label>
                        </div>
                    </div>
                </div>
            </section>

            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    </div>
@stop
