@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Nova <strong>empresa parceira</strong></h3>
        <form action="{{ route('empresas_parceiras.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4">
                <div class="row row-image">
                    <div class="col-auto logo-image">
                        <i class="far fa-image fa-5x"></i>
                    </div>
                    <div class="col">
                        <label class="form-label" for="imagem">Logo</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" />
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
                <input type="text" id="site" name="site" class="form-control" />
                <label class="form-label" for="site">Site</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
    </div>
@stop

@section('js')
<script>
    $('#imagem').change(function(){
        $('.logo-image').html("");
        if(this.files.length > 0 && this.files.length <= 1) {
            for(let i=0; i<this.files.length; i++) {
                let file = this.files[i];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event){
                        $('.logo-image').append(`<img src="${event.target.result}" alt="pic" style="max-width:80px;max-height: 80px;"/>`);
                    }
                    reader.readAsDataURL(file);

                }
            }
        } else {
            $('#imagem').val(null);
            $('.logo-image').append(`<i class="far fa-image fa-5x"></i>`);

        }
    });
</script>
@stop
