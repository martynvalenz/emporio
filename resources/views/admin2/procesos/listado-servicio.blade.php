<tr id="servicio-{{ $servicio->id }}">
    <td style="width:5%;" valign="middle" align="left" id="servicio-{{ $servicio->id }}">{{ $servicio->id }}</td>
    <td hidden>{{ $servicio->id_control }}</td>
    <td style="width:14%;" valign="middle" align="left" data-target="#modal-detalles-{{ $servicio->id }}" title="{{ $servicio->clave }} - {{ $servicio->servicio }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->tramite }} {{ $servicio->marca }} {{ $servicio->clase }}</td>
    <td style="width:14%;" valign="middle" title="" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->nombre_comercial }}</td>
    <td style="width:7%;" align="center" valign="middle" title="Abrir factura" data-toggle="modal" data-tooltip="tooltip">
        @foreach($facturas as $fact)
            @if($fact->id_servicio == $servicio->id)
                {{ $fact->folio_factura }}
            @endif
        @endforeach
    </td>
    <td style="width:7%;" align="center" valign="middle" title="Abrir recibo" data-tooltip="tooltip">
        @foreach($facturas as $fact)
            @if($fact->id_servicio == $servicio->id)
                {{ $fact->folio_recibo }}
            @endif
        @endforeach
    </td>
    <td style="width:8%;" valign="middle" align="right" title="Descuento: $ {{ $servicio->descuento }} | % {{ $servicio->porcentaje_descuento }}" data-tooltip="tooltip" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal">{{ number_format($servicio->costo,2) }}</td>
    @if($servicio->mostrar_bitacora == 0)
    <td style="width:5%;" valign="middle" align="center" title="No se puede mostrar en bitácora" data-tooltip="tooltip"></td>
    @else
    <td style="width:5%;" valign="middle" align="center" title="Ver en bitácora: {{ $servicio->bitacora }}" data-tooltip="tooltip">
        @if($servicio->mostrar_bitacora == 1)
            @if($servicio->id_bitacoras =='1')
                <a href="{{ route('tramites-nuevos.index') }}" target="_blank">{{ $servicio->clave_bit }}</a>
            @elseif($servicio->id_bitacoras == '2')
                <a href="{{ route('estudios-factibilidad.index') }}" target="_blank">{{ $servicio->clave_bit }}</a>
            @elseif($servicio->id_bitacoras == '3')
                <a href="" target="_blank">{{ $servicio->clave_bit }}</a>
            @elseif($servicio->id_bitacoras == '4')
                <a href="" target="_blank">{{ $servicio->clave_bit }}</a>
            @elseif($servicio->id_bitacoras == '5')
                <a href="" target="_blank">{{ $servicio->clave_bit }}</a>
            @elseif($servicio->id_bitacoras == '6')
                <a href="" target="_blank">{{ $servicio->clave_bit }}</a>
            @endif
        @endif
    </td>
    @endif
    <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
    <td style="width:8%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}</td>
    <td style="width:5%;" align="center" valign="middle" title="Facturado: $ {{ number_format($servicio->facturado,2) }} | Cobrado: $ {{ number_format($servicio->cobrado,2) }} | Saldo: $ {{ number_format($servicio->saldo,2) }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">
        @if($servicio->estatus_cobranza != 'Cancelado' && $servicio->saldo > '0')
            <label class="label label-warning">Pendiente</label>
        @elseif($servicio->estatus_cobranza != 'Cancelado' && $servicio->saldo == '0')
            <label class="label label-success">Pagado</label>
        @elseif($servicio->estatus_cobranza == 'Cancelado')
            <label class="label label-danger">{{ $servicio->estatus_cobranza }}</label>
        @endif
    </td>
    @if($servicio->mostrar_bitacora == 0 && $servicio->estatus_tramite == 'Pendiente')
        <td align="center" style="width:8%;">
            <label class="label" style="background-color: #ff6600">Sin Bitácora</label>
        </td>
    @else
        <td align="center" style="width:8%;">
            @if($servicio->estatus_tramite == 'Pendiente')
                <label class="label label-warning">{{ $servicio->estatus_tramite }}</label>
            @elseif($servicio->estatus_tramite == 'Terminado')
                <label class="label label-success" title="Presentado {{ Carbon\Carbon::parse($servicio->presentacion_fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->presentacion_fecha)->format('d-m-Y') }}</label>
            @elseif($servicio->estatus_tramite == 'Cancelado')
                <label class="label label-danger">{{ $servicio->estatus_tramite }}</label>
            @elseif($servicio->estatus_tramite == 'No Registro')
                <label class="label label-danger">{{ $servicio->estatus_tramite }}</label>
            @endif
        </td>
    @endif
    <td style="width:18%;" align="center">
        <a class="btn btn-xs btn-default btn-flat btn-comentarios-modal" data-target="#comentarios-modal" data-toggle="modal" data-tooltip="tooltip" title="Comentarios" id="{{ $servicio->id }}" data-token="{{ csrf_token() }}">
            <i class="glyphicon glyphicon-list-alt"></i>
        </a>
        <a class="btn btn-xs btn-success btn-flat" onclick="Menu({{ $servicio->id }})" data-tooltip="tooltip" title="Menú de Facturas, Recibos, Comisiones y Cobros" data-toggle="modal" data-target="#menu"><i class="far fa-money-bill-alt"></i></a>
        <a onclick="Edit({{ $servicio->id }})" data-toggle="modal" data-target="#agregar-servicio" class="btn btn-xs btn-warning btn-flat" data-tooltip="tooltip" title="Editar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
        <i class="glyphicon glyphicon-edit"></i>
        </a>
        @if($servicio->estatus_cobranza == 'Pendiente' || $servicio->estatus_cobranza == 'Pagado')
            <a class="btn btn-xs btn-danger btn-flat" onclick="Cancelar({{ $servicio->id }})" data-toggle="modal" data-target="#modal-cancelar" data-tooltip="tooltip" title="Cancelar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
                <i class="glyphicon glyphicon-remove"></i>
            </a>
        @elseif($servicio->estatus_cobranza == 'Cancelado')
            <a class="btn btn-xs btn-success btn-flat" onclick="Activar({{ $servicio->id }})" data-toggle="modal" data-target="#modal-activar" data-tooltip="tooltip" title="Activar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
                <i class="glyphicon glyphicon-ok"></i>
            </a>
        @endif
    </td>
</tr>