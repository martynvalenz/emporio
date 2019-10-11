<div class="tab-pane fade" id="egresos">
    <input type="hidden" id="url_listar_egresos" value="/admin/egresos-listado/">
    <input type="hidden" id="url_buscar_egresos" value="/admin/egresos-buscar/">
    <input type="hidden" id="url_actualizar_egresos" value="/admin/egresos-actualizar/">
    <input type="hidden" id="listado-parametro" value="egresos">
    <input type="hidden" id="fecha_inicio_anio" value="{{ $fecha_inicio_anio }}">
    <input type="hidden" id="fecha_fin_anio" value="{{ $fecha_fin_anio }}">
    <div class="row">
        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	
                <a data-target="#modal-egreso" data-toggle="modal" class="btn btn-info" title="Agregar egreso de Despacho, Hogar o Personal" data-tooltip="tooltip" onclick="CreateEgreso()"><i class="fa fa-plus"></i> Egreso</a>
                <a data-target="#modal-egreso-comision" data-toggle="modal" class="btn btn-info" title="Pago de Comisiones" data-tooltip="tooltip" onclick="CreateComision()"><i class="fas fa-hand-holding-usd"></i> Comision</a>
                <a data-target="#modal-nomina" onclick="Nomina()" data-toggle="modal" class="btn btn-success" title="Pago de Nómina" data-tooltip="tooltip"><i class="fas fa-hand-holding-usd"></i> Nómina</a>
        	    <a data-target="#modal-traspaso" data-toggle="modal" onclick="CreateTraspaso()" class="btn btn-purple" title="Traspaso entre cuentas" data-tooltip="tooltip"><i class="fas fa-exchange-alt"></i> Traspasos</a>
                @include('admin.procesos.egresos.egreso')
                @include('admin.procesos.egresos.comision')
        	    <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
        	    <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/2fexCxVeqq0?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
        
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <label>Búsqueda por Fechas</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                <input type="text" class="form-control pull-right centered" id="reservation_egresos" value="{{ $fecha_inicio }}  -  {{ $fecha_fin }}" autocomplete="off">
                <input type="hidden" name="fecha_inicio_egresos_reset" id="fecha_inicio_egresos_reset" value="{{ $fecha_inicio }}">
                <input type="hidden" name="fecha_fin_egresos_reset" id="fecha_fin_egresos_reset" value="{{ $fecha_fin }}">
            </div>
            <span class="help-block">
                <strong id="reservation_egresos_error" style="color:red"></strong>
            </span>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estatus de Pago</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="egresos_estatus_select" id="egresos_estatus_select" class="form-control">
                        <option value="todos">Todos</option>
                        <option value="Pagado" selected>Pagados</option>
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
                    <select name="egresos_tipo" id="egresos_tipo" class="form-control">
                        <option value="todos" selected>Todos</option>
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
                    <select id="egresos_cuenta_select" class="form-control">
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
                    <select id="egresos_formas_pago_select" class="form-control">
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
                    <input type="text" name="buscar-egresos" id="buscar-egresos" placeholder="Buscar..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar-egresos" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                    <a id="btn-borrar-egresos" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2 id="egreso_monto_total_filtro"></h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado-egresos"></div>
        </div>
    </div>
</div>