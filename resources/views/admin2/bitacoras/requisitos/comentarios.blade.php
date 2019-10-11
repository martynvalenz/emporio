<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-comentarios-{{ $servicio->id }}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
        </button>
        <h3 class="modal-title" style="color: white;">{{ $servicio->clave }} - {{ $servicio->servicio }} {{ $servicio->nombre_comercial }}</h3>
      </div>
      <div class="modal-body">
          
           <!-- row -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline">
              <!-- timeline time label 
              <li class="time-label">
                    <span class="bg-red">

                    </span>
              </li>
               /.timeline-label -->
              <!-- Formato -->
              @if($servicio->formato_boolean == 1)
                <li>
                  <i class="fa fa-file bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->formato_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->formato_fecha)->diffForHumans() }}</b>
                    
                    <h3 class="timeline-header">
                      @if($servicio->formato == 'Realizado')
                        <b>Formato: </b> <label class="label label-success">{{ $servicio->formato }}</label>
                      @elseif($servicio->formato == 'Cancelado')
                        <b>Formato: </b> <label class="label label-danger">{{ $servicio->formato }}</label>
                      @elseif($servicio->formato == 'No Aplica')
                        <b>Formato: </b> <label class="label label-default">{{ $servicio->formato }}</label>
                      @elseif($servicio->formato == 'Existente')
                        <b>Formato: </b> <label class="label label-info">{{ $servicio->formato }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->formato_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Envío de resutlados -->
              @if($servicio->envio_resultados_boolean == 1)
                <li>
                  <i class="fa fa-sign-in bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->envio_resultados_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->envio_resultados_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->envio_resultados == 'Realizado')
                        <b>Envío de resultados: </b> <label class="label label-success">{{ $servicio->envio_resultados }}</label>
                      @elseif($servicio->envio_resultados == 'Cancelado')
                        <b>Envío de resultados: </b> <label class="label label-danger">{{ $servicio->envio_resultados }}</label>
                      @elseif($servicio->envio_resultados == 'No Aplica')
                        <b>Envío de resultados: </b> <label class="label label-default">{{ $servicio->envio_resultados }}</label>
                      @elseif($servicio->envio_resultados == 'Existente')
                        <b>Envío de resultados: </b> <label class="label label-info">{{ $servicio->envio_resultados }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->envio_resultados_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Contrato -->
              @if($servicio->contrato_boolean == 1)
                <li>
                  <i class="fa fa-handshake-o bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->contrato_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->contrato_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->contrato == 'Realizado')
                        <b>Contrato: </b> <label class="label label-success">{{ $servicio->contrato }}</label>
                      @elseif($servicio->contrato == 'Cancelado')
                        <b>Contrato: </b> <label class="label label-danger">{{ $servicio->contrato }}</label>
                      @elseif($servicio->contrato == 'No Aplica')
                        <b>Contrato: </b> <label class="label label-default">{{ $servicio->contrato }}</label>
                      @elseif($servicio->contrato == 'Existente')
                        <b>Contrato: </b> <label class="label label-info">{{ $servicio->contrato }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->contrato_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Carta Poder -->
              @if($servicio->carta_poder_boolean == 1)
                <li>
                  <i class="fa fa-envelope-square bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->carta_poder_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->carta_poder_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->carta_poder == 'Realizado')
                        <b>Carta Poder: </b> <label class="label label-success">{{ $servicio->carta_poder }}</label>
                      @elseif($servicio->carta_poder == 'Cancelado')
                        <b>Carta Poder: </b> <label class="label label-danger">{{ $servicio->carta_poder }}</label>
                      @elseif($servicio->carta_poder == 'No Aplica')
                        <b>Carta Poder: </b> <label class="label label-default">{{ $servicio->carta_poder }}</label>
                      @elseif($servicio->carta_poder == 'Existente')
                        <b>Carta Poder: </b> <label class="label label-info">{{ $servicio->carta_poder }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->carta_poder_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Logo -->
              @if($servicio->logo_boolean == 1)
                <li>
                  <i class="fa fa-file-image-o bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->logo_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->logo_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->logo == 'Realizado')
                        <b>Logo: </b> <label class="label label-success">{{ $servicio->logo }}</label>
                      @elseif($servicio->logo == 'Cancelado')
                        <b>Logo: </b> <label class="label label-danger">{{ $servicio->logo }}</label>
                      @elseif($servicio->logo == 'No Aplica')
                        <b>Logo: </b> <label class="label label-default">{{ $servicio->logo }}</label>
                      @elseif($servicio->logo == 'Existente')
                        <b>Logo: </b> <label class="label label-info">{{ $servicio->logo }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->logo_comentarios }}
                    </div>
                    @if($servicio->logo_url == null)
                    @else
                      <div class="timeline-body">
                        <img src="{{ asset('images/logos/'.$servicio->logo_url) }}" alt="Logo de {{ $servicio->nombre_comercial }}" class="margin" style="max-height: 250px">
                      </div>
                    @endif
                  </div>
                </li>
              @endif

              <!-- Reglas de uso -->
              @if($servicio->reglas_uso_boolean == 1)
                <li>
                  <i class="fa fa-book bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->reglas_uso_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->reglas_uso_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->reglas_uso == 'Realizado')
                        <b>Reglas de uso: </b> <label class="label label-success">{{ $servicio->reglas_uso }}</label>
                      @elseif($servicio->reglas_uso == 'Cancelado')
                        <b>Reglas de uso: </b> <label class="label label-danger">{{ $servicio->reglas_uso }}</label>
                      @elseif($servicio->reglas_uso == 'No Aplica')
                        <b>Reglas de uso: </b> <label class="label label-default">{{ $servicio->reglas_uso }}</label>
                      @elseif($servicio->reglas_uso == 'Existente')
                        <b>Reglas de uso: </b> <label class="label label-info">{{ $servicio->reglas_uso }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->reglas_uso_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Escaneo de documentos -->
              @if($servicio->escaneo_boolean == 1)
                <li>
                  <i class="fa fa-print bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->escaneo_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->escaneo_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->escaneo == 'Realizado')
                        <b>Escaneo de documentos: </b> <label class="label label-success">{{ $servicio->escaneo }}</label>
                      @elseif($servicio->escaneo == 'Cancelado')
                        <b>Escaneo de documentos: </b> <label class="label label-danger">{{ $servicio->escaneo }}</label>
                      @elseif($servicio->escaneo == 'No Aplica')
                        <b>Escaneo de documentos: </b> <label class="label label-default">{{ $servicio->escaneo }}</label>
                      @elseif($servicio->escaneo == 'Existente')
                        <b>Escaneo de documentos: </b> <label class="label label-info">{{ $servicio->escaneo }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->escaneo_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Recepcion -->
              @if($servicio->recepcion_alta_boolean == 1)
                <li>
                  <i class="glyphicon glyphicon-level-up bg-green"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->recepcion_alta_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->recepcion_alta_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->recepcion_alta == 'Realizado')
                        <b>Recepción y alta: </b> <label class="label label-success">{{ $servicio->recepcion_alta }}</label>
                      @elseif($servicio->recepcion_alta == 'Cancelado')
                        <b>Recepción y alta: </b> <label class="label label-danger">{{ $servicio->recepcion_alta }}</label>
                      @elseif($servicio->recepcion_alta == 'No Aplica')
                        <b>Recepción y alta: </b> <label class="label label-default">{{ $servicio->recepcion_alta }}</label>
                      @elseif($servicio->recepcion_alta == 'Existente')
                        <b>Recepción y alta: </b> <label class="label label-info">{{ $servicio->recepcion_alta }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->recepcion_alta_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Recepcion -->
              @if($servicio->marca_lista_ingreso_boolean == 1)
                <li>
                  <i class="glyphicon glyphicon-saved bg-green"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->marca_lista_ingreso_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->marca_lista_ingreso_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->marca_lista_ingreso == 'Realizado')
                        <b>Marca lista para ingreso: </b> <label class="label label-success">{{ $servicio->marca_lista_ingreso }}</label>
                      @elseif($servicio->marca_lista_ingreso == 'Cancelado')
                        <b>Marca lista para ingreso: </b> <label class="label label-danger">{{ $servicio->marca_lista_ingreso }}</label>
                      @elseif($servicio->marca_lista_ingreso == 'No Aplica')
                        <b>Marca lista para ingreso: </b> <label class="label label-default">{{ $servicio->marca_lista_ingreso }}</label>
                      @elseif($servicio->marca_lista_ingreso == 'Existente')
                        <b>Marca lista para ingreso: </b> <label class="label label-info">{{ $servicio->marca_lista_ingreso }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->marca_lista_ingreso_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Escaneo de documentos -->
              @if($servicio->validacion_marca_boolean == 1)
                <li>
                  <i class="glyphicon glyphicon-thumbs-up bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->validacion_marca_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->validacion_marca_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->validacion_marca == 'Realizado')
                        <b>Validación de marca en línea: </b> <label class="label label-success">{{ $servicio->validacion_marca }}</label>
                      @elseif($servicio->validacion_marca == 'Cancelado')
                        <b>Validación de marca en línea: </b> <label class="label label-danger">{{ $servicio->validacion_marca }}</label>
                      @elseif($servicio->validacion_marca == 'No Aplica')
                        <b>Validación de marca en línea: </b> <label class="label label-default">{{ $servicio->validacion_marca }}</label>
                      @elseif($servicio->validacion_marca == 'Existente')
                        <b>Validación de marca en línea: </b> <label class="label label-info">{{ $servicio->validacion_marca }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->validacion_marca_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Revisión y pago de marca -->
              @if($servicio->revision_boolean == 1)
                <li>
                  <i class="fa fa-search-plus bg-gray"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->revision_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->revision_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->revision == 'Realizado')
                        <b>Revisión y pago de marca: </b> <label class="label label-success">{{ $servicio->revision }}</label>
                      @elseif($servicio->revision == 'Cancelado')
                        <b>Revisión y pago de marca: </b> <label class="label label-danger">{{ $servicio->revision }}</label>
                      @elseif($servicio->revision == 'No Aplica')
                        <b>Revisión y pago de marca: </b> <label class="label label-default">{{ $servicio->revision }}</label>
                      @elseif($servicio->revision == 'Existente')
                        <b>Revisión y pago de marca: </b> <label class="label label-info">{{ $servicio->revision }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->revision_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Firma fiel -->
              @if($servicio->firma_fiel_boolean == 1)
                <li>
                  <i class="fa fa-file-excel-o bg-green"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->firma_fiel_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->firma_fiel_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->firma_fiel == 'Realizado')
                        <b>Firma Fiel: </b> <label class="label label-success">{{ $servicio->firma_fiel }}</label>
                      @elseif($servicio->firma_fiel == 'Cancelado')
                        <b>Firma Fiel: </b> <label class="label label-danger">{{ $servicio->firma_fiel }}</label>
                      @elseif($servicio->firma_fiel == 'No Aplica')
                        <b>Firma Fiel: </b> <label class="label label-default">{{ $servicio->firma_fiel }}</label>
                      @elseif($servicio->firma_fiel == 'Existente')
                        <b>Firma Fiel: </b> <label class="label label-info">{{ $servicio->firma_fiel }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->firma_fiel_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Impresion -->
              @if($servicio->impresion_boolean == 1)
                <li>
                  <i class="glyphicon glyphicon-print bg-green"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->impresion_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->impresion_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->impresion == 'Realizado')
                        <b>Impresión: </b> <label class="label label-success">{{ $servicio->impresion }}</label>
                      @elseif($servicio->impresion == 'Cancelado')
                        <b>Impresión: </b> <label class="label label-danger">{{ $servicio->impresion }}</label>
                      @elseif($servicio->impresion == 'No Aplica')
                        <b>Impresión: </b> <label class="label label-default">{{ $servicio->impresion }}</label>
                      @elseif($servicio->impresion == 'Existente')
                        <b>Impresión: </b> <label class="label label-info">{{ $servicio->impresion }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->impresion_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Alta en estatus -->
              @if($servicio->alta_estatus == 1)
                <li>
                  <i class="fa fa-database bg-green"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->alta_estatus_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->alta_estatus_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->alta_estatus == 'Realizado')
                        <b>Alta en Estatus: </b> <label class="label label-success">{{ $servicio->alta_estatus }}</label>
                      @elseif($servicio->alta_estatus == 'Cancelado')
                        <b>Alta en Estatus: </b> <label class="label label-danger">{{ $servicio->alta_estatus }}</label>
                      @elseif($servicio->alta_estatus == 'No Aplica')
                        <b>Alta en Estatus: </b> <label class="label label-default">{{ $servicio->alta_estatus }}</label>
                      @elseif($servicio->alta_estatus == 'Existente')
                        <b>Alta en Estatus: </b> <label class="label label-info">{{ $servicio->alta_estatus }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->alta_estatus_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Alta en control -->
              @if($servicio->alta_control_archivar_boolean == 1)
                <li>
                  <i class="glyphicon glyphicon-circle-arrow-up bg-yellow"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->alta_control_archivar_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->alta_control_archivar_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->alta_control_archivar == 'Realizado')
                        <b>Alta en Control de Servicios y Archivar: </b> <label class="label label-success">{{ $servicio->alta_control_archivar }}</label>
                      @elseif($servicio->alta_control_archivar == 'Cancelado')
                        <b>Alta en Control de Servicios y Archivar: </b> <label class="label label-danger">{{ $servicio->alta_control_archivar }}</label>
                      @elseif($servicio->alta_control_archivar == 'No Aplica')
                        <b>Alta en Control de Servicios y Archivar: </b> <label class="label label-default">{{ $servicio->alta_control_archivar }}</label>
                      @elseif($servicio->alta_control_archivar == 'Existente')
                        <b>Alta en Control de Servicios y Archivar: </b> <label class="label label-info">{{ $servicio->alta_control_archivar }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->alta_control_archivar_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Elaboracion de expediente -->
              @if($servicio->elaboracion_expediente_boolean == 1)
                <li>
                  <i class="glyphicon glyphicon-folder-close bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->elaboracion_expediente_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->elaboracion_expediente_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->elaboracion_expediente == 'Realizado')
                        <b>Elaboración de expediente a {{ $servicio->nombre_comercial }}: </b> <label class="label label-success">{{ $servicio->elaboracion_expediente }}</label>
                      @elseif($servicio->elaboracion_expediente == 'Cancelado')
                        <b>Elaboración de expediente a {{ $servicio->nombre_comercial }}: </b> <label class="label label-danger">{{ $servicio->elaboracion_expediente }}</label>
                      @elseif($servicio->elaboracion_expediente == 'No Aplica')
                        <b>Elaboración de expediente a {{ $servicio->nombre_comercial }}: </b> <label class="label label-default">{{ $servicio->elaboracion_expediente }}</label>
                      @elseif($servicio->elaboracion_expediente == 'Existente')
                        <b>Elaboración de expediente a {{ $servicio->nombre_comercial }}: </b> <label class="label label-info">{{ $servicio->elaboracion_expediente }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->elaboracion_expediente_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              <!-- Envio de expediente -->
              @if($servicio->envio_expediente_boolean == 1)
                <li>
                  <i class="fa fa-truck bg-red"></i>

                  <div class="timeline-item">
                    <b class="time" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->envio_expediente_fecha)->format('d-m-Y') }}"><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($servicio->envio_expediente_fecha)->diffForHumans() }}</b>

                    <h3 class="timeline-header">
                      @if($servicio->envio_expediente == 'Realizado')
                        <b>Envío de expediente a {{ $servicio->nombre_comercial }}: </b> <label class="label label-success">{{ $servicio->envio_expediente }}</label>
                      @elseif($servicio->envio_expediente == 'Cancelado')
                        <b>Envío de expediente a {{ $servicio->nombre_comercial }}: </b> <label class="label label-danger">{{ $servicio->envio_expediente }}</label>
                      @elseif($servicio->envio_expediente == 'No Aplica')
                        <b>Envío de expediente a {{ $servicio->nombre_comercial }}: </b> <label class="label label-default">{{ $servicio->envio_expediente }}</label>
                      @elseif($servicio->envio_expediente == 'Existente')
                        <b>Envío de expediente a {{ $servicio->nombre_comercial }}: </b> <label class="label label-info">{{ $servicio->envio_expediente }}</label>
                      @endif
                    </h3>

                    <div class="timeline-body">
                      {{ $servicio->envio_expediente_comentarios }}
                    </div>
                    <!--<div class="timeline-footer">
                      <a class="btn btn-primary btn-xs">Read more</a>
                      <a class="btn btn-danger btn-xs">Delete</a>
                    </div>-->
                  </div>
                </li>
              @endif

              
            </ul>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gris" data-dismiss="modal">
          Cerrar <span class="glyphicon glyphicon-remove"></span>
        </button>
      </div>
    </div>
  </div>
</div>