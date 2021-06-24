/<!-- Modal -->
<div
class="modal fade"
id="{{$id}}"
tabindex="-1"
aria-labelledby="{{ $label }}"
aria-hidden="true"
>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="{{ $label }}">{{ $title }}</h5>
            <button
            type="button"
            class="btn-close"
            data-mdb-dismiss="modal"
            aria-label="Close"
            ></button>
        </div>
        <form id="{{ $form_id }}">
            @csrf
            <div class="modal-body">
                <div class="form-outline mb-4">
                    <input type="text" id="nome" name="nome" class="form-control" />
                    <label class="form-label" for="nome">Nome</label>
                </div>

                <div class="form-outline mb-4">
                    <input type="number" id="parcelas" name="parcelas" class="form-control" />
                    <label class="form-label" for="parcelas">Parcelas</label>
                </div>

                <div class="form-outline mb-4">
                    <i class="fas fa-coins trailing"></i>
                    <input type="number" id="valor_minimo" name="valor_minimo" class="form-control form-icon-trailing" />
                    <label class="form-label" for="valor_minimo">Valor <strong>(R$)</strong></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                    Fechar
                </button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
</div>


