<style>
    .tableFixHead          { overflow-y: auto; height: 400px; }
    .tableFixHead thead th { position: sticky; top: 0; }

    /* Just common table stuff. Really. */
    .tableFixHead table  { border-collapse: collapse; width: 100%; }
    .tableFixHead th, td { padding: 8px 16px; }
    .tableFixHead th     { background: #428bca; }
</style>

<div class="table-responsive tableFixHead">
    <table id="order-detail-table" class="table table-condensed table-hovered table-bordered">
        <thead class="bg-primary">
        <tr>
            <th class="text-center" colspan="5">Itens do pedido #{{ $order->id }}</th>
        </tr>
        <tr>
            <th>Cód. e Descrição</th>
            <th>Preço</th>
            <th>Qtd</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody style="height:300px;overflow-y: auto">
        @foreach($order->items as $item)
            <tr>
                <td width="30%">{{ $item->product->name }}</td>
                <td width="10%">{{ $item->product->price }}</td>
                <td width="10%">{{ $item->quantity }}</td>
                <td width="10%">R$ {{ number_format($item->quantity * $item->product->price, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot class="bg-primary">
            <tr>
                <td colspan="3"></td>
                <td><b>R$ {{ number_format($total, 2, ',', '.') }}</b></td>
            </tr>
        </tfoot>
    </table>
</div>
