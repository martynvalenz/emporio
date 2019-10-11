<table>
    <thead>
    <tr>
        <th>Tipo</th>
        <th>Fecha</th>
        <th>Forma de Pago</th>
        <th>Cuenta</th>
        <th>Cliente</th>
        <th>Proveedor</th>
        <th>Cheque</th>
        <th>Subtotal</th>
        <th>IVA</th>
        <th>Total</th>
        <th>Depósito</th>
        <th>Retiro</th>
        <th>Estatus</th>
        <th>Usuario</th>
        <th>Cancelado?</th>
    </tr>
    </thead>
    <tbody>
    @foreach($estados_cuenta as $estado)
        <tr>
            <td>{{ $estado->tipo }}</td>
            <td>{{ $estado->fecha }}</td>
            <td>{{ $estado->forma_pago }}</td>
            <td>{{ $estado->alias }}</td>
            <td>{{ $estado->cliente }}</td>
            <td>{{ $estado->proveedor }}</td>
            <td>{{ $estado->cheque }}</td>
            <td>{{ $estado->subtotal }}</td>
            <td>{{ $estado->iva }}</td>
            <td>{{ $estado->total }}</td>
            <td>{{ $estado->deposito }}</td>
            <td>{{ $estado->retiro }}</td>
            <td>{{ $estado->estatus }}</td>
            <td>{{ $estado->iniciales }}</td>
            <td>{{ $estado->cancelado_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>