@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app-without-filter.css') }}"/>
@endsection

@section('content')
    <div class="container">
        <h3>Novo produto</h3>
        <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data" id="produto-form">
            @csrf
            <div class="form-group mb-4">
                <div class="row row-images">
                    @for($i=0 ; $i <= 4 ; $i++)
                        <i class="far fa-image fa-5x image-{{$i}}"></i>
                    @endfor
                </div>
                <div class="row">
                    <label class="form-label" for="imagens">Imagens</label>
                    <input
                        type="file"
                        class="form-control {{$errors->has('imagens') ? 'is-invalid' : ''}}"
                        id="imagens"
                        name="imagens[]"
                        multiple
                    />
                </div>
                @if ($errors->has('imagens'))
                    <div class="invalid-feedback">{{$errors->first('imagens')}}</div>
                @endif
            </div>

            <div class="form-outline {{$errors->has('nome') ? 'mb-5' : 'mb-4'}}">
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}"
                    value="{{old('nome')}}"
                />
                <label class="form-label" for="nome">Nome</label>

                @if ($errors->has('nome'))
                    <div class="invalid-feedback">{{$errors->first('nome')}}</div>
                @endif
            </div>


            <div class="form-group mb-4">
                <textarea
                    id="descricao"
                    name="descricao"
                    class="ckeditor form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}"
                    cols="30"
                    rows="10"
                >{{old('descricao')}}</textarea>

                @if ($errors->has('descricao'))
                    <div class="invalid-feedback">{{$errors->first('descricao')}}</div>
                @endif
            </div>

            <div class="form-outline {{$errors->has('valor') ? 'mb-5' : 'mb-4'}}">
                <input
                    type="text"
                    id="valor"
                    name="valor"
                    value="{{old('valor')}}"
                    class="form-control numero {{$errors->has('valor') ? 'is-invalid' : ''}}"
                />
                <label class="form-label" for="valor">Preço (R$)</label>
                @if ($errors->has('valor'))
                    <div class="invalid-feedback">{{$errors->first('valor')}}</div>
                @endif
            </div>

            <div class="mb-4">
                <select
                    class="form-select {{$errors->has('categoria_id') ? 'is-invalid' : ''}}"
                    aria-label="Default select example"
                    name="categoria_id"
                    id="categoria_id"
                >
                    <option value="" disabled selected>Selecione a qual categoria pertenço...</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                        @endforeach
                </select>
                @if ($errors->has('categoria_id'))
                    <div class="invalid-feedback">{{$errors->first('categoria_id')}}</div>
                @endif
            </div>

            <div class="mb-4">
                <select
                    class="form-select {{$errors->has('subcategoria_id') ? 'is-invalid' : ''}}"
                    aria-label="Default select example"
                    name="subcategoria_id"
                    id="subcategoria_id"
                    disabled
                >
                    <option value="" disabled selected>Selecione a qual subcategoria pertenço...</option>
                </select>
                @if ($errors->has('subcategoria_id'))
                    <div class="invalid-feedback">{{$errors->first('subcategoria_id')}}</div>
                @endif
            </div>

            <div class="mb-4">
                <select
                    class="form-select {{$errors->has('subcategoria_id') ? 'is-invalid' : ''}}"
                    aria-label="Default select example"
                    name="subcategoria_id"
                    id="subcategoria_id"
                    disabled
                >
                    <option value="" disabled selected>Selecione a qual subcategoria pertenço...</option>
                </select>
                @if ($errors->has('subcategoria_id'))
                    <div class="invalid-feedback">{{$errors->first('subcategoria_id')}}</div>
                @endif
            </div>

            <div class="mb-4">
                <select
                    class="form-select {{$errors->has('empresa_parceira_id') ? 'is-invalid' : ''}}"
                    aria-label="Empresa parceira"
                    name="empresa_parceira_id"
                    id="empresa_parceira_id"

                >
                    <option value="" disabled selected>Selecione a qual empresa parceira pertenço...</option>
                    @foreach($empresas_parceiras as $empresa_parceira)
                        <option value="{{$empresa_parceira->id}}">{{$empresa_parceira->nome}}</option>
                    @endforeach
                </select>
                @if ($errors->has('empresa_parceira_id'))
                    <div class="invalid-feedback">{{$errors->first('empresa_parceira_id')}}</div>
                @endif
            </div>

            <section>
                <h5>Opções</h5>
                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="disponibilidade" name="disponibilidade" value="1" checked />
                    <label class="form-check-label" for="disponibilidade" name="disponibilidade">
                        Disponível
                    </label>
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="relevante" name="relevante" value="1"/>
                    <label class="form-check-label" for="relevante" name="relevante">
                        Relevante
                    </label>
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="possui-desconto" name="possui-desconto" />
                    <label class="form-check-label" for="possui-desconto">
                        Desconto (Individual)
                    </label>
                </div>
                <div class="form-outline mb-4">
                    <input type="text" id="desconto" name="desconto" class="form-control numero" value="{{old('desconto')}}" disabled/>
                    <label class="form-label" for="desconto">Porcentagem (%)</label>
                </div>
            </section>
            <section>
                <p>
                    <strong>Valor final: <span class="valor-final" id="valor-final">R$ 00,00</span></strong>
                </p>
            </section>

            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    </div>
@stop

@section('js')
<script>
    ClassicEditor
        .create( document.querySelector( '.ckeditor' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'table'],
        } )
        .catch( error => {
            console.error( error );
        } );

    // Funções
    function calcularDesconto(preco_atual, porcentagem_desconto, exibir_preco_id) {
        let porcentagem = porcentagem_desconto / 100;
        let desconto = preco_atual * porcentagem;
        let novo_preco = preco_atual - desconto;

        $(exibir_preco_id).text(new Intl.NumberFormat(
            'pt-BR',
            { style: 'currency', currency: 'BRL' }).format(novo_preco)
        );
    }
    // On change
    $('#imagens').change(function(){
        if(this.files.length > 0 && this.files.length <= 5) {
            for(let i=0; i<this.files.length; i++) {
                let file = this.files[i];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event){
                        $(`.image-${i}`).remove();
                        $('.row-images').append(`
                            <img src="${event.target.result}" alt="pic" style="max-width:100px;max-height: 100px;"/>
                        `);
                    }
                    reader.readAsDataURL(file);
                }
            }
        } else {
            $('#imagens').val(null);
            $('.row-images').empty();

            for(let i=0; i<5; i++) {
                $('.row-images').append(`<i class="far fa-image fa-5x image-${i}"></i>`);
            }
        }
    });

    $('#valor').change(function() {
        let valor = $('#valor').val();
        if(valor) {
            if(desconto) {
                calcularDesconto($('#valor').val(), $('#desconto').val(), '#valor-final');
            } else {
                $('#valor-final').text(new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor));
            }
        } else {
            $('#valor-final').text('R$ 00,00');
        }
    });

    $('#possui-desconto').change(function() {
        if($('#possui-desconto:checkbox:checked').length > 0) {
            $('#desconto').removeAttr('disabled');
            let desconto = $('#desconto').val();
            if(desconto) {
                calcularDesconto($('#valor').val(), $('#desconto').val(), '#valor-final');
            }
        } else {
            let valor = $('#valor').val();
            if(valor) {
                $('#valor-final').text(new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(valor));
            }
            $('#desconto').attr('disabled', 'disabled');
        }
    });

    $('#desconto').change(function() {
        calcularDesconto($('#valor').val(), $('#desconto').val(), '#valor-final');
    });

    $('#categoria_id').change(function() {
        let categoria_id = $('#categoria_id').val();
        $('#subcategoria_id').empty();

        if(categoria_id) {
            $('#subcategoria_id').removeAttr('disabled');

            $.ajax({
                headers: {'_token':  "{{ csrf_token() }}" },
                method: 'GET',
                url: `/subcategorias/find/${categoria_id}`,
                success: function (data) {
                    if(data) {
                        data.data.forEach(element => {
                            $('#subcategoria_id').append(`
                                <option value="${element.id}">${element.text}</option>
                            `);
                        });
                    }
                },
                error: function(data) {
                }
            });
        } else {
            $('#subcategoria_id').attr('disabled', 'disabled');
        }
    });

    $(function() {
        $('#categoria_id').select2({});
        $('#subcategoria_id').select2({});
        $('#empresa_parceira_id').select2({});
    })
</script>
@stop
