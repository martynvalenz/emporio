<tr id="factura-{{ $factura->id }}">
    <td style="width:8%;" valign="middle" align="center" title="{{ $factura->comentarios }}" data-tooltip="tooltip">
        @if($factura->estatus == 'Pagado')
        <label class="label label-success" style="font-size: 15px">{{ $factura->folio_factura }}</label>
        @elseif($factura->estatus == 'Cancelado')
        <label class="label label-danger" style="font-size: 15px">{{ $factura->folio_factura }}</label>
        @elseif($factura->estatus == 'Pendiente')
        <label class="label label-warning" style="font-size: 15px" data-target="#modal-pagar-recibo" data-toggle="modal" onclick="PagarFacturaRecibo({{ $factura->id }}, {{ $factura->folio_factura }}, {{ $factura->saldo }}, 'Factura')">{{ $factura->folio_factura }}</label>
        @endif
    </td>
    <td style="width:15%;" valign="middle" align="left" title="{{ $factura->razon }} {{ $factura->rfc_cliente }}" data-tooltip="tooltip">{{ $factura->nombre_comercial }}</td>
    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($factura->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
    <td style="width:10%;" valign="middle" align="right">{{ number_format($factura->subtotal,2) }}</td>
    <td style="width:10%;" valign="middle" align="right">{{ number_format($factura->iva,2) }}</td>
    <td style="width:10%;" valign="middle" align="right">{{ number_format($factura->total,2) }}</td>
    <td style="width:10%;" valign="middle" align="right" title="Pagado: {{ number_format($factura->pagado,2) }}" data-tooltip="tooltip">{{ number_format($factura->saldo,2) }}</td>
    <td style="width:7%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ $factura->nombre }} {{ $factura->apellido }}">{{ $factura->iniciales }}</td>
    <td style="width:8%;" align="center" valign="middle" title="Detalles">
        @if($factura->estatus == 'Pagado')
            <label class="label label-success">Pagado</label>
        @elseif($factura->estatus == 'Cancelado')
            <label class="label label-danger">Cancelado</label>
        @elseif($factura->estatus == 'Pendiente')
            <label class="label label-warning">Pendiente</label>
        @endif
    </td>
    <td hidden>{{ $factura->id }}</td>
    <td style="width:12%;" align="center">
        <div class="btn-group">
            @if($factura->detalles == 0)
                <a disabled class="btn btn-grey btn-sm btn-detalle" title="La factura no tiene servicios." data-tooltip="tooltip">
                    <i class="glyphicon glyphicon-th-list"></i>
                    <span class="label label-danger">0</span>
                </a>
            @elseif($factura->detalles > 0)
                <a class="btn btn-grey btn-sm btn-detalle" 
                data-toggle="modal" 
                data-target="#modal-detalles"
                onclick="MostrarDetallesFactura({{ $factura->id }}, {{ $factura->folio_factura }}, 'Factura')"
                >
                    <i class="glyphicon glyphicon-th-list"></i>
                    <span class="label label-success">{{ $factura->detalles }}</span> 
                </a>
            @endif
            <a class="btn btn-sm btn-warning" onclick="EditFactura({{ $factura->id }}, 'Pendiente')" data-toggle="modal" data-target="#modal-factura"  data-tooltip="tooltip">
                <i class="fas fa-edit"></i>
            </a>
            @if($factura->estatus == 'Pagado' || $factura->estatus == 'Pendiente')
                <a class="btn btn-sm btn-danger" onclick="CancelarFactura({{ $factura->id }})">
                    <i class="fas fa-times"></i>
                </a> 
            @elseif($factura->estatus == 'Cancelado')
                <a class="btn btn-sm btn-success" onclick="ActivarFactura({{ $factura->id }})">
                    <i class="fas fa-check"></i>
                </a>  
            @endif
        </div>
    </td>
</tr>