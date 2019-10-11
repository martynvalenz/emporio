@if(count($servicios) > 0)
{{$servicios->render()}}
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px">
            <tr>
                <th style="color:white; background-color:#218CBF">ID</th>
                <th hidden>Control</th>
                <th style="color:white; background-color:#218CBF">Servicio</th>
                <th style="color:white; background-color:#218CBF">Resp</th>
                <th style="background-color: #ff99ff" title="Formato" data-tooltip="tooltip"><i class="fa fa-file" aria-hidden="true"></i></th>
                <th style="background-color: #ff99ff" title="Envío de resultados EF" data-tooltip="tooltip"><i class="far fa-share-square"></i></th>
                <th style="background-color: #ff99ff" title="Contrato" data-tooltip="tooltip"><i class="fas fa-handshake"></i></th>
                <th style="background-color: #ff99ff" title="Carta Poder" data-tooltip="tooltip"><i class="fa fa-envelope" aria-hidden="true"></i></th>
                <th style="background-color: #ff99ff" title="Logo" data-tooltip="tooltip"><i class="fa fa-image" aria-hidden="true"></i></th>
                <th style="background-color: #ff99ff" title="Reglas de uso" data-tooltip="tooltip"><i class="fa fa-book" aria-hidden="true"></i></th>
                <th style="background-color: #ff99ff" title="Escaneo de documentos" data-tooltip="tooltip"><i class="fa fa-print" aria-hidden="true"></i></th>
                <th style="background-color: #99ff99" title="Recepción" data-tooltip="tooltip"><i class="glyphicon glyphicon-level-up"></i></th>
                <th style="background-color: #99ff99" title="Marca lista para ingreso" data-tooltip="tooltip"><i class="glyphicon glyphicon-saved"></i></th>
                <th style="background-color: #99ff99" title="Validación de marca en línea" data-tooltip="tooltip"><i class="glyphicon glyphicon-thumbs-up"></i></th>
                <th style="background-color: #d6d6d6" title="Revisión y pago de marca" data-tooltip="tooltip"><i class="fa fa-search-plus" aria-hidden="true"></i></th>
                <th style="background-color: #99ff99" title="Firma fiel" data-tooltip="tooltip"><i class="fas fa-file-excel"></i></th>
                <th style="background-color: #99ff99" title="Impresión" data-tooltip="tooltip"><i class="glyphicon glyphicon-print"></i></th>
                <th style="background-color: #ff99ff" title="Elaboración de expediente a cliente" data-tooltip="tooltip"><i class="glyphicon glyphicon-folder-close"></i></th>
                <th style="background-color: #ff99ff" title="Envío de expediente a cliente" data-tooltip="tooltip"><i class="fa fa-truck"></i></th>
                <th style="color:white; background-color:#218CBF">Creado</th>
                <th title="Estatus de cobranza del servicio" data-tooltip="tooltip" style="color:white; background-color:#218CBF">Cobranza</th>
                <th data-tooltip="tooltip" title="Estatus del servicio en su bitácora correspondiente" style="color:white; background-color:#218CBF">Trámite</th>
                <th colspan ="1" style="background-color:#218CBF">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($servicios as $key => $servicio)
            <tr id="servicio-{{ $servicio->id }}">
                <td style="width:5%;" valign="middle" align="left">{{ $servicio->id }}</td>
                <td hidden>{{ $servicio->id_control }}</td>
                <td style="width:15%;" valign="middle" align="left" title="{{ $servicio->clave }} - {{ $servicio->servicio }} - {{ $servicio->tramite }} - {{ $servicio->nombre_comercial }} {{ $servicio->clase }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->clase }} {{ $servicio->tramite }}</td>
                <td style="width:4%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>


                <!--Procesos -->
                <td style="width:2%;" valign="middle" align="center" title="Formato: {{ Carbon\Carbon::parse($servicio->formato_fecha)->format('d-m-Y') }}" onclick="Formato({{ $servicio->id }})" data-toggle="modal" data-target="#modal-formato" data-tooltip="tooltip">
                    @if($servicio->formato == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                    @elseif($servicio->formato == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                    @elseif($servicio->formato == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                    @elseif($servicio->formato == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                    @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    @endif
                </td>

                <td style="width:2%;" valign="middle" align="center" title="Envío de resultados EF: {{ Carbon\Carbon::parse($servicio->envio_resultados_fecha)->format('d-m-Y') }}" onclick="Formato({{ $servicio->id }})" data-toggle="modal" data-target="#modal-formato" data-tooltip="tooltip">
                    @if($servicio->envio_resultados == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                    @elseif($servicio->envio_resultados == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                    @elseif($servicio->envio_resultados == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                    @elseif($servicio->envio_resultados == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                    @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    @endif
                </td>
              
                <td style="width:2%;" valign="middle" align="center" title="Contrato: {{ Carbon\Carbon::parse($servicio->contrato_fecha)->format('d-m-Y') }}" onclick="Formato({{ $servicio->id }})" data-toggle="modal" data-target="#modal-formato" data-tooltip="tooltip">
                    @if($servicio->contrato == 'Realizado')
                    <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                    @elseif($servicio->contrato == 'No Aplica')
                    <i style="color: #737373" class="fa fa-ban"></i>
                    @elseif($servicio->contrato == 'Cancelado')
                    <i style="color: red" class="glyphicon glyphicon-remove"></i>
                    @elseif($servicio->contrato == 'Existente')
                    <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                    @else
                    <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    @endif
                </td>

                <td style="width:2%;" valign="middle" align="center" title="Carta Poder: {{ Carbon\Carbon::parse($servicio->carta_poder_fecha)->format('d-m-Y') }}" onclick="Formato({{ $servicio->id }})" data-toggle="modal" data-target="#modal-formato" data-tooltip="tooltip">
                    @if($servicio->carta_poder == 'Realizado')
                    <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                    @elseif($servicio->carta_poder == 'No Aplica')
                    <i style="color: #737373" class="fa fa-ban"></i>
                    @elseif($servicio->carta_poder == 'Cancelado')
                    <i style="color: red" class="glyphicon glyphicon-remove"></i>
                    @elseif($servicio->carta_poder == 'Existente')
                    <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                    @else
                    <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    @endif
                </td>

                <td style="width:2%;" valign="middle" align="center" title="Logo: {{ Carbon\Carbon::parse($servicio->logo_fecha)->format('d-m-Y') }}" onclick="Formato({{ $servicio->id }})" data-toggle="modal" data-target="#modal-formato" data-tooltip="tooltip">
                    @if($servicio->logo == 'Realizado')
                    <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                    @elseif($servicio->logo == 'No Aplica')
                    <i style="color: #737373" class="fa fa-ban"></i>
                    @elseif($servicio->logo == 'Cancelado')
                    <i style="color: red" class="glyphicon glyphicon-remove"></i>
                    @elseif($servicio->logo == 'Existente')
                    <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                    @else
                    <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    @endif
                </td>

                <td style="width:2%;" valign="middle" align="center" title="Reglas de uso: {{ Carbon\Carbon::parse($servicio->reglas_uso_fecha)->format('d-m-Y') }}" onclick="Formato({{ $servicio->id }})" data-toggle="modal" data-target="#modal-formato" data-tooltip="tooltip">
                    @if($servicio->reglas_uso == 'Realizado')
                    <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                    @elseif($servicio->reglas_uso == 'No Aplica')
                    <i style="color: #737373" class="fa fa-ban"></i>
                    @elseif($servicio->reglas_uso == 'Cancelado')
                    <i style="color: red" class="glyphicon glyphicon-remove"></i>
                    @elseif($servicio->reglas_uso == 'Existente')
                    <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                    @else
                    <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    @endif
                </td>

                <td style="width:2%;" valign="middle" align="center" title="Escaneo de documentos: {{ Carbon\Carbon::parse($servicio->escaneo_fecha)->format('d-m-Y') }}" onclick="Formato({{ $servicio->id }})" data-toggle="modal" data-target="#modal-formato" data-tooltip="tooltip">
                    @if($servicio->escaneo == 'Realizado')
                    <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                    @elseif($servicio->escaneo == 'No Aplica')
                    <i style="color: #737373" class="fa fa-ban"></i>
                    @elseif($servicio->escaneo == 'Cancelado')
                    <i style="color: red" class="glyphicon glyphicon-remove"></i>
                    @elseif($servicio->escaneo == 'Existente')
                    <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                    @else
                    <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    @endif
                </td>

                @if($servicio->recepcion_alta_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Recepción: {{ Carbon\Carbon::parse($servicio->recepcion_alta_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip">
                        @if($servicio->recepcion_alta == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                        @elseif($servicio->recepcion_alta == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                        @elseif($servicio->recepcion_alta == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                        @elseif($servicio->recepcion_alta == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                        @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                        @endif
                    </td>
                @else
                    <td style="width:2%;" valign="middle" align="center" data-tooltip="tooltip" title="Recepción" data-tooltip="tooltip" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif>
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->marca_lista_ingreso_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Marca lista para ingreso: {{ Carbon\Carbon::parse($servicio->marca_lista_ingreso_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip">
                        @if($servicio->marca_lista_ingreso == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                        @elseif($servicio->marca_lista_ingreso == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                        @elseif($servicio->marca_lista_ingreso == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                        @elseif($servicio->marca_lista_ingreso == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                        @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                        @endif
                    </td>
                @else
                    <td style="width:2%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip" title="Marca lista para ingreso">
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif
                
                @if($servicio->validacion_marca_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Validación de marca en línea: {{ Carbon\Carbon::parse($servicio->validacion_marca_fecha)->format('d-m-Y') }}" data-tooltip="tooltip" data-tooltip="tooltip" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif>
                        @if($servicio->validacion_marca == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                        @elseif($servicio->validacion_marca == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                        @elseif($servicio->validacion_marca == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                        @elseif($servicio->validacion_marca == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                        @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                        @endif
                    </td>
                @else
                    <td style="width:2%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip" title="Validación de marca en línea">
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->revision_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Revisión y pago de marca: {{ Carbon\Carbon::parse($servicio->revision_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip">
                        @if($servicio->revision == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                        @elseif($servicio->revision == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                        @elseif($servicio->revision == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                        @elseif($servicio->revision == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                        @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                        @endif
                    </td>
                @else
                    <td style="width:2%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip" title="Revisión y pago de marca">
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->firma_fiel_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Firma fiel: {{ Carbon\Carbon::parse($servicio->firma_fiel_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip">
                        @if($servicio->firma_fiel == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                        @elseif($servicio->firma_fiel == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                        @elseif($servicio->firma_fiel == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                        @elseif($servicio->firma_fiel == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                        @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                        @endif
                    </td>
                @else
                    <td style="width:2%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip" title="Firma fiel">
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->impresion_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Impresión: {{ Carbon\Carbon::parse($servicio->impresion_fecha)->format('d-m-Y') }}" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip">
                        @if($servicio->impresion == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                        @elseif($servicio->impresion == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                        @elseif($servicio->impresion == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                        @elseif($servicio->impresion == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                        @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                        @endif
                    </td>
                @else
                    <td style="width:2%;" valign="middle" align="center" @if($servicio->escaneo_boolean == 1)data-target="#modal-recepcion" data-toggle="modal" onclick="Recepcion({{ $servicio->id }})"@endif data-tooltip="tooltip" title="Impresión">
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->elaboracion_expediente_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Elaboración de expediente a cliente: {{ Carbon\Carbon::parse($servicio->elaboracion_expediente_fecha)->format('d-m-Y') }}" @if($servicio->firma_fiel_boolean == 1) data-target="#modal-elaboracion-expediente" data-toggle="modal" onclick="ElaboracionExpediente({{ $servicio->id }})" @endif data-tooltip="tooltip">
                        @if($servicio->elaboracion_expediente == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                        @elseif($servicio->elaboracion_expediente == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                        @elseif($servicio->elaboracion_expediente == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                        @elseif($servicio->elaboracion_expediente == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                        @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                        @endif
                    </td>
                @else
                    <td style="width:2%;" valign="middle" align="center" @if($servicio->firma_fiel_boolean == 1) data-target="#modal-elaboracion-expediente" data-toggle="modal" onclick="ElaboracionExpediente({{ $servicio->id }})" @endif data-tooltip="tooltip" title="Elaboración de expediente a cliente">
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif

                @if($servicio->envio_expediente_boolean == 1)
                    <td style="width:2%;" valign="middle" align="center" title="Envío de expediente a cliente: {{ Carbon\Carbon::parse($servicio->envio_expediente_fecha)->format('d-m-Y') }}" @if($servicio->firma_fiel_boolean == 1) data-target="#modal-elaboracion-expediente" data-toggle="modal" onclick="ElaboracionExpediente({{ $servicio->id }})" @endif data-tooltip="tooltip">
                        @if($servicio->envio_expediente == 'Realizado')
                        <i style="color: #339966" class="glyphicon glyphicon-ok"></i>
                        @elseif($servicio->envio_expediente == 'No Aplica')
                        <i style="color: #737373" class="fa fa-ban"></i>
                        @elseif($servicio->envio_expediente == 'Cancelado')
                        <i style="color: red" class="glyphicon glyphicon-remove"></i>
                        @elseif($servicio->envio_expediente == 'Existente')
                        <i style="color: #0066ff" class="fa fa-thumbs-up"></i>
                        @else
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                        @endif
                    </td>
                @else
                    <td style="width:2%;" valign="middle" align="center" @if($servicio->firma_fiel_boolean == 1) data-target="#modal-elaboracion-expediente" data-toggle="modal" onclick="ElaboracionExpediente({{ $servicio->id }})" @endif data-tooltip="tooltip" title="Envío de expediente a cliente">
                        <i style="color: #cccccc" class="glyphicon glyphicon-minus"></i>
                    </td>
                @endif
                <!--Fin -->


                <td style="width:6%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-target="#modal-detalles-{{ $servicio->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}</td>
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
                <td style="width:14%;" align="center">
                    <a class="btn btn-xs btn-default btn-flat btn-comentarios-modal" data-target="#comentarios-modal" data-toggle="modal" data-tooltip="tooltip" title="Comentarios" onclick="Comentarios({{ $servicio->id }}, {{ $servicio->id_estatus }})" data-token="{{ csrf_token() }}">
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

                    @if($servicio->id_control == '')    
                        <a class="btn btn-gris btn-xs btn-flat" disabled title="No se puede enviar el servicio a estatus debido a que no tiene marca" data-tooltip="tooltip"><i class="fas fa-external-link-square-alt"></i></a>
                    @else
                        <a class="btn btn-primary btn-xs btn-flat" title="Pasar servicio a Estatus" data-tooltip="tooltip" data-toggle="modal" data-target="#modal-estatus"
                            @if($servicio->id_estatus == '') 
                                onclick="Estatus({{ $servicio->id }}, 0, {{ $servicio->id_control }}, '{{ $servicio->marca }}', {{ $servicio->id_cliente }}, {{ $servicio->id_clase }})"
                            @else onclick="Estatus({{ $servicio->id }}, {{ $servicio->id_estatus }}, {{ $servicio->id_control }}, '{{ $servicio->marca }}', {{ $servicio->id_cliente }}, {{ $servicio->id_clase }})" 
                            @endif><i class="fas fa-external-link-square-alt"></i></a>
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