<div class="tab-pane fade show active" id="financiamientos">
    <input type="hidden" name="id_sesion" id="id_sesion" value="{{ Auth::user()->id }}">
    <!--<input type="hidden" name="url_listar" id="url_listar" value="/admin/financiamientos-listar/">
    <input type="hidden" name="url_buscar" id="url_buscar" value="/admin/financiamientos-buscar/">
    <input type="hidden" name="url_actualizar" id="url_actualizar" value="/admin/financiamientos/actualizar/">-->
    <input type="hidden" id="listado-parametro" value="servicio">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <div class="btn-group">
                <a data-target="#agregar-cliente" data-toggle="modal" onclick="CrearCliente()" class="btn btn-info" title="Agregar cliente nuevo" data-tooltip="tooltip"><i class="fa fa-user-plus"></i> Agregar Cliente</a>
                <a class="btn btn-primary" data-toggle="modal" data-target="#agregar-servicio" data-tooltip="tooltip" title="Agregar servicio" id="btn-agregar-servicio"><i class="fa fa-plus"></i> Servicio Nuevo <i class="glyphicon glyphicon-copy"></i>
                </a>
                @include('admin.procesos.servicios.servicio')
                <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
                <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/ZEZT6OowzOE?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <label>Búsqueda por Fechas</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                <input type="text" class="form-control pull-right centered" id="reservation" value="{{ $fecha_inicio }}  -  {{ $fecha_fin }}" autocomplete="off">
                <input type="hidden" name="fecha_inicio_reset" id="fecha_inicio_reset" value="{{ $fecha_inicio }}">
                <input type="hidden" name="fecha_fin_reset" id="fecha_fin_reset" value="{{ $fecha_fin }}">
            </div>
            <span class="help-block">
                <strong id="reservation_error" style="color:red"></strong>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estatus Cobranza</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="servicios_select" id="servicios_select" class="form-control">
                        <option value="todos" selected>Todos</option>
                        <option value="Pagado">Pagados</option>
                        <option value="Pendiente">Pendientes</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Trámite</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="servicios_tramite" id="servicios_tramite" class="form-control">
                        <option value="todos" selected>Todos</option>
                        <option value="Terminado">Terminados</option>
                        <option value="Pendiente">Pendientes</option>
                        <option value="sin Bitacora">sin Bitácoras</option>
                        <option value="No Registro">No Registro</option>
                        <option value="Cancelado">Cancelados</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
                <label>Buscar</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                    <input type="text" name="buscar" id="buscar" placeholder="Buscar por cliente, marca o # de servicio..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i></a>
                    <a id="btn-borrar" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i></a>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
                <label>Buscar por Factura o Recibo</label>
                <div class="input-group">
                    <span class="input-group-addon"><i>#</i></span>
                    <input type="text" name="buscar-folio" id="buscar-folio" placeholder="Buscar folio..." title="Buscar por folio" class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar-folio" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i></a>
                    <a id="btn-borrar-folio" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado-servicio"></div>
        </div>
    </div>
    @include('admin.procesos.servicios.comentarios')
    @include('admin.procesos.servicios.menu')
    @include('admin.procesos.servicios.factura')
    @include('admin.procesos.servicios.pagar-factura')
</div>