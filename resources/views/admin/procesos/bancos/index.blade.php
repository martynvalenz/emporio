<div class="tab-pane fade" id="bancos">
    <input type="hidden" id="url_listar_bancos" value="/admin/estados-cuenta-listar/">
    <input type="hidden" id="url_buscar_bancos" value="/admin/estados-cuenta-buscar/">
    <input type="hidden" id="url_actualizar_bancos" value="/admin/estados-cuenta/actualizar-egreso/">
    <input type="hidden" id="listado-parametro" value="bancos">
    <div class="row">
        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<a class="btn btn-green" id="btn-exportar-bancos"><i class="fas fa-file-excel"></i> Exportar</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <label>Búsqueda por Fechas</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                <input type="text" class="form-control pull-right centered" id="reservation_bancos" value="{{ $fecha_inicio }}  -  {{ $fecha_fin }}" autocomplete="off">
                <input type="hidden" name="fecha_inicio_bancos_reset" id="fecha_inicio_bancos_reset" value="{{ $fecha_inicio }}">
                <input type="hidden" name="fecha_fin_bancos_reset" id="fecha_fin_bancos_reset" value="{{ $fecha_fin }}">
            </div>
            <span class="help-block">
                <strong id="reservation_bancos_error" style="color:red"></strong>
            </span>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estatus de Pago</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="bancos_estatus_select" id="bancos_estatus_select" class="form-control">
                        <option value="todos">Todos</option>
                        <option value="Pagado" selected>Pagados</option>
                        <option value="Pendiente">Pendientes</option>
                        <option value="Candelado">Cancelados</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6" hidden>
            <div class="form-group">
                <label>Movimiento</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="bancos_tipo" id="bancos_tipo" class="form-control">
                        <option value="todos" selected>Todos</option>
                        <option value="Ingreso">Ingresos</option>
                        <option value="Despacho">Despacho</option>
                        <option value="Personal">Personales</option>
                        <option value="Hogar">Hogar</option>
                        <option value="Nomina">Nómina</option>
                        <option value="Aguinaldo">Aguinaldos</option>
                        <option value="Comision">Comisiones</option>
                        <option value="Traspaso">Traspasos</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Cuenta</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
                    <select id="bancos_cuenta_select" class="form-control">
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
                    <select id="bancos_formas_pago_select" class="form-control">
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
                    <input type="text" name="buscar-bancos" id="buscar-bancos" placeholder="Buscar..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar-bancos" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                    <a id="btn-borrar-bancos" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <h2 style="color: green" id="bancos_ingresos_totales"></h2>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
            <h2 style="color: red" id="bancos_egresos_totales"></h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado-bancos"></div>
        </div>
    </div>
</div>