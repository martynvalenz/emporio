<tr id="egreso-{{ $egreso->id }}">
    <td hidden>{{ $egreso->id }}</td>
    <td style="width:15%;" valign="middle" align="left" title="{{ $egreso->concepto }}" data-tooltip="tooltip" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
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
    @if($egreso->tipo == 'Comision')
        <td style="width:17%;" valign="middle" align="left" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="">{{ $egreso->nombre }} {{ $egreso->apellido }}</td>
    @else
        <td style="width:17%;" valign="middle" align="left" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $egreso->razon_social }} | {{ $egreso->rfc }}">{{ $egreso->nombre_comercial }}</td>
    @endif
    <td style="width:10%;" align="left" valign="middle" title="{{ $egreso->banco }}" data-tooltip="tooltip" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ $egreso->alias }}</td>
    <td style="width:5%;" valign="middle" align="center" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
        @if($egreso->con_iva == 1)
            <label for="con_iva" class="label label-success">SI</label>
        @else
            <label for="con_iva" class="label label-warning">NO</label>
        @endif
    </td>
    <td style="width:10%;" align="center" valign="middle"  data-tooltip="tooltip" title="{{ $egreso->codigo }} - {{ $egreso->forma_pago }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ $egreso->forma_pago }}</td>
    <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($egreso->subtotal,2) }} | IVA: {{ number_format($egreso->iva,2) }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ number_format($egreso->total,2) }}</td>
    <td style="width:5%;" align="center" valign="middle" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $egreso->nombre }} {{ $egreso->apellido }}">{{ $egreso->iniciales }}</td>
    @if($egreso->fecha == null)
        <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->created_at)->diffForHumans() }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->created_at)->format('d/m/Y') }}</td>
    @else
        <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->fecha)->diffForHumans() }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->fecha)->format('d/m/Y') }}</td>
    @endif
    <td style="width:8%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
        @if($egreso->estatus == 'Pagado')
            <label class="label label-success">Pagado</label>
        @elseif($egreso->estatus == 'Cancelado')
            <label class="label label-danger" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($egreso->cancelado_at)->diffForHumans() }} | {{ Carbon\Carbon::parse($egreso->cancelado_at)->format('d/m/Y') }}">Cancelado</label>
        @elseif($egreso->estatus == 'Pendiente')
            <label class="label label-warning">Pendiente</label>
        @endif
    </td>
    <td style="width:10%;" align="center">
        @if($egreso->id_categoria == 59)
            <a class="btn btn-xs btn-info"  data-tooltip="tooltip" title="Editar pago de tarjeta de crédito: {{ $egreso->concepto }}" onclick="EditTarjeta({{ $egreso->id }})" data-toggle="modal" data-target="#modal-tarjeta-credito">
                <i class="fas fa-credit-card"></i>
            </a>
        @else
            <a class="btn btn-xs btn-primary"  data-tooltip="tooltip" title="Editar egreso: {{ $egreso->concepto }}" onclick="Edit({{ $egreso->id }})" data-toggle="modal" data-target="#egresos">
                <i class="fas fa-edit"></i>
            </a>
        @endif
        
        @if($egreso->id_categoria == 59)
            <a class="btn btn-xs btn-default" disabled>
                <i class="fas fa-minus"></i>
            </a>
        @else
            @if($egreso->estatus == 'Pagado')
                <a class="btn btn-xs btn-warning" title="Pasar egreso a estatus de 'Pendiente' de pago" data-tooltip="tooltip" onclick="PendienteEgreso({{ $egreso->id }})">
                    <i class="fas fa-minus"></i>
                </a> 
            @elseif($egreso->estatus == 'Pendiente')
                <a class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-pagar" title="Pasar egreso a estatus de 'Pagado'" onclick="Pagar({{ $egreso->id }})" data-tooltip="tooltip">
                    <i class="fas fa-money-bill-alt"></i>
                </a> 
            @elseif($egreso->estatus == 'Cancelado')
                <a disabled class="btn btn-xs btn-default">
                    <i class="fas fa-minus"></i>
                </a>
            @endif
        @endif

        @if($egreso->id_categoria == 59)
            @if($egreso->estatus == 'Pagado')
                <a class="btn btn-xs btn-danger" title="Para cancelar un egreso de tarjeta de crédito, cancele primero todos los pagos" data-tooltip="tooltip" onclick="EditTarjeta({{ $egreso->id }})" data-toggle="modal" data-target="#modal-tarjeta-credito">
                    <i class="fas fa-times"></i>
                </a>
            @else
                <a class="btn btn-xs btn-success" title="Activar egreso" data-tooltip="tooltip" onclick="ActivarEgreso({{ $egreso->id }}, {{ $egreso->total }}, {{ $egreso->pagado_boolean }})">
                    <i class="fas fa-check"></i>
                </a>
            @endif
        @else
            @if($egreso->estatus == 'Pagado' || $egreso->estatus == 'Pendiente')
                <a class="btn btn-xs btn-danger" title="Cancelar egreso {{ $egreso->concepto }}" onclick="CancelarEgreso({{ $egreso->id }})" data-tooltip="tooltip">
                    <i class="fas fa-times"></i>
                </a> 
            @elseif($egreso->estatus == 'Cancelado')
                <a class="btn btn-xs btn-success" title="Activar egreso" data-tooltip="tooltip" onclick="ActivarEgreso({{ $egreso->id }}, {{ $egreso->total }}, {{ $egreso->pagado_boolean }})">
                    <i class="fas fa-check"></i>
                </a>
            @endif
        @endif
    </td>
</tr>