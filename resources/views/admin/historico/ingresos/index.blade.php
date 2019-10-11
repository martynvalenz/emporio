<div class="tab-pane fade" id="ingresos">
    <input type="hidden" id="url_listar_ingresos" value="/admin/ingresos-listado/">
    <input type="hidden" id="url_buscar_ingresos" value="/admin/ingresos-buscar/">
    <input type="hidden" id="url_actualizar_ingresos" value="/admin/ingresos-actualizar/">
    <input type="hidden" id="listado-parametro" value="ingresos">
    <div class="row">
        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	   <a data-target="#agregar-cliente" data-toggle="modal" onclick="CrearCliente()" class="btn btn-info" title="Agregar cliente nuevo" data-tooltip="tooltip"><i class="fa fa-user-plus"></i> Agregar Cliente</a>
                <a data-target="#modal-ingreso" data-toggle="modal" class="btn btn-primary" title="Agregar ingreso de cliente o personal" data-tooltip="tooltip" onclick="CreateIngreso()"><i class="fa fa-plus"></i> Ingreso</a>
        
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <label>Búsqueda por Fechas</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                <input type="text" class="form-control pull-right centered" id="reservation_ingresos" value="{{ $fecha_inicio }}  -  {{ $fecha_fin }}" autocomplete="off">
                <input type="hidden" name="fecha_inicio_ingresos_reset" id="fecha_inicio_ingresos_reset" value="{{ $fecha_inicio }}">
                <input type="hidden" name="fecha_fin_ingresos_reset" id="fecha_fin_ingresos_reset" value="{{ $fecha_fin }}">
            </div>
            <span class="help-block">
                <strong id="reservation_ingresos_error" style="color:red"></strong>
            </span>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estatus de Pago</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="ingresos_estatus_select" id="ingresos_estatus_select" class="form-control">
                        <option value="todos" selected>Todos</option>
                        <option value="Pagado">Pagados</option>
                        <option value="Pendiente">Pendientes</option>
                        <option value="Candelado">Cancelados</option>
                    </select>
                </div>
            </div>
        </div>
        <!--<div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Tipo de Egreso</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="ingresos_tipo" id="ingresos_tipo" class="form-control">
                        <option value="todos" selected>Todos</option>
                        
                    </select>
                </div>
            </div>
        </div>-->
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Cuenta</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
                    <select id="ingresos_cuenta_select" class="form-control">
                        <option value="todos">Todas</option>
                        @foreach($cuentas as $cuenta)
                            <option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Formas de Pago</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-credit-card"></i></span>
                    <select id="ingresos_formas_pago_select" class="form-control">
                        <option value="todos">Todas</option>
                        @foreach($formas_pago as $pago)
                            <option value="{{ $pago->id }}">{{ $pago->codigo }} - {{ $pago->forma_pago }}</option>
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
                    <input type="text" name="buscar-ingresos" id="buscar-ingresos" placeholder="Buscar..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar-ingresos" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                    <a id="btn-borrar-ingresos" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado-ingresos"></div>
        </div>
    </div>
</div>