<tr id="servicio-{{ $servicio->id }}">
    <td style="width:11%;" valign="middle" align="left" data-target="#modal-detalles-{{ $servicio->id }}">{{ $servicio->id }}</td>
    <td style="width:30%;" valign="middle" align="left" data-target="#modal-detalles-{{ $servicio->id }}" title="{{ $servicio->clave }} - {{ $servicio->servicio }} - {{ $servicio->tramite }} - {{ $servicio->nombre_comercial }} {{ $servicio->clase }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->marca }} - {{ $servicio->nombre_comercial }}</td>
    <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>

    <!--Procesos -->
    @if($servicio->alta_estatus_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Escaneo: {{ Carbon\Carbon::parse($servicio->alta_estatus_fecha)->format('d-m-Y') }}" data-target="#modal-alta-estatus-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" data-tooltip="tooltip">
            @if($servicio->alta_estatus == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->alta_estatus == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->alta_estatus == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center" data-target="#modal-alta-estatus-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" title="Alta en Estatus" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->escaneo_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Escaneo: {{ Carbon\Carbon::parse($servicio->escaneo_fecha)->format('d-m-Y') }}" data-target="#modal-alta-estatus-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" data-tooltip="tooltip">
            @if($servicio->escaneo == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->escaneo == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->escaneo == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center" data-target="#modal-alta-estatus-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" title="Escaneo" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->elaboracion_notificacion_agradecimiento_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Elaboración de Notificación: {{ Carbon\Carbon::parse($servicio->elaboracion_notificacion_agradecimiento_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1) data-target="#modal-entrega-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" @endif data-tooltip="tooltip">
            @if($servicio->elaboracion_notificacion_agradecimiento == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->elaboracion_notificacion_agradecimiento == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->elaboracion_notificacion_agradecimiento == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1) data-target="#modal-entrega-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" @endif title="Elaboración de Notificación" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->envio_notificacion_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Envío de Notificación: {{ Carbon\Carbon::parse($servicio->envio_notificacion_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1) data-target="#modal-entrega-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" @endif data-tooltip="tooltip">
            @if($servicio->envio_notificacion == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->envio_notificacion == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->envio_notificacion == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1) data-target="#modal-entrega-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" @endif title="Envío de Notificación" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->pago_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Fecha de Cobro: {{ Carbon\Carbon::parse($servicio->pago_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1) data-target="#modal-entrega-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" @endif data-tooltip="tooltip">
            @if($servicio->pago == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->pago == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->pago == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1) data-target="#modal-entrega-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" @endif title="Fecha de Cobro" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->entrega_titulo_agradecimiento_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Entrega de Título y Agradecimiento: {{ Carbon\Carbon::parse($servicio->entrega_titulo_agradecimiento_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1) data-target="#modal-entrega-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" @endif data-tooltip="tooltip">
            @if($servicio->entrega_titulo_agradecimiento == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->entrega_titulo_agradecimiento == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->entrega_titulo_agradecimiento == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1) data-target="#modal-entrega-titulo" data-toggle="modal" onclick="TitulosyCertificados({{ $servicio->id }})" @endif title="Entrega de Título y Agradecimiento" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif
    <!--Fin -->


    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}</td>
    <td style="width:5%;" align="center" valign="middle" title="Saldo: $ {{ number_format($servicio->saldo,2) }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">
        @if($servicio->estatus_cobranza == 'Pendiente')
            <label class="label label-warning">{{ $servicio->estatus_cobranza }}</label>
        @elseif($servicio->estatus_cobranza == 'Pagado')
            <label class="label label-success">{{ $servicio->estatus_cobranza }}</label>
        @elseif($servicio->estatus_cobranza == 'Cancelado')
            <label class="label label-danger">{{ $servicio->estatus_cobranza }}</label>
        @endif
    </td>
    <td style="width:5%;" align="center" valign="middle" data-tooltip="tooltip" data-target="#modal-lista-{{ $servicio->id }}" data-toggle="modal">
        @if($servicio->estatus_tramite == 'Pendiente')
            <label class="label label-warning">{{ $servicio->estatus_tramite }}</label>
        @elseif($servicio->estatus_tramite == 'Terminado')
            <label class="label label-success" title="Presentado {{ Carbon\Carbon::parse($servicio->presentacion_fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->presentacion_fecha)->format('d-m-Y') }}</label>
        @elseif($servicio->estatus_tramite == 'Cancelado')
            <label class="label label-danger">{{ $servicio->estatus_tramite }}</label>
        @elseif($servicio->estatus_tramite == 'No Registro')
            <label class="label label-danger">No Registro</label>
        @endif
    </td>
    <td style="width:16%;" align="center">
        <a class="btn btn-xs btn-default btn-flat btn-comentarios-modal" data-target="#comentarios-modal" data-toggle="modal" data-tooltip="tooltip" title="Comentarios" id="{{ $servicio->id }}" data-token="{{ csrf_token() }}">
            <i class="glyphicon glyphicon-list-alt"></i>
        </a>
        <a class="btn btn-xs btn-success btn-flat" onclick="Menu({{ $servicio->id }})" data-tooltip="tooltip" title="Menú de Facturas, Recibos, Comisiones y Cobros" data-toggle="modal" data-target="#menu"><i class="far fa-money-bill-alt"></i></a>
        <a onclick="Edit({{ $servicio->id }})" data-toggle="modal" data-target="#agregar-servicio" class="btn btn-xs btn-warning btn-flat" data-tooltip="tooltip" title="Editar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
          <i class="glyphicon glyphicon-edit"></i>
        </a>
        @if($servicio->estatus_tramite == 'Cancelado')
            <a class="btn btn-xs btn-success btn-flat" data-toggle="modal" data-target="#modal-activar-bitacora" onclick="openStatus({{ $servicio->id }})" data-tooltip="tooltip" title="Activar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
            <i class="glyphicon glyphicon-ok"></i>
            </a>
        @else
            <a class="btn btn-xs btn-danger btn-flat" data-toggle="modal" data-target="#modal-cancelar-bitacora" onclick="openStatus({{ $servicio->id }})" data-tooltip="tooltip" title="Cancelar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
            <i class="glyphicon glyphicon-remove"></i>
            </a>
        @endif
    </td>
</tr>