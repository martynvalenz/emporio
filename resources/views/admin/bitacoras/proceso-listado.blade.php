@if(count($procesos) > 0)
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 centered">
            <span>
                <label style="color: #49ADAD; padding-right: 1.5em;">Jurídico</label>
                <!--<label style="color: #F49C31; padding-right: 1.5em;">Administración</label>-->
                <label style="color: #EE5755; padding-right: 1.5em;">Gestión</label>
                <label style="color: #2d5986; padding-right: 1.5em;">Operaciones</label>
            </span>
        </div>
    </div>
    <hr>
    @if($servicium->asignar_costo_servicio == 1 && $servicium->costo_pagado == 1)
        <!--<div class="checkbox checkbox-css">
            <input type="checkbox" checked disabled>
            <label style="color: green">Pago realizado</label>
        </div>-->
    @elseif($servicium->asignar_costo_servicio == 1 && $servicium->costo_pagado == 0 && $servicium->costo_servicio <= $servicium->cobrado)
        <div class="checkbox checkbox-css">
            <input type="checkbox" id="gestionar_pago" onclick="GestionarPago({{ $servicium->id }})" @if($servicium->gestionar_pago == 1) checked @else unchecked @endif>
            <label for="gestionar_pago">Gestionar pago de servicio (IMPI/INADEM): $ {{ number_format($servicium->costo_servicio) }}</label>
        </div>
        <input type="hidden" id="gestionar_pago_check" @if($servicium->gestionar_pago == 1) value="1" @else value="0" @endif>
        <hr>
    @elseif($servicium->asignar_costo_servicio == 1 && $servicium->costo_pagado == 0 && $servicium->costo_servicio > $servicium->cobrado)
        <div><b style="color: red">*</b> No se puede gestionar el pago de honorarios hasta que esté liquidado el servicio.</div>
        <hr>
    @elseif($servicium->asignar_costo_servicio == 0)
        <div>El servicio no tiene costo de honorarios.</div>
        <hr>
    @else

    @endif
    @foreach($procesos as $proceso)
        <div class="checkbox checkbox-css">
            <input type="checkbox"  id="paso-{{ $proceso->id }}" @if($proceso->id_requisitos == 38 || $proceso->id_requisitos == 14) disabled @else class="checkbox_proceso"  @endif @if($proceso->estatus == 1) value="1" checked @else value="0" unchecked @endif onclick="Check({{ $proceso->id }}, {{ $proceso->id_servicio }}, {{ $proceso->libera_venta }}, {{ $proceso->libera_operativa }}, {{ $proceso->libera_gestion }}, {{ $proceso->registro }}, '{{ $proceso->id_control }}', '{{ $proceso->categoria }}', '{{ Auth::user()->area }}')"
                 />
            <label for="paso-{{ $proceso->id }}"
                @if($proceso->categoria == 'Jurídico') style="color: #49ADAD" 
                @elseif($proceso->categoria == 'Administración') style="color: #F49C31"
                @elseif($proceso->categoria == 'Gestión') style="color: #EE5755" 
                @elseif($proceso->categoria == 'Operaciones') style="color: #2d5986" 
                @endif>{{ $proceso->requisito }}</label>
        </div>
        <input type="hidden" value="{{ $proceso->estatus }}" id="estatus_val-{{ $proceso->id }}">
    @endforeach

@elseif(count($procesos) == 0 && count($requisitos) > 0)
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h5 for="">El servicio no cuenta aún con un proceso</h5>
            <a onclick="GenerarProceso({{ $servicium->id }})" class="btn btn-success btn-block btn-generar-proceso">Dar clic aquí para Generar Proceso <i class="fas fa-list"></i></a>
        </div>
    </div>
    <br>
    <div class="row" hidden>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="process-list" class="table headerfix table-striped table-bordered table-condensed table-hover display no-wrap cell-border">
                <tbody>
                    @foreach($requisitos as $key => $listado)
                    <tr>
                        <td>{{ $listado->id }}</td>
                        <td>{{ $listado->orden }}</td>
                        <td>{{ $listado->libera_venta }}</td>
                        <td>{{ $listado->libera_operativa }}</td>
                        <td>{{ $listado->libera_gestion }}</td>
                        <td>{{ $listado->registro }}</td>
                        <td>{{ $listado->id_requisitos }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <h5 style="color: red">* Este servicio no tiene proceso, y no se puede generar uno debido a que el catálogo no cuenta con un check list, si desea crear un check list, dar clic <a href="{{ route('servicios.index') }}" target="_blank">Aquí</a></h5>
@endif
<br>

<div class="row">
    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="" class="control-label">Estatus del proceso</span></label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
                <select name="estatus_registro_bitacora" id="estatus_registro_bitacora" class="form-control">
                    @if($servicium->estatus_registro == 'Pendiente')
                        <option value="Pendiente" selected>Pendiente</option>
                        <option value="Terminado">Terminado</option>
                        <option value="No Registro">No Registro</option>
                        <option value="Cancelado">Cancelado</option>
                    @elseif($servicium->estatus_registro == 'Terminado')
                        <option value="Pendiente">Pendiente</option>
                        <option value="Terminado" selected>Terminado</option>
                        <option value="No Registro">No Registro</option>
                        <option value="Cancelado">Cancelado</option>
                    @elseif($servicium->estatus_registro == 'No Registro')
                        <option value="Pendiente">Pendiente</option>
                        <option value="Terminado">Terminado</option>
                        <option value="No Registro" selected>No Registro</option>
                        <option value="Cancelado">Cancelado</option>
                    @elseif($servicium->estatus_registro == 'Cancelado')
                        <option value="Pendiente">Pendiente</option>
                        <option value="Terminado">Terminado</option>
                        <option value="No Registro">No Registro</option>
                        <option value="Cancelado" selected>Cancelado</option>
                    @endif
                </select>
                <div class="input-group-btn">
                    <a id="btn-guardar-estatus-tramite" onclick="GuardarEstatusTramite()" class="btn btn-green" title="Guardar estatus" data-tooltip="tooltip"><i class="fas fa-save"></i></a>
                </div>
                <a style="margin-left: 0.5em" data-tooltip="tooltip"
                    @if($servicium->id_control == '' || $servicium->fecha_registro == '')
                        class="btn btn-grey" disabled title="No se puede enviar el servicio a estatus debido a que no tiene marca o fecha de registro"  
                    @else 
                        class="btn btn-primary" title="Pasar servicio a Bitácoras de Estatus" data-toggle="modal" data-target="#modal-estatus"
                        @if($servicium->id_estatus == '') 
                            onclick="Estatus({{ $servicium->id }}, 0, {{ $servicium->id_control }}, '{{ $servicium->marca }}', {{ $servicium->id_cliente }}, {{ $servicium->id_catalogo_servicio }}, {{ $servicium->id_clase }})" 
                        @else 
                            onclick="Estatus({{ $servicium->id }}, {{ $servicium->id_estatus }}, {{ $servicium->id_control }}, '{{ $servicium->marca }}', {{ $servicium->id_cliente }}, {{ $servicium->id_catalogo_servicio }}, {{ $servicium->id_clase }})" 
                        @endif
                    @endif
                    ><i class="fas fa-external-link-square-alt"></i>
                </a>
            </div>
            <span class="help-block">
                <strong id="estatus_registro_error" style="color:red"></strong>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <form enctype="multipart/form-data">
            <div class="form-group">
                <label for="" class="control-label">Cargar Logo <span style="color: #9fa6ad">(Opcional)</span></label>
                <a data-toggle="modal" data-target="#modal-cargar-logo" onclick="CargarLogoModal({{ $servicium->id }})" class="btn btn-primary btn-block">Dar clic para cargar logo <i class="fas fa-image"></i></a>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <img src="{{ asset('images/logos/'.$servicium->logo_url) }}" alt="" style="max-width: 300px; height: auto;" id="logo_url_bitacora">
    </div>
</div>
<input type="hidden" id="id_catalogo_servicio_proceso" value="{{ $servicium->id_catalogo_servicio }}">
<input type="hidden" id="avance_parcial_bitacora" value="{{ $servicium->avance }}">
<input type="hidden" id="avance_total_bitacora" value="{{ $servicium->avance_total }}">











