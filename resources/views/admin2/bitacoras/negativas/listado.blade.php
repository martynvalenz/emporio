@if(count($servicios) > 0)
{{$servicios->render()}}
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px">
            <tr>
                <th style="color:white; background-color:#218CBF">ID</th>
                <th style="color:white; background-color:#218CBF">Servicio - Cliente</th>
                <th style="color:white; background-color:#218CBF">Resp</th>
                <th style="background-color: red; color:white" title="Recepción y alta en Estatus" data-tooltip="tooltip"><i class="fas fa-sign-in-alt"></i></th>
                <th style="background-color: red; color:white" title="Escaneo" data-tooltip="tooltip"><i class="fa fa-print" aria-hidden="true"></i></th>
                <th style="background-color: #00ff99" title="Elaboración de notificación" data-tooltip="tooltip"><i class="fas fa-clipboard-check"></i></th>
                <th style="background-color: #0099ff; color:white" title="Revisión" data-tooltip="tooltip"><i class="fa fa-search-plus" aria-hidden="true"></i></th>
                <th style="background-color: #ff99ff" title="Envío de notificación" data-tooltip="tooltip"><i class="far fa-share-square"></i></th>
                <th style="background-color: #ff99ff" title="Respuesta del cliente" data-tooltip="tooltip"><i class="fas fa-user"></i></th>
                <th style="background-color: #00ff99" title="Vencimiento" data-tooltip="tooltip"><i class="fas fa-calendar-check"></i></th>
                <th style="color:white; background-color:#218CBF">Creado</th>
                <th title="Estatus de cobranza del servicio" data-tooltip="tooltip" style="color:white; background-color:#218CBF">Cobranza</th>
                <th data-tooltip="tooltip" title="Estatus del servicio en su bitácora correspondiente" style="color:white; background-color:#218CBF">Trámite</th>
                <th colspan ="1" style="color:white; background-color:#218CBF">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($servicios as $key => $servicio)
            <tr id="servicio-{{ $servicio->id }}">
                <td style="width:6%;" valign="middle" align="left">{{ $servicio->id }}</td>
                <td style="width:24%;" valign="middle" align="left" title="{{ $servicio->clave }} - {{ $servicio->servicio }} - {{ $servicio->tramite }}" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->clase }} - {{ $servicio->nombre_comercial }}</td>
                <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>

                <!--Procesos -->

                @if($servicio->alta_estatus_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Recepción y alta en estatus: {{ Carbon\Carbon::parse($servicio->alta_estatus_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" data-target="#modal-recepcion-alta" data-toggle="modal" onclick="RecepcionAltaNegativas({{ $servicio->id }})">
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
                    <td style="width:2%;" valign="middle" align="center" title="Recepción y alta en estatus" data-tooltip="tooltip" data-target="#modal-recepcion-alta" data-toggle="modal" onclick="RecepcionAltaNegativas({{ $servicio->id }})">
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->escaneo_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Escaneo: {{ Carbon\Carbon::parse($servicio->escaneo_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" data-target="#modal-recepcion-alta" data-toggle="modal" onclick="RecepcionAltaNegativas({{ $servicio->id }})">
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
                    <td style="width:2%;" valign="middle" align="center" title="Escaneo" data-tooltip="tooltip" data-target="#modal-recepcion-alta" data-toggle="modal" onclick="RecepcionAltaNegativas({{ $servicio->id }})">
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->elaboracion_notificacion_agradecimiento_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Elaboración de Notificación: {{ Carbon\Carbon::parse($servicio->elaboracion_notificacion_agradecimiento_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" @if($servicio->escaneo_boolean == 1)data-toggle="modal" data-target="#modal-elaboracion-notificacion-negativa" onclick="ElaboracionNotificacionNegativa({{ $servicio->id }})"@endif>
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
                    <td style="width:2%;" valign="middle" align="center" data-tooltip="tooltip" title="Elaboración de Notificación" @if($servicio->escaneo_boolean == 1)data-toggle="modal" data-target="#modal-elaboracion-notificacion-negativa" onclick="ElaboracionNotificacionNegativa({{ $servicio->id }})"@endif>
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->revision_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Revisión: {{ Carbon\Carbon::parse($servicio->revision_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" @if($servicio->elaboracion_notificacion_agradecimiento_boolean == 1) data-toggle="modal" data-target="#modal-revision-negativa" onclick="RevisionNegativa({{ $servicio->id }})"@endif>
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
                    <td style="width:2%;" valign="middle" align="center" data-tooltip="tooltip" title="Revisión" @if($servicio->elaboracion_notificacion_agradecimiento_boolean == 1) data-toggle="modal" data-target="#modal-revision-negativa" onclick="RevisionNegativa({{ $servicio->id }})"@endif>
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->envio_notificacion_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Envío de notificación: {{ Carbon\Carbon::parse($servicio->envio_notificacion_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" @if($servicio->revision_boolean == 1) data-toggle="modal" data-target="#modal-envio-notificacion-negativa" onclick="EnvioNotificacionNegativa({{ $servicio->id }})"@endif>
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
                    <td style="width:2%;" valign="middle" align="center" data-tooltip="tooltip" title="Envío de notificación" @if($servicio->revision_boolean == 1) data-toggle="modal" data-target="#modal-envio-notificacion-negativa" onclick="EnvioNotificacionNegativa({{ $servicio->id }})"@endif>
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif
                @if($servicio->respuesta_cliente_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Respuesta del Cliente: {{ $servicio->respuesta_cliente_comentarios }} | {{ Carbon\Carbon::parse($servicio->respuesta_cliente_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" @if($servicio->revision_boolean == 1) data-toggle="modal" data-target="#modal-envio-notificacion-negativa" onclick="EnvioNotificacionNegativa({{ $servicio->id }})"@endif>
                        @if($servicio->respuesta_cliente == 'Realizado')
                            <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                        @elseif($servicio->respuesta_cliente == 'No Aplica')
                            <i style="color: #737373" class="fa fa-ban"></i>
                        @elseif($servicio->respuesta_cliente == 'Cancelado')
                            <i style="color: red" class="glyphicon glyphicon-remove"></i>
                        @else
                            <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                        @endif
                    </td>
                @else
                    <td style="width:2%;" valign="middle" align="center" data-tooltip="tooltip" title="Respuesta del Cliente" @if($servicio->revision_boolean == 1) data-toggle="modal" data-target="#modal-envio-notificacion-negativa" onclick="EnvioNotificacionNegativa({{ $servicio->id }})"@endif>
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif
                <td style="width:7%;" align="center" valign="middle" @if($servicio->respuesta_cliente_boolean == 1)data-toggle="modal" data-target="#modal-terminar-negativa" onclick="TerminarNegativa({{ $servicio->id }})"@endif>
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
                <td style="width:7%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}</td>
                <td style="width:5%;" align="center" valign="middle" title="Saldo: $ {{ number_format($servicio->saldo,2) }}" data-tooltip="tooltip">
                    @if($servicio->estatus_cobranza == 'Pendiente')
                        <label class="label label-warning">{{ $servicio->estatus_cobranza }}</label>
                    @elseif($servicio->estatus_cobranza == 'Pagado')
                        <label class="label label-success">{{ $servicio->estatus_cobranza }}</label>
                    @elseif($servicio->estatus_cobranza == 'Cancelado')
                        <label class="label label-danger">{{ $servicio->estatus_cobranza }}</label>
                    @endif
                </td>
                <td style="width:5%;" align="center" valign="middle" data-tooltip="tooltip" title="Estatus del servicio en la bitácora {{ $servicio->bitacora }}">
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
                <td style="width:13%;" align="center">
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
            @endforeach
        </tbody>
    </table>
</div>
{{$servicios->render()}}
@else
<h4>No se encontraron registros.</h4>
@endif