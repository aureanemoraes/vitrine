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
                    <div class="invalid-feedback" id="nome-feedback"></div>
                </div>

                <div class="mb-4">
                    <select class="form-select" aria-label="Forma de pagamento" name="forma_pagamento" id="forma_pagamento">
                        <option value="" disabled selected>Selecione a forma de pagamento...</option>
                            <option value="1">Dinheiro</option>
                            <option value="2">Débito</option>
                            <option value="3">Crédito</option>
                            <option value="4">Crédito parcelado</option>
                            <option value="5">Transferência bancaria</option>
                            <option value="6">Pix</option>
                    </select>
                    <div class="invalid-feedback" id="forma_pagamento-feedback"></div>
                </div>

                <div class="form-outline mb-4">
                    <i class="fas fa-percent trailing"></i>
                    <input type="number" id="porcentagem" name="porcentagem" class="form-control form-icon-trailing" />
                    <label class="form-label" for="porcentagem">Desconto</label>
                    <div class="invalid-feedback" id="porcentagem-feedback"></div>
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


