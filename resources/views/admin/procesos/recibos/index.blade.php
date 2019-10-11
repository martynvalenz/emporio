<div class="tab-pane fade" id="recibos">
    <input type="hidden" id="url_listar_recibos" value="/admin/recibos-listado/">
    <input type="hidden" id="url_buscar_recibos" value="/admin/recibos-buscar/">
    <input type="hidden" id="url_actualizar_recibos" value="/admin/recibos-actualizar/">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
        	<div class="btn-group">
        	    <a data-target="#agregar-cliente" data-toggle="modal" onclick="CrearCliente()" class="btn btn-info" title="Agregar cliente nuevo" data-tooltip="tooltip"><i class="fa fa-user-plus"></i> Agregar Cliente</a>
        	    <a class="btn btn-primary" data-toggle="modal" data-target="#modal-recibo" data-tooltip="tooltip" title="Agregar recibo" onclick="CreateRecibo()"><i class="fas fa-plus"></i> Recibo Nuevo <i class="fas fa-receipt"></i>
        	    </a>
        	    <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
        	    <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/9xYpITZRCk0?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
        	</div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12" hidden>
            <label>Búsqueda por Fechas</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                <input type="text" class="form-control pull-right centered" id="reservation_recibo" value="{{ $fecha_inicio }}  -  {{ $fecha_fin }}" autocomplete="off">
                <input type="hidden" name="fecha_inicio_reset_recibo" id="fecha_inicio_reset_recibo" value="{{ $fecha_inicio }}">
                <input type="hidden" name="fecha_fin_reset_recibo" id="fecha_fin_reset_recibo" value="{{ $fecha_fin }}">
            </div>
            <span class="help-block">
                <strong id="reservation_recibo_error" style="color:red"></strong>
            </span>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
            <div class="form-group">
                <label>Estatus</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="recibos_select" id="recibos_select" class="form-control">
                        <option value="todas" selected>Todos</option>
                        <option value="Pagada">Pagadas</option>
                        <option value="Pendiente">Pendientes</option>
                        <option value="Cancelada">Canceladas</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label>Buscar</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                    <input type="text" name="buscar-recibo" id="buscar-recibo" placeholder="Buscar..." class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar-recibo" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                    <a id="btn-borrar-recibo" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado-recibos"></div>
        </div>
    </div>
</div>