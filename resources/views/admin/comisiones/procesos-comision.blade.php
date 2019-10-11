<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar_comision">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Agregar comisión</h4>
			</div>
			<form id="agregarForm" role="form" action="{{ route('procesos.edit-creado', $servicio->id) }}" method="get">
			{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Tipo de Comisión *</label>
								<div class="input-group {{ $errors->has('tipo_comision') ? ' has-error' : '' }}">
									<span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
									<select id="tipo_comision_select" class="form-control">
										<option value="">-Sin selección-</option>
										@if($servicio->aplica_comision_venta == 1)
											<option value="{{ $servicio->comision_venta_restante }}_Venta">Venta</option>
										@endif
										@if($servicio->aplica_comision_operativa == 1)
											<option value="{{ $servicio->comision_operativa_restante }}_Operativa">Operativa</option>
										@endif
										@if($servicio->aplica_comision_gestion == 1)
											<option value="{{ $servicio->comision_gestion_restante }}_Gestión">Gestión</option>
										@endif
									</select>
								</div>
								@if ($errors->has('tipo_comision'))
								  <span class="help-block">
								      <strong>{{ $errors->first('tipo_comision') }}</strong>
								  </span>
								@endif
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Monto Disponible</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
									<input type="number" id="monto_select" class="form-control" disabled>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Usuario *</label>
								<div class="input-group {{ $errors->has('id_admin') ? ' has-error' : '' }}">
									<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
									<select name="id_admin" id="id_admin" class="form-control">
										<option value="">-Sin selección-</option>
										@foreach($admins as $admin)
											<option value="{{ $admin->id }}">{{ $admin->iniciales }} {{ $admin->nombre }} {{ $admin->apellido }}</option>
										@endforeach
									</select>
								</div>
								@if ($errors->has('id_admin'))
								  <span class="help-block">
								      <strong>{{ $errors->first('id_admin') }}</strong>
								  </span>
								@endif
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Monto de Comisión *</label>
								<div class="input-group {{ $errors->has('monto') ? ' has-error' : '' }}">
									<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
									<input type="number" id="monto" name="monto" class="form-control">
								</div>
								@if ($errors->has('monto'))
								  <span class="help-block">
								      <strong>{{ $errors->first('monto') }}</strong>
								  </span>
								@endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Comentarios</label>
							<textarea name="comentarios" id="comentarios" rows="3" class="form-control"></textarea>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<input type="hidden" id="tipo_comision_val" name="tipo_comision">
					<input type="hidden" id="monto_restante" name="monto_restante">
					<input type="hidden" name="concepto" value="Comisión">
					<input type="hidden" name="estatus" value="Pendiente">
					<input type="hidden" value="{{ $servicio->id }}" name="id_servicio" id="id_servicio">
					<input type="hidden" value="{{ $servicio->listo_comision_venta }}" name="listo_comision_venta" id="listo_comision_venta">
					<input type="hidden" value="{{ $servicio->listo_comision_operativa }}" name="listo_comision_operativa" id="listo_comision_operativa">
					<input type="hidden" value="{{ $servicio->listo_comision_gestion }}" name="listo_comision_gestion" id="listo_comision_gestion">
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="button" class="btn btn-primary" onclick="event.preventDefault();" id="btn_agregar">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>