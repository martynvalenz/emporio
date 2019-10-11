<tr id="egreso-{{ $egreso->id }}">
    <td hidden>{{ $egreso->id }}</td>
    <td style="width:20%;" valign="middle" align="left" title="{{ $egreso->concepto }}" data-tooltip="tooltip">
        @if($egreso->tipo == 'Despacho')
            <label class="label label-info">Despacho</label> {{ $egreso->categoria }}
        @elseif($egreso->tipo == 'Hogar')
            <label class="label label-success">Hogar</label> {{ $egreso->categoria }}
        @elseif($egreso->tipo == 'Personal')
            <label class="label label-warning">Personal</label> {{ $egreso->categoria }}
        @elseif($egreso->tipo == 'Comision')
            <label class="label label-default">Comisión</label> {{ $egreso->categoria }}
        @endif
    </td>
    <td style="width:17%;" valign="middle" align="left" data-tooltip="tooltip" title="{{ $egreso->razon_social }} | {{ $egreso->rfc }}">{{ $egreso->nombre_comercial }}</td>
    <td style="width:8%;" valign="middle" align="center" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
        @if($egreso->con_iva == 1)
            <label for="con_iva" class="label label-success">SI</label>
        @else
            <label for="con_iva" class="label label-warning">NO</label>
        @endif
    </td>
    <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($egreso->subtotal,2) }} | IVA: {{ number_format($egreso->iva,2) }}">{{ number_format($egreso->total,2) }}</td>
    <td style="width:10%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ $egreso->nombre }} {{ $egreso->apellido }}">{{ $egreso->iniciales }}</td>
    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->created_at)->format('d/m/Y') }}</td>
    <td style="width:10%;" align="center" valign="middle">
        @if($egreso->estatus == 'Pagado')
            <label class="label label-success">Pagado</label>
        @elseif($egreso->estatus == 'Cancelado')
            <label class="label label-danger" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($egreso->cancelado_at)->diffForHumans() }} | {{ Carbon\Carbon::parse($egreso->cancelado_at)->format('d/m/Y') }}">Cancelado</label>
        @elseif($egreso->estatus == 'Pendiente')
            <label class="label label-warning">Pendiente</label>
        @endif
    </td>
    <td style="width:15%;" align="center">
        <a class="btn btn-xs btn-info btn-editar" id="btn-editar-egreso" data-tooltip="tooltip" title="Editar egreso: {{ $egreso->concepto }}" onclick="Edit({{ $egreso->id }})" data-toggle="modal" data-target="#modal-cxp">
            <i class="glyphicon glyphicon-edit"></i>
        </a>
        <a class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-pagar" data-tooltip="tooltip" title="Pasar egreso a estatus de 'Pagado'" onclick="Pagar({{ $egreso->id }})">
            <i class="fas fa-money-bill-alt"></i>
        </a>
        @if($egreso->estatus == 'Pagado' || $egreso->estatus == 'Pendiente')
            <a class="btn btn-xs btn-danger" title="Cancelar egreso {{ $egreso->concepto }}" data-tooltip="tooltip" onclick="CancelarEgreso({{ $egreso->id }})">
                <i class="glyphicon glyphicon-remove"></i>
            </a>  
        @else
            <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $egreso->id }}" data-toggle="modal" title="Activar egreso" data-tooltip="tooltip">
                <i class="glyphicon glyphicon-ok"></i>
            </a>
        @endif
    </td>
</tr>