<tr id="listado-egreso-{{ $egreso->id }}">
    <td hidden>{{ $egreso->id }}</td>
    <td style="width:18%;" data-tooltip="tooltip">
        @if($egreso->tipo == 'COMISION')
            <label class="label label-dark">Comisión</label>
        @elseif($egreso->tipo == 'Despacho')
            <label class="label label-warning">Despacho</label>
        @elseif($egreso->tipo == 'Hogar')
            <label class="label label-green">Hogar</label>
        @elseif($egreso->tipo == 'Personal')
            <label class="label label-info">Personal</label>
        @elseif($egreso->tipo == 'Traspaso')
            <label class="label label-indigo">Traspaso</label><i style="padding-left: .5em; padding-right: .5em" class="fas fa-arrow-right"></i> {{ $egreso->cuenta_traspaso }}
        @elseif($egreso->tipo == 'Nómina' || $egreso->tipo == 'Aguinaldo')
            <label class="label label-danger">{{ $egreso->tipo }}</label> <br>
             {{ Carbon\Carbon::parse($egreso->fecha_ini)->format('d-m-Y') }} - {{ Carbon\Carbon::parse($egreso->fecha)->format('d-m-Y') }}
        @endif
        <br>
        {{ $egreso->concepto }}
    </td>
    <td style="width:15%;">
        @if($egreso->tipo == 'COMISION' || $egreso->tipo == 'Nómina' || $egreso->tipo == 'Aguinaldo')
            {{ $egreso->iniciales_comisionado }} - {{ $egreso->nombre_comisionado }} {{  $egreso->apellido_comisionado }}
        @else
            {{ $egreso->nombre_comercial }}
        @endif
    </td>
    <td style="width:10%;">{{ $egreso->alias }}</td>
    <td align="center">
        @if($egreso->con_iva == 1)
            <label for="" class="label label-success">SI</label>
        @else
            <labe class="label label-warning">NO</labe>
        @endif
    </td>
    <td style="width:12%;" data-tooltip="tooltip" title="{{ $egreso->codigo }} - {{ $egreso->forma_pago }}">
        @if($egreso->id_forma_pago == '1')
            <label class="label label-green">{{ $egreso->forma_pago }}</label>
        @else
            {{ $egreso->forma_pago }}
        @endif
    </td>
    <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($egreso->subtotal,2) }} | IVA: {{ number_format($egreso->iva,2) }}">{{ number_format($egreso->total,2) }}</td>
    <td style="width:5%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ $egreso->nombre }} {{ $egreso->apellido }}">{{ $egreso->iniciales }}</td>
    @if($egreso->fecha == null)
        <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->created_at)->format('d/m/Y') }}</td>
    @else
        <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->fecha)->format('d/m/Y') }}</td>
    @endif
    <td style="width:8%;" align="center" valign="middle" title="Detalles">
        @if($egreso->estatus == 'Pagado')
            <label class="label label-success">Pagado</label>
        @elseif($egreso->estatus == 'Cancelado')
            <label class="label label-danger" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($egreso->cancelado_at)->diffForHumans() }} | {{ Carbon\Carbon::parse($egreso->cancelado_at)->format('d/m/Y') }}">Cancelado</label>
        @elseif($egreso->estatus == 'Pendiente')
            <label class="label label-warning">Pendiente</label>
        @endif
    </td>
    <td style="width:10%;" align="center">
        <div class="btn-group">
            @if($egreso->tipo == 'COMISION')
                <a class="btn btn-xs btn-info" onclick="EditComision({{ $egreso->id }})" data-toggle="modal" data-target="#modal-egreso-comision">
                    <i class="fas fa-hand-holding-usd"></i>
                </a>
            @elseif($egreso->tipo == 'Nómina' || $egreso->tipo == 'Aguinaldo')
                <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-nomina-edit" onclick="EditarNomina({{ $egreso->id }})"><i class="fas fa-hand-holding-usd"></i></a>
            @elseif($egreso->tipo == 'Despacho' || $egreso->tipo == 'Hogar' || $egreso->tipo == 'Personal' || $egreso->tipo == null)
                <a class="btn btn-xs btn-info"  data-tooltip="tooltip" title="Editar" onclick="EditarEgreso({{ $egreso->id }}, {{ $egreso->pago_servicios }})" data-toggle="modal" data-target="#modal-egreso">
                    <i class="fas fa-edit"></i>
                </a>
            @elseif($egreso->tipo == 'Traspaso')
                <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-traspaso" onclick="EditTraspaso({{ $egreso->id }})"><i class="fas fa-edit"></i></a>
            @endif

            @if($egreso->estatus == 'Pagado')
                <a class="btn btn-xs btn-warning" title="Pasar egreso a estatus de 'Pendiente' de pago" data-tooltip="tooltip" onclick="PendienteEgreso({{ $egreso->id }})">
                    <i class="fas fa-minus"></i>
                </a> 
            @elseif($egreso->estatus == 'Pendiente')
                <a class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-pagar" title="Pasar egreso a estatus de 'Pagado'" onclick="ActivarEgreso({{ $egreso->id }})" data-tooltip="tooltip">
                    <i class="fas fa-money-bill-alt"></i>
                </a> 
            @elseif($egreso->estatus == 'Cancelado')
                <a disabled class="btn btn-xs btn-default">
                    <i class="fas fa-minus"></i>
                </a>
            @endif

            @if($egreso->estatus == 'Cancelado')
                <a class="btn btn-xs btn-success" title="Activar egreso" data-tooltip="tooltip" onclick="ActivarEgreso({{ $egreso->id }})">
                    <i class="fas fa-check"></i>
                </a>
            @else
                <a class="btn btn-xs btn-danger" title="Cancelar egreso" data-tooltip="tooltip" onclick="CancelarEgreso({{ $egreso->id }}, {{ $egreso->pago_servicios }})">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </div>
    </td>
</tr>