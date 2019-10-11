<tr id="listado-asignacion-{{ $servicio->id }}">
    <td hidden>{{ $servicio->id }}</td>
    <td style="width:10%;" align="center" title="{{ $servicio->id }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha)->format('d-m-Y') }}</td>
    <td style="width:10%;" align="left">{{ $servicio->clave }}</td>
    <td style="width:28%;">{{ $servicio->tramite }} @if($servicio->tramite != '')-@endif {{ $servicio->marca }} {{ $servicio->clase }}</td>
    <td style="width:15%;">{{ $servicio->nombre_comercial }}</td>
    <td style="width:10%;" align="center" valign="middle">
        @if($servicio->estatus_cobranza == 'Pendiente')
            <label class="label label-warning">Pendiente</label>
        @elseif($servicio->estatus_cobranza == 'Pagado')
            <label class="label label-success">Pagado</label>
        @endif
    </td>
    <td style="width: 7%" align="right">
        @if($servicio->comision_venta_restante > 0 && $servicio->aplica_comision_venta == 1)
            {{ number_format($servicio->comision_venta_restante, 0) }}
        @else
            <span style="color: #b2bfcd">0.00</span>
        @endif
    </td>
    <td style="width: 7%" align="right">
        @if($servicio->comision_operativa_restante > 0 && $servicio->aplica_comision_operativa == 1)
            {{ number_format($servicio->comision_operativa_restante, 0) }}
        @else
            <span style="color: #b2bfcd">0.00</span>
        @endif
    </td>
    <td style="width: 7%" align="right">
        @if($servicio->comision_gestion_restante > 0 && $servicio->aplica_comision_gestion == 1)
            {{ number_format($servicio->comision_gestion_restante, 0) }}
        @else
            <span style="color: #b2bfcd">0.00</span>
        @endif
    </td>
    <td style="width: 5%" align="center">
        <a class="btn btn-success" data-toggle="modal" data-target="#modal-comision" onclick="Menu({{ $servicio->id }}, 0)"><i class="fas fa-money-bill-alt"></i></a>
    </td>
</tr>