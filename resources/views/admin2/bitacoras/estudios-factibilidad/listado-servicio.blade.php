<tr id="servicio-{{ $servicio->id }}">
    <td style="width:6%;" valign="middle" align="left">{{ $servicio->id }}</td>
    <td style="width:28%;" valign="middle" align="left" title="{{ $servicio->clave }} - {{ $servicio->servicio }} - {{ $servicio->tramite }}" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->clase }} - {{ $servicio->nombre_comercial }}</td>
    <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>

    <!--Procesos -->
    <td style="width:2%;" valign="middle" align="center" @if($servicio->estatus_cobranza == 'Pagado') title="Fecha de pago: {{ Carbon\Carbon::parse($servicio->pago_fecha)->format('d-m-Y') }} | {{ Carbon\Carbon::parse($servicio->pago_fecha)->diffForHumans() }}" @elseif($servicio->estatus_cobranza == 'Pendiente') title="Pendiente" @elseif($servicio->estatus_cobranza == 'Cancelado') title="Cancelado" @endif data-tooltip="tooltip">
        @if($servicio->estatus_cobranza == 'Pagado')
            <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
        @elseif($servicio->estatus_cobranza == 'Pendiente')
            <i style="color: #FE9800" class="glyphicon glyphicon-minus"></i>
        @elseif($servicio->estatus_cobranza == 'Cancelado')
            <i style="color: red" class="glyphicon glyphicon-remove"></i>
        @endif
    </td>

    @if($servicio->recepcion_alta_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Recepción: {{ Carbon\Carbon::parse($servicio->recepcion_alta_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" data-toggle="modal" data-target="#recepcion-alta-modal" onclick="RecepcionAlta({{ $servicio->id }})">
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
        <td style="width:3%;" valign="middle" align="center" title="Recepción" data-tooltip="tooltip" data-toggle="modal" data-target="#recepcion-alta-modal" onclick="RecepcionAlta({{ $servicio->id }})">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->elaboracion_expediente_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Elaboración: {{ Carbon\Carbon::parse($servicio->elaboracion_expediente_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" data-toggle="modal" data-target="#recepcion-alta-modal" onclick="RecepcionAlta({{ $servicio->id }})">
            @if($servicio->elaboracion_expediente == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->elaboracion_expediente == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->elaboracion_expediente == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center" data-tooltip="tooltip" title="Elaboración" data-toggle="modal" data-target="#recepcion-alta-modal" onclick="RecepcionAlta({{ $servicio->id }})">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->revision_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Revisión: {{ Carbon\Carbon::parse($servicio->revision_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" data-toggle="modal" data-target="#recepcion-alta-modal" onclick="RecepcionAlta({{ $servicio->id }})">
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
        <td style="width:3%;" valign="middle" align="center" data-tooltip="tooltip" title="Revisión" data-toggle="modal" data-target="#recepcion-alta-modal" onclick="RecepcionAlta({{ $servicio->id }})">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->envio_expediente_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Envío: {{ Carbon\Carbon::parse($servicio->envio_expediente_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" data-toggle="modal" data-target="#recepcion-alta-modal" onclick="RecepcionAlta({{ $servicio->id }})">
            @if($servicio->envio_expediente == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->envio_expediente == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->envio_expediente == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center" data-tooltip="tooltip" title="Envío" data-toggle="modal" data-target="#recepcion-alta-modal" onclick="RecepcionAlta({{ $servicio->id }})">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    <!-- Segundo modal -->
    @if($servicio->registro_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Fecha de Registro: {{ Carbon\Carbon::parse($servicio->registro_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" @if($servicio->envio_expediente_boolean == 1) data-toggle="modal" data-target="#modal-registro-estudio" onclick="EstudiosFactibilidadRegistro({{ $servicio->id }})" @endif>
            @if($servicio->registro == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->registro == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->registro == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center" data-tooltip="tooltip" title="Fecha de Registro" @if($servicio->envio_expediente_boolean == 1) data-toggle="modal" data-target="#modal-registro-estudio" onclick="EstudiosFactibilidadRegistro({{ $servicio->id }})" @endif>
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif

    @if($servicio->registro_boolean == 1)
        <td style="width:3%;" valign="middle" align="center" title="Explicación en caso de no Registro: {{ Carbon\Carbon::parse($servicio->explicacion_comentarios_fecha)->format('d-m-Y') }} | {{ $servicio->explicacion_comentarios_comentarios }}" data-tooltip="tooltip" @if($servicio->envio_expediente_boolean == 1) data-toggle="modal" data-target="#modal-registro-estudio" onclick="EstudiosFactibilidadRegistro({{ $servicio->id }})" @endif>
            @if($servicio->registro == 'Realizado')
                <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
            @elseif($servicio->registro == 'No Aplica')
                <i style="color: #737373" class="fa fa-ban"></i>
            @elseif($servicio->registro == 'Cancelado')
                <i style="color: red" class="glyphicon glyphicon-remove"></i>
            @else
                <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
            @endif
        </td>
    @else
        <td style="width:3%;" valign="middle" align="center"  @if($servicio->envio_expediente_boolean == 1) data-toggle="modal" data-target="#modal-registro-estudio" onclick="EstudiosFactibilidadRegistro({{ $servicio->id }})" @endif data-tooltip="tooltip" title="Explicación en caso de no Registro">
            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
        </td>
    @endif
    <!--Fin -->


    <td style="width:9%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}</td>
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