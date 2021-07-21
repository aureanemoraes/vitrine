@php($parcelamento = App\Models\Produto::parcelasProduto($valor_parcelado))
@if(isset($parcelamento))
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Parcela</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @php($parcelamento = (object) $parcelamento)
            @for($i=1 ; $i<=$parcelamento->parcelas ; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $parcelamento->valor_parcela_formatado }}</td>
                </tr>
            @endfor
        </tbody>
        <tfoot>
            <tr>
                <td colspan="100%">
                    <strong>Total: </strong> {{ $parcelamento->valor_total_formatado }}
                </td>
            </tr>
        </tfoot>
    </table>
@endif

