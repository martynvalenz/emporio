<div class="tab-pane fade" id="tarjetas">
    <input type="hidden" id="url_listar_tarjetas" value="/admin/tarjetas-listado/">
    <input type="hidden" id="url_buscar_tarjetas" value="/admin/tarjetas-buscar/">
    <input type="hidden" id="url_actualizar_tarjetas" value="/admin/tarjetas-actualizar/">
    <input type="hidden" id="listado-parametro_tarjetas" value="tarjetas">
    <input type="hidden" id="fecha_inicio_anio_tarjetas" value="{{ $fecha_inicio_anio }}">
    <input type="hidden" id="fecha_fin_anio_tarjetas" value="{{ $fecha_fin_anio }}">
    <div class="row">
        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	
                <a data-target="#modal-tarjeta-credito" data-toggle="modal" class="btn btn-info" title="Agregar egreso de Tarjeta de crédito" data-tooltip="tooltip" onclick="CrearTarjetaCredito()"><i class="fa fa-plus"></i> Egreso</a>
                @include('admin.procesos.tarjetas-credito.tarjeta-credito')
                <a class="btn btn-success"><i class="fas fa-credit-card"></i> Pagar Tarjeta</a>
        
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <label>Búsqueda por Fechas</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                <input type="text" class="form-control pull-right centered" id="reservation_tarjetas" value="{{ $fecha_inicio }}  -  {{ $fecha_fin }}" autocomplete="off">
                <input type="hidden" name="fecha_inicio_tarjetas_reset" id="fecha_inicio_tarjetas_reset" value="{{ $fecha_inicio }}">
                <input type="hidden" name="fecha_fin_tarjetas_reset" id="fecha_fin_tarjetas_reset" value="{{ $fecha_fin }}">
            </div>
            <span class="help-block">
                <strong id="reservation_tarjetas_error" style="color:red"></strong>
            </span>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estatus de Pago</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="tarjetas_estatus_select" id="tarjetas_estatus_select" class="form-control">
                        <option value="todos" selected>Todos</option>
                        <option value="Pagado">Pagados</option>
                        <option value="Pendiente">Pendientes</option>
                        <option value="Candelado">Cancelados</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Tipo de Egreso</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="tarjetas_tipo" id="tarjetas_tipo" class="form-control">
                        <option value="todos" selected>Todos</option>
                        <option value="Despacho">Despacho</option>
                        <option value="Personal">Personales</option>
                        <option value="Hogar">Hogar</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Cuenta</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
                    <select id="tarjetas_cuenta_select" class="form-control">
                        <option value="todos">Todas</option>
                        @foreach($cuentas as $cuenta)
                            <option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label>Buscar</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                    <input type="text" name="buscar-tarjetas" id="buscar-tarjetas" placeholder="Buscar..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar-tarjetas" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                    <a id="btn-borrar-tarjetas" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado-tarjetas"></div>
        </div>
    </div>
</div>