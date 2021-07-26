@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Alterar - {{$produto->nome}}</h3>
        <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data" id="produto-form">
            @method('PUT')
            @csrf
            <div class="form-group mb-4">
                <div class="row row-images preview">
                    @if(isset($produto->imagens))
                        @foreach($produto->imagens as $imagem)
                        <div class="text-center">
                            <img
                            src="{{ asset('produtos-imagens/' . $imagem) }}"
                            alt="Imagem produto {{ $produto->nome }}"
                            style="max-width: 100px;max-height: 100px;"
                        />
                        </div>
                        @endforeach
                    @endif
                    @for($i=0 ; $i <= (4 - count($produto->imagens)) ; $i++)
                        <i class="far fa-image fa-5x image-{{$i}}"></i>
                    @endfor
                </div>
                <div class="row row-images">
                    @if(isset($produto->imagens))
                        @foreach($produto->imagens as $imagem)
                        <div class="text-center">
                            <button
                                type="button"
                                class="btn btn-danger btn-sm btn-floating"
                                onclick="excluirImagem('/imagens-produtos', '{{$produto->id}}', '{{$imagem}}')"
                            >
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                        @endforeach
                    @endif
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
                    value="{{$produto->nome}}"
                    class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}"
                />
                <label class="form-label" for="nome">Nome</label>

                @if ($errors->has('nome'))
                    <div class="invalid-feedback">{{$errors->first('nome')}}</div>
                @endif
            </div>


            <div class="form-outline mb-4">
                <textarea
                    id="descricao"
                    name="descricao"
                    class="form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}"
                    cols="30"
                    rows="10"
                >{{$produto->descricao}}</textarea>
                <label class="form-label" for="descricao">Descrição</label>

                @if ($errors->has('descricao'))
                    <div class="invalid-feedback">{{$errors->first('descricao')}}</div>
                @endif
            </div>

            <div class="form-outline {{$errors->has('valor') ? 'mb-5' : 'mb-4'}}">
                <input
                    type="text"
                    id="valor"
                    name="valor"
                    value="{{$produto->valor}}"
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

                >
                    <option value="" disabled selected>Selecione a qual subcategoria pertenço...</option>
                </select>
                @if ($errors->has('subcategoria_id'))
                    <div class="invalid-feedback">{{$errors->first('subcategoria_id')}}</div>
                @endif
            </div>

            <section>
                <h5>Opções</h5>
                <div class="form-check form-switch mb-4">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="disponibilidade"
                        name="disponibilidade"
                        value="1"
                        {{($produto->disponibilidade) ? 'checked' : ''}}
                    />
                    <label class="form-check-label" for="disponibilidade">
                        Disponível
                    </label>
                </div>

                <div class="form-check form-switch mb-4">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="relevante"
                        name="relevante"
                        value="1"
                        {{($produto->relevante) ? 'checked' : ''}}
                    />
                    <label class="form-check-label" for="relevante" name="relevante">
                        Relevante
                    </label>
                </div>

                <div class="form-check form-switch mb-4">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="possui-desconto"
                        name="possui-desconto"
                        {{isset($produto->desconto) ? 'checked' : ''}}
                    />
                    <label class="form-check-label" for="possui-desconto">
                        Desconto (Individual)
                    </label>
                </div>
                <div class="form-outline mb-4">
                    <input
                        type="text"
                        id="desconto"
                        name="desconto"
                        value="{{$produto->desconto}}"
                        class="form-control numero"
                        {{is_null($produto->desconto) ? 'disabled' : ''}}
                    />
                    <label class="form-label" for="desconto">Porcentagem (%)</label>
                </div>
            </section>
            <section>
                <p>
                    <strong>
                        Valor final:
                        <span class="valor-final" id="valor-final">
                            {{$produto->valor ? 'R$ ' . number_format($produto->valor, 2, ',', '.') : "R$ 00,00"}}
                        </span>
                    </strong>
                </p>
            </section>

            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
        <input type="hidden" id="produto" value="{{$produto}}">
    </div>
@stop

@section('js')
<script>
    let produto = JSON.parse($('#produto').val());

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

    function excluirImagem(url, produto_id, nome_imagem) {
        Swal.fire({
            icon: 'warning',
            title: 'Excluir',
            text: `Você realmente deseja essa imagem?`,
            confirmButtonText: `Sim!`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'DELETE',
                    data: {'_token':  "{{ csrf_token() }}" },
                    url: `${url}/${produto_id}/${nome_imagem}`,
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Item excluído!',
                            showConfirmButton: false,
                        });
                        console.log(data);
                        return 1;
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Item não excluído!',
                            showConfirmButton: false,
                        });
                        return 0;
                    }
                });
            }
        });
    }
    // On change
    $('#imagens').change(function(){
        let quantidade_disponivel = 5 - {!! count($produto->imagens) !!};
        if(this.files.length > 0 && this.files.length <= quantidade_disponivel) {
            $('.not-uploaded').remove();
            for(let i=0; i<this.files.length; i++) {
                let file = this.files[i];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event){
                        $(`.image-${i}`).remove();
                        $('.preview').append(`
                            <img src="${event.target.result}" alt="pic" style="max-width:100px;max-height: 100px;" class="not-uploaded"/>
                        `);
                    }
                    reader.readAsDataURL(file);
                }
            }
        } else {
            $('#imagens').val(null);
            for(let i=0; i<quantidade_disponivel; i++) {
                $('.not-uploaded').remove();
                $(`.image-${i}`).remove();
                $('.preview').append(`<i class="far fa-image fa-5x image-${i}"></i>`);
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
                            if(element.id === produto.subcategoria_id) {
                                $('#subcategoria_id').append(`
                                    <option value="${element.id}" selected>${element.text}</option>
                                `);
                            } else {
                                $('#subcategoria_id').append(`
                                    <option value="${element.id}">${element.text}</option>
                                `);
                            }
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        } else {
            $('#subcategoria_id').attr('disabled', 'disabled');
        }
    });

    $(function() {
        console.log(produto);
        $('#categoria_id').select2({});
        $('#subcategoria_id').select2({});

        $('#categoria_id').val(produto.categoria_id).change();
    });
</script>
@stop
