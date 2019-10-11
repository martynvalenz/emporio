<tr id="listado-ingreso-{{ $estado->id }}">
    <td hidden>{{ $estado->id }}</td>
    @if($estado->fecha == null)
        <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($estado->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($estado->created_at)->format('d/m/Y') }}</td>
    @else
        <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($estado->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($estado->fecha)->format('d/m/Y') }}</td>
    @endif
    <td style="width:18%;" data-tooltip="tooltip">
        @if($estado->tipo == 'Traspaso')
            <label class="label label-indigo">Traspaso</label><br>
                {{ $estado->cuenta_traspaso }}<i style="padding-left: .5em; padding-right: .5em" class="fas fa-arrow-right"></i> {{ $estado->alias }}
        @elseif($estado->tipo == 'Ingreso' || $estado->tipo == 'INGRESO')
            <label class="label label-primary">Ingreso</label>
        @else
            <label for="" class="label label-indigo">{{ $estado->tipo }}</label>
        @endif
        <br>
        {{ $estado->concepto }}
    </td>
    <td style="width:17%;">
        {{ $estado->nombre_comercial }}
    </td>
    <td style="width:10%;">{{ $estado->alias }}</td>
    <td style="width:12%;" data-tooltip="tooltip" title="{{ $estado->codigo }} - {{ $estado->forma_pago }}">
        @if($estado->id_forma_pago == '1')
            <label class="label label-green">{{ $estado->forma_pago }}</label>
        @else
            {{ $estado->forma_pago }}
        @endif
    </td>
    <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($estado->subtotal,2) }} | IVA: {{ number_format($estado->iva,2) }}">{{ number_format($estado->deposito,2) }}</td>
    <td style="width:5%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ $estado->nombre }} {{ $estado->apellido }}">{{ $estado->iniciales }}</td>
    <td style="width:8%;" align="center" valign="middle" title="Detalles">
        @if($estado->estatus == 'Pagado')
            <label class="label label-success">Pagado</label>
        @elseif($estado->estatus == 'Cancelado')
            <label class="label label-danger" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($estado->cancelado_at)->diffForHumans() }} | {{ Carbon\Carbon::parse($estado->cancelado_at)->format('d/m/Y') }}">Cancelado</label>
        @elseif($estado->estatus == 'Pendiente')
            <label class="label label-warning">Pendiente</label>
        @endif
    </td>
    <td style="width:10%;" align="center">
        <div class="btn-group">
            <a class="btn btn-grey btn-xs"><i class="fas fa-list"></i></a>
            <a class="btn btn-warning btn-xs" onclick="EditIngreso({{ $estado->id }})" data-toggle="modal" data-target="#modal-ingreso"><i class="fas fa-edit"></i></a>
            @if($estado->estatus == 'Cancelado')
                <a class="btn btn-success btn-xs"><i class="fas fa-check"></i></a>
            @else
                <a class="btn btn-danger btn-xs" onclick="cancelarIngreso({{ $estado->id }}, {{ $estado->deposito }}, {{ $estado->saldo }}, {{ $estado->id_cliente }})"><i class="fas fa-times"></i></a>
            @endif
        </div>
        
    </td>
</tr>