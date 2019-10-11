<tr id="servicio-{{ $servicio->id }}">
    <td style="width:8%;" valign="middle" align="left" data-target="#modal-detalles-{{ $servicio->id }}">{{ $servicio->id }}</td>
    <td style="width:25%;" valign="middle" align="left" data-target="#modal-detalles-{{ $servicio->id }}" title="{{ $servicio->clave }} - {{ $servicio->servicio }} - {{ $servicio->tramite }} - {{ $servicio->nombre_comercial }} {{ $servicio->clase }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->marca }} - {{ $servicio->nombre_comercial }}</td>
    <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>


    <!--Procesos -->
    @if($servicio->recepcion_alta_boolean == 1)
        <td style="width:2%;" valign="middle" align="center" title="Recepción alta en estatus: {{ Carbon\Carbon::parse($servicio->recepcion_alta_fecha)->format('d-m-Y') }}" data-target="#modal-recepcion-alta-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" data-tooltip="tooltip">
            @if($servicio->recepcion_alta == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->recepcion_alta == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->recepcion_alta == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:2%;" valign="middle" align="center" title="Recepción alta en estatus" data-tooltip="tooltip" data-target="#modal-recepcion-alta-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->escaneo_boolean == 1)
        <td style="width:2%;" valign="middle" align="center" title="Escaneo: {{ Carbon\Carbon::parse($servicio->escaneo_fecha)->format('d-m-Y') }}" data-target="#modal-recepcion-alta-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" data-tooltip="tooltip">
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
        <td style="width:2%;" valign="middle" align="center" data-target="#modal-recepcion-alta-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" title="Escaneo" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->elaboracion_notificacion_agradecimiento_boolean == 1)
        <td style="width:2%;" valign="middle" align="center" title="Elaboración de Notificación: {{ Carbon\Carbon::parse($servicio->elaboracion_notificacion_agradecimiento_fecha)->format('d-m-Y') }}"  data-tooltip="tooltip" @if($servicio->escaneo_boolean == 1) data-target="#modal-elaboracion-notificacion-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif>
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
        <td style="width:2%;" valign="middle" align="center" title="Elaboración de Notificación" data-tooltip="tooltip" @if($servicio->escaneo_boolean == 1) data-target="#modal-elaboracion-notificacion-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif>
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->envio_notificacion_boolean == 1)
        <td style="width:2%;" valign="middle" align="center" title="Envío de Notificación: {{ Carbon\Carbon::parse($servicio->envio_notificacion_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1) data-target="#modal-elaboracion-notificacion-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif data-tooltip="tooltip">
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
        <td style="width:2%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1) data-target="#modal-elaboracion-notificacion-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif title="Envío de Notificación" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->pago_boolean == 1)
        <td style="width:2%;" valign="middle" align="center" title="Fecha de Cobro: {{ Carbon\Carbon::parse($servicio->pago_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1) data-target="#modal-elaboracion-notificacion-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif data-tooltip="tooltip">
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
        <td style="width:2%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1) data-target="#modal-elaboracion-notificacion-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif title="Fecha de Cobro" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->revision_boolean == 1)
        <td style="width:2%;" valign="middle" align="center" title="Revisión: {{ Carbon\Carbon::parse($servicio->revision_fecha)->format('d-m-Y') }}" @if($servicio->pago_boolean == 1) data-target="#modal-revision-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif data-tooltip="tooltip">
            @if($servicio->revision == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->revision == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->revision == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:2%;" valign="middle" align="center" @if($servicio->pago_boolean == 1) data-target="#modal-revision-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif title="Revisión" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->presentacion_boolean == 1)
        <td style="width:2%;" valign="middle" align="center" title="Presentación: {{ Carbon\Carbon::parse($servicio->presentacion_fecha)->format('d-m-Y') }}" @if($servicio->pago_boolean == 1) data-target="#modal-revision-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif data-tooltip="tooltip">
            @if($servicio->presentacion == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->presentacion == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->presentacion == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:2%;" valign="middle" align="center" @if($servicio->pago_boolean == 1) data-target="#modal-revision-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif title="Presentación" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->alta_estatus_boolean == 1)
        <td style="width:2%;" valign="middle" align="center" title="Alta en Estatus: {{ Carbon\Carbon::parse($servicio->envio_notificacion_fecha)->format('d-m-Y') }}" @if($servicio->pago_boolean == 1) data-target="#modal-revision-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif data-tooltip="tooltip">
            <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
        </td>
    @else
        <td style="width:2%;" valign="middle" align="center" @if($servicio->pago_boolean == 1) data-target="#modal-revision-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif title="Alta en Estatus" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->alta_control_archivar_boolean == 1)
        <td style="width:2%;" valign="middle" align="center" title="Alta en Control y Archivar: {{ Carbon\Carbon::parse($servicio->alta_control_archivar_fecha)->format('d-m-Y') }}" @if($servicio->pago_boolean == 1) data-target="#modal-terminar-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif data-tooltip="tooltip">
            @if($servicio->alta_control_archivar == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->alta_control_archivar == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->alta_control_archivar == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:2%;" valign="middle" align="center" @if($servicio->pago_boolean == 1) data-target="#modal-terminar-requisitos" data-toggle="modal" onclick="Requisitos({{ $servicio->id }})" @endif title="Alta en Control y Archivar" data-tooltip="tooltip">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    <td style="width:8%;" align="center" valign="middle">

        @if($servicio->estatus_tramite == 'Pendiente')
            
            @if($servicio->vencimiento_tramite_fecha != null)
                @if(Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() >= 28 && $servicio->vencimiento_tramite_fecha > $today)
                    <label class="label label-success" style="font-size: 14px" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->format('d-m-Y') }}">{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() >= 20 && Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() < 28 && $servicio->vencimiento_tramite_fecha > $today)
                    <label class="label label-success" style="font-size: 14px" title="{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() >= 10 && Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() < 20 && $servicio->vencimiento_tramite_fecha > $today)
                    <label class="label label-warning" style="font-size: 14px" title="{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() >= 1 && Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() < 10 && $servicio->vencimiento_tramite_fecha > $today)
                    <label class="label" style="font-size: 14px; background-color: #ff751a" title="{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() == 0)
                    <label class="label label-danger" style="font-size: 14px;" title="{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() < 0 && $servicio->vencimiento_tramite_fecha < $today)
                    <label class="label label-danger" style="font-size: 14px;" title="{{ Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->format('d-m-Y') }}" data-tooltip="tooltip">0 días</label>
                @else
                    <label class="label label-danger" style="font-size: 14px">0 días</label>
                @endif
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
            
        @elseif($servicio->estatus_tramite == 'Cancelado')
            <label class="label label-danger" style="font-size: 12px">{{ $servicio->estatus_tramite }}</label>
        @elseif($servicio->estatus_tramite == 'Terminado')
            <label class="label label-success" style="font-size: 12px">{{ $servicio->estatus_tramite }}</label>
        @elseif($servicio->estatus_tramite == 'No Registro')
            <label class="label" style="font-size: 12px; background-color: #ff751a">{{ $servicio->estatus_tramite }}</label>
        @else
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        @endif
    </td>
    <!--Fin -->


    <td style="width:8%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}</td>
    <td style="width:6%;" align="center" valign="middle" title="Saldo: $ {{ number_format($servicio->saldo,2) }}" data-tooltip="tooltip">
        @if($servicio->estatus_cobranza == 'Pendiente')
            <label class="label label-warning">{{ $servicio->estatus_cobranza }}</label>
        @elseif($servicio->estatus_cobranza == 'Pagado')
            <label class="label label-success">{{ $servicio->estatus_cobranza }}</label>
        @elseif($servicio->estatus_cobranza == 'Cancelado')
            <label class="label label-danger">{{ $servicio->estatus_cobranza }}</label>
        @endif
    </td>
    <td style="width:6%;" align="center" valign="middle" data-tooltip="tooltip" title="Estatus del servicio en la bitácora {{ $servicio->bitacora }}">
        @if($servicio->estatus_tramite == 'Pendiente')
            @if($servicio->vencimiento_tramite_fecha == null)
                <label class="label label-warning">{{ $servicio->estatus_tramite }}</label>
            @elseif(Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() > 10 && $servicio->vencimiento_tramite_fecha > $today)
                <label class="label label-warning">{{ $servicio->estatus_tramite }}</label>
            @elseif(Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() <= 10 && Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() > 0 && $servicio->vencimiento_tramite_fecha > $today)
                <label class="label" style="background-color: #ff751a">Por Vencer</label>
            @elseif(Carbon\Carbon::parse($servicio->vencimiento_tramite_fecha)->diffInDays() <= 0  && $servicio->vencimiento_tramite_fecha < $today)
                <label class="label label-danger">Vencido</label>
            @else
                <label class="label label-danger">Vencido</label>
            @endif
        @elseif($servicio->estatus_tramite == 'Terminado')
            <label class="label label-success">{{ $servicio->estatus_tramite }}</label>
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