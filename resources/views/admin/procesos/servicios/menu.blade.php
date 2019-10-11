<div class="modal fade modal-slide-in-right" aria-text="true" role="dialog" tabindex="-1" id="menu">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="menu-title"></h4>
				<input type="hidden" id="id_servicio_menu" name="id_servicio_menu" style="color: black">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-text="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<table class="table table-hover table-bordered table-striped">
							<thead>
								<tr>
									<th>Comision</th>
									<th>Total</th>
									<th>Disponible</th>
								</tr>
							</thead>
							<tbody>
								<tr id="venta_habilitada">
									<td>Venta</td>
									<td align="right" id="total_venta"></td>
									<td align="right" id="disponible_venta"></td>
								</tr>
								<tr id="operativa_habilitada">
									<td>Operaciones</td>
									<td align="right" id="total_operativa"></td>
									<td align="right" id="disponible_operativa"></td>
								</tr>
								<tr id="gestion_habilitada">
									<td>Gestión</td>
									<td align="right" id="total_gestion"></td>
									<td align="right" id="disponible_gestion"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6" id="tipo_comision_select">
						<div class="form-group">
							<label for="id_cliente" class="control-label">Tipo de Comisión <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-list"></i></span>
								<select id="tipo_comision" class="form-control">
									<option value="">-Sin selección-</option>
									<option value="Venta" id="venta_habilitada_select">Venta</option>
									<option value="Gestión" id="gestion_habilitada_select">Gestión</option>
									<option value="Operativa" id="operativa_habilitada_select">Operativa</option>
								</select>
							</div>
							<span class="help-block">
							    <strong id="tipo_comision_error" style="color:red"></strong>
							</span>
						</div>                
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6" id="tipo_comision_input" hidden>
						<div class="form-group">
							<label for="id_cliente" class="control-label">Tipo de Comisión <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-list"></i></span>
								<input type="text" id="tipo_comision_input_val" disabled class="form-control">
								<input type="hidden" id="tipo_comision_val">
							</div>
							<span class="help-block">
							    <strong id="tipo_comision_val_error" style="color:red"></strong>
							</span>
						</div>                
					</div>
					<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
						<div class="form-group">
							<label class="control-label">Monto disponible</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
								<input type="text" id="monto_disponible_comision" name="monto_disponible_comision" class="form-control" style="text-align: center">
								<input type="hidden" id="monto_disponible_comision_val">
								<input type="hidden" id="monto_disponible_val">
								<input type="hidden" id="monto_max">
							</div>
							<span class="help-block">
							    <strong id="monto_disponible_comision_error" style="color:red"></strong>
							</span>
						</div>                
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
							<label class="control-label">Usuario <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-user"></i></span>
								<select class="form-control" name="usuario_comision" id="usuario_comision">
									<option value="">-Sin selección-</option>
									@foreach($admins as $admin)
										@if ($admin->id == Auth::user()->id)
											<option value="{{ $admin->id }}" selected>{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
										@else
											<option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
										@endif
									@endforeach
								</select>
							</div>
							<span class="help-block">
							    <strong id="usuario_comision_error" style="color:red"></strong>
							</span>
						</div>              
					</div>
					<div class="col-lg-3 col-md-6 col-sm-4 col-xs-12">
						<div class="form-group">
							<label class="control-label">Porcentaje <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-percent"></i></span>
								<input type="number" step="any" max="100" min="1" class="form-control" name="porcentaje_comision" id="porcentaje_comision" autocomplete="off" style="text-align: center" data-tooltip="tooltip" title="Presionar el botón 'Enter' para actualizar el monto">
								<div class="input-group-btn">
									<a id="btn-actualizar-porcentaje-comision" class="btn btn-warning" data-tooltip="tooltip" title="Actualizar porcentaje"><i class="fas fa-sync"></i></a>
								</div>
							</div>
							<span class="help-block">
							    <strong id="porcentaje_comision_error" style="color:red"></strong>
							</span>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-4 col-xs-12">
						<div class="form-group">
							<label class="control-label">Monto de Comision <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
								<input type="number" step="any" class="form-control" name="monto_comision_usuario" id="monto_comision_usuario" autocomplete="off" style="text-align: center" data-tooltip="tooltip" title="Presionar el botón 'Enter' para actualizar el porcentaje">
								<input type="hidden" id="listo_comision">
							</div>
							<span class="help-block">
							    <strong id="monto_comision_usuario_error" style="color:red"></strong>
							</span>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
						<div class="form-group">
							<label>20% de comisión</label>
							<div class="checkbox checkbox-css">
								<input type="checkbox" id="aplica_repartir_comision" />
								<label for="aplica_repartir_comision">Aplicar</label>
							</div>
						</div>
						<input type="hidden" id="aplica_repartir_comision_check" value="0">
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
							<label class="control-label">Usuario 20%</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-user"></i></span>
								<select class="form-control" name="usuario_repartir_comision" id="usuario_repartir_comision">
									<option value="">-Sin selección-</option>
									@foreach($admins as $admin)
										<option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
									@endforeach
								</select>
							</div>
							<span class="help-block">
							    <strong id="usuario_repartir_comision_error" style="color:red"></strong>
							</span>
						</div>              
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label">Comentarios</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-comment-alt"></i></span>
								<textarea id="comentarios_comision" rows="2" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="row pull-left">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<input type="hidden" id="id_comision">
						<button type="button" id="btn-guardar-comision" class="btn btn-success btn-flat" title="Actualizar datos de la factura" data-tooltip="tooltip">
							Guardar <i class="fas fa-save"></i></span>
						</button>
						<a class="btn btn-danger btn-flat" id="btn-cancelar-comision">Borrar <i class="fas fa-times"></i></a>
						<a class="btn btn-grey" data-dismiss="modal">Cerrar </a>
					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div id="comisiones-listado"></div>
				</div>

			</div>
		</div>
	</div>
</div>


