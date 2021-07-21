
<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>
<!---- SweetAlert2  --->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.js"></script>
<!---- Select2 ---->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!---- JQUERY MASK ---->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
    let spinnerHTML = `
        <div class="spinner-border text-success" role="status">
            <span class="sr-only">Salvando...</span>
        </div>
    `;

    let successIcon = `
        <i class="fas fa-check"></i>
    `;

    function enviarFormulario(method, url, form_id=null) {
        if (method === 'delete') {
            $.ajax({
                method: method,
                data: {'_token':  "{{ csrf_token() }}" },
                url: url,
                success: function (data) {
                    setTimeout(location.reload.bind(location), 1000);
                    return 1;
                },
                error: function(data) {
                    return 0;
                }
            });
        } else {
            let form = `#${form_id}`;
            $(form).submit(e => {
                // ADICIONAR SPINNER
                $('#submit').html(spinnerHTML);
                $('#submit').attr('disabled', 'disabled');

                e.preventDefault();
                let entries = $(form).serializeArray();
                let formFields = [];
                for(const entry of entries) {
                    formFields.push(entry.name);
                }

                $.ajax({
                    method: method,
                    url: url,
                    data: $(form).serialize(),
                    success: function (data) {
                        $('#submit').html(successIcon);
                        if(method == 'post') {
                            localStorage.setItem('item-criado', true);
                        } else if(method == 'put') {
                            localStorage.setItem('item-alterado', true);
                        }

                        setTimeout(location.reload.bind(location), 1000);
                    },
                    error: function(data) {
                        $('#submit').html('Salvar');
                        $('#submit').removeAttr('disabled');

                        data = data.responseJSON;

                        console.log(data);
                        $(':input').removeClass('is-invalid');
                        $(':input').addClass('is-valid');

                        if(data) {
                            $(':input').addClass('is-valid');
                            for (const [key, value] of Object.entries(data)) {
                                if(formFields.includes(key)) {
                                    $(`#${key}`).addClass('is-invalid');
                                    $(`#${key}-feedback`).text(`${value}`);
                                }
                            }
                        }
                    }
                });
            });
        }
    }

    function excluirItem(url, item) {
        Swal.fire({
            icon: 'warning',
            title: 'Excluir',
            text: `Você realmente deseja excluir: ${item.nome}?`,
            confirmButtonText: `Sim!`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'DELETE',
                    data: {'_token':  "{{ csrf_token() }}" },
                    url: `${url}/${item.id}`,
                    success: function (data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Item excluído!',
                            showConfirmButton: false,
                        });
                        setTimeout(location.reload.bind(location), 1000);
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

    $(function() {
        $('.alert-success').hide();
        $('.alert-warning').hide();

    });
</script>
@yield('js')
