<div class="modal fade modal-slide-in-right" aria-text="true" role="dialog" tabindex="-1" id="agregar-servicio">
	<form role="form" action="{{ route('procesos.post') }}" method="post">
		{{ csrf_field() }}
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" id="encabezado">
				<h4 class="modal-title" style="color: white;" id="encabezado-servicio"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-text="true"><b>&times;</b></span>
				</button>
			</div>
			
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-9 col-md-8 col-sm-12 col-xs-12"> 
						<div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
							<label for="">Seleccionar Cliente <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-trophy"></i></span>
								<select class="form-control default-select2" name="id_cliente" id="id_cliente_agregar" data-live-search="true" data-style="btn-info">
								</select>
							</div>
							<span class="help-block">
							    <strong id="id_cliente_agregar_error" style="color:red"></strong>
							</span>
						</div>
					</div>

					<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
						<div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
							<label for="">Fecha <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-calendar"></i></span>
								<input type="text" class="form-control datepicker-autoClose centered" name="fecha" id="fecha_servicio" autocomplete="off">
							</div>
							<span class="help-block">
							    <strong id="fecha_servicio_error" style="color:red"></strong>
							</span>
						</div>
					</div>
				</div>
			
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="form-group">
						<label for="id_control_agregar" class="control-label">Trámite, Marca, Obra o Patente</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-registered"></i></span>
							<select name="id_control" id="id_control_agregar" class="form-control">
								<option value="">-Seleccionar Marca-</option>
							</select>
							<div class="input-group-btn">  
								<a class="btn btn-info btn-flat" id="btn-marca" data-tooltip="tooltip" title="Agregar marca" onclick="MostrarModalMarca()"><i class="fas fa-plus"></i></a>
							 	@include('admin.procesos.servicios.marca-agregar')
							</div>
						</div>
						<span class="help-block">
						    <strong id="id_control_agregar_error" style="color:red"></strong>
						</span>
						</div>                
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="clase" class="control-label">Clase</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
								<select class="form-control" name="id_clase" id="clase">
									<option value="">-Sin selección-</option>
									@foreach($clases as $clase)
										<option value="{{ $clase->id }}" title="{{ $clase->clase }}" data-tooltip="tooltip">{{ $clase->clave }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group {{ $errors->has('id_catalogo_servicio') ? ' has-error' : '' }}">
						<label for="id_catalogo_servicio_agregar" class="control-label">Seleccionar Servicio <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
								<select class="form-control" id="id_cat" name="id_catalogo_servicio_agregar">
									<option value="">-Seleccionar Servicio-</option>
								</select>
								<input type="hidden" name="id_catalogo_servicio" id="id_catalogo_servicio">
							</div>
							<span class="help-block">
							    <strong id="id_catalogo_servicio_agregar_error" style="color:red"></strong>
							</span>
						</div>                
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label for="tramite" class="control-label">Descripción del Servicio</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-comment-alt"></i></span>
								<input type="text" class="form-control" name="tramite" id="tramite" autocomplete="off">
							</div>
							<span class="help-block">
							    <strong id="tramite_error" style="color:red"></strong>
							</span>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label class="control-label">Concepto de costo <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-bars" aria-text="true"></i></span>
								<select class="form-control" id="concepto_costo" name="concepto_costo">
									<option value="Neto">Neto</option>
									<option value="Porcentaje">Porcentaje</option>
									<option value="por Proyecto">por Proyecto</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="moneda" class="control-label">Moneda <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
								<select class="form-control" id="moneda" disabled>
									@foreach($monedas as $moneda)
										<option value="{{ $moneda->clave }}">{{ $moneda->clave }} - {{ $moneda->moneda }}</option>
									@endforeach
								</select>
								<input type="hidden" name="moneda" id="moneda_val">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="costo_servicio" class="control-label">Costo Emporio</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
								<input type="number" step="any" id="costo_servicio" name="costo_servicio" class="form-control" title="Costo del servicio" style="text-align: center">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group {{ $errors->has('costo') ? ' has-error' : '' }}">
							<label for="costo_ini" class="control-label">Precio del Servicio</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
								<input type="number" step="any" id="costo_ini" class="form-control" disabled style="text-align: center">
								<input type="hidden" id="costo_ini_val" name="costo_ini" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group {{ $errors->has('tipo_cambio') ? ' has-error' : '' }}">
							<label class="control-label">Tipo de cambio <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
								<input type="number" step="any" id="tipo_cambio_val" name="tipo_cambio" min="1" class="form-control" style="text-align: center" title="Conversión de moneda" data-tooltip="tooltip">
								<input type="hidden" id="tipo_cambio_anterior">
								<div class="input-group-btn">  
									<button type="button" class="btn btn-warning" id="btn_tipo_cambio" data-tooltip="tooltip" title="Aplicar cambio" onclick="event.preventDefault();"><i class="far fa-money-bill-alt"></i></button>
								</div>
							</div>
							<span class="help-block">
							    <strong id="tipo_cambio_error" style="color:red"></strong>
							</span>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="porcentaje_descuento" class="control-label">%Descuento</label>
							<div class="input-group">
								<span class="input-group-addon"><i>%</i></span>
								<input type="number" step="any" max="100" min="0" name="porcentaje_descuento" id="porcentaje_descuento" class="form-control" value="0" style="text-align: center">
								<div class="input-group-btn">  
									<button type="button" class="btn btn-warning" id="btn_porcentaje_descuento" data-tooltip="tooltip" title="Aplicar el porcentaje de descuento" onclick="event.preventDefault();"><i class="fas fa-percent"></i></button>
								</div>
							</div>
							<span class="help-block">
							    <strong id="porcentaje_descuento_error" style="color:red"></strong>
							</span>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="descuento" class="control-label">Descuento</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
								<input type="number" step="any" name="descuento" id="descuento" class="form-control" value="0" style="text-align: center">
								<div class="input-group-btn">  
									<button type="button" class="btn btn-warning" id="btn_descuento" data-tooltip="tooltip" title="Aplicar el descuento" onclick="event.preventDefault();"><i class="fas fa-minus"></i></button>
								</div>
							</div>
							<span class="help-block">
							    <strong id="descuento_error" style="color:red"></strong>
							</span>
						</div>
					</div>

					<div class="col-lg-3 col-md-5 col-sm-4 col-xs-12">
						<div class="form-group {{ $errors->has('costo') ? ' has-error' : '' }}">
							<label for="costo" class="control-label">Precio sin IVA <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon" style="background-color: green"><i style="color:white" class="far fa-money-bill-alt"></i></span>
								<input type="number" step="any" name="costo" id="costo" class="form-control" style="text-align: center">
								<input type="hidden" step="any" id="costo_final" class="form-control" style="text-align: center">
								<div class="input-group-btn">  
									<a class="btn btn-warning" id="bt_actualizar" data-tooltip="tooltip" title="Actualizar montos de comisiones (para comisiones de porcentajes)" onclick="event.preventDefault();"><i class="fas fa-sync"></i></A>
								</div>
							</div>
							<span class="help-block">
							    <strong id="costo_error" style="color:red"></strong>
							</span>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h4>Bitácora</h4>
					</div>
					<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group {{ $errors->has('id_bitacoras') ? ' has-error' : '' }}">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-book"></i></span>
								<select class="form-control" name="id_bitacoras" id="id_bitacoras">
									<option value="">-Seleccionar Bitácora-</option>
									@foreach($bitacoras as $bitacora)
										<option value="{{ $bitacora->id }}">{{ $bitacora->clave }} - {{ $bitacora->bitacora }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						<div class="form-group">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="mostrar_bitacora" @if(Auth::user()->Role->Role->id == '1' || Auth::user()->Role->Role->id == '2' || Auth::user()->Role->Role->id == '3') @else disabled @endif/>
								<label for="mostrar_bitacora" @if(Auth::user()->Role->Role->id == '1' || Auth::user()->Role->Role->id == '2' || Auth::user()->Role->Role->id == '3') @else disabled @endif>¿Mostrar en Bitácora?</label>
							</div>
						</div>
						<input type="hidden" name="mostrar_bitacora" id="mostrar_bitacora_check">
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
						<div class="form-group">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="asignar_costo_servicio" />
								<label for="asignar_costo_servicio">¿Asignar costo de servicio?</label>
							</div>
						</div>
						<input type="hidden" name="asignar_costo_servicio_check" id="asignar_costo_servicio_check">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group {{ $errors->has('id_admin') ? ' has-error' : '' }}">
							<label for="id_admin_servicio" class="control-label">Responsable <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-user"></i></span>
								<select class="form-control" name="id_admin" id="id_admin_servicio">
									@foreach($admins as $admin)
										@if ($admin->id == Auth::user()->id)
											<option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
										@else
											<option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<span class="help-block">
							    <strong id="id_admin_error" style="color:red"></strong>
							</span>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h4>Comisión de Venta</h4>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-bars" aria-text="true"></i></span>
								<select class="form-control" id="concepto_venta" disabled>
									<option value=""></option>
									<option value="Monto Fijo">Monto Fijo</option>
									<option value="Porcentaje">Porcentaje</option>
									<option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
									<option value="Dolares">Dolares</option>
								</select>
							<input type="hidden" id="concepto_venta_val" name="concepto_venta">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
								<input type="number" step="any" id="comision_venta" class="form-control centered" disabled>
								<input type="hidden" id="comision_venta_val" name="comision_venta">
								<input type="hidden" id="comision_venta_constante">
								<input type="hidden" id="porcentaje_comision_venta" name="porcentaje_comision_venta">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="aplica_comision_venta" />
								<label for="aplica_comision_venta">¿Aplica comisión?</label>
							</div>
						</div>
						<input type="hidden" name="aplica_comision_venta" id="aplica_comision_venta_check">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h4>Comisión Operativa</h4>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-bars" aria-text="true"></i></span>
								<select class="form-control" id="concepto_operativo" disabled>
									<option value=""></option>
									<option value="Monto Fijo">Monto Fijo</option>
									<option value="Porcentaje">Porcentaje</option>
									<option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
									<option value="Dolares">Dolares</option>
								</select>
							<input type="hidden" id="concepto_operativo_val" name="concepto_operativo">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
								<input type="number" step="any" id="comision_operativa" class="form-control centered" disabled>
								<input type="hidden" name="comision_operativa" id="comision_operativa_val">
								<input type="hidden" id="porcentaje_comision_operativa" name="porcentaje_comision_operativa">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="aplica_comision_operativa" />
								<label for="aplica_comision_operativa">¿Aplica comisión?</label>
							</div>
						</div>
						<input type="hidden" name="aplica_comision_operativa" id="aplica_comision_operativa_check">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h4>Comisión por Gestión</h4>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-bars" aria-text="true"></i></span>
								<select class="form-control" id="concepto_gestion" disabled>
									<option value=""></option>
									<option value="Monto Fijo">Monto Fijo</option>
									<option value="Porcentaje">Porcentaje</option>
									<option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
									<option value="Dolares">Dolares</option>
								</select>
							<input type="hidden" id="concepto_gestion_val" name="concepto_gestion">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
								<input type="number" step="any" id="comision_gestion" class="form-control centered" disabled>
								<input type="hidden" name="comision_gestion" id="comision_gestion_val">
								<input type="hidden" id="comision_gestion_constante">
								<input type="hidden" id="porcentaje_comision_gestion" name="porcentaje_comision_gestion">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="aplica_comision_gestion" />
								<label for="aplica_comision_gestion">¿Aplica comisión?</label>
							</div>
						</div>
						<input type="hidden" name="aplica_comision_gestion" id="aplica_comision_gestion_check">
					</div>
				</div>
			</div>
			<div id="listado-proceso" hidden></div>

			<div class="modal-footer">
				<input type="hidden" value="Pendiente" name="estatus_tramite" id="estatus_tramite">
				<input type="hidden" name="id_servicio" id="id_servicio">
				<input type="hidden" name="saldo" id="saldo">
				<input type="hidden" name="cobrado" id="cobrado">
				<input type="hidden" name="cobrado_terminado" id="cobrado_terminado">
				<input type="hidden" id="accion">
				<input type="hidden" id="editar_servicio" value="0">
				<input type="hidden" id="avance_total_servicio" name="avance_total">

				
				<button type="button" class="btn btn-grey" data-dismiss="modal">
					Cerrar <span class="fas fa-times"></span>
				</button>
				<button type="button" id="btn-servicio-nuevo" class="btn btn-primary"><span class="fas fa-save"> </span> Guardar</button>
				<button type="submit" id="btn-servicio-nuevo2" class="btn btn-success"><span class="fas fa-save"> </span> Guardar</button>
			</div>
		</div>
	</div>
	</form>
</div>
