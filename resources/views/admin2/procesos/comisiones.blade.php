<form>
	<div class="modal-body">
		<div class="row">
			<div class="row-lg-6 col-md-6 col-sm-12 col-xs-12">
				<table class="table table-hover table-bordered table-responsive table-striped">
					<thead>
						<tr>
							<th>Comision</th>
							<th>Total</th>
							<th>Disponible</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Venta</td>
							<td align="right" id="total_venta"></td>
							<td align="right" id="disponible_venta"></td>
						</tr>
						<tr>
							<td>Operaciones</td>
							<td align="right" id="total_operativa"></td>
							<td align="right" id="disponible_operativa"></td>
						</tr>
						<tr>
							<td>Gestión</td>
							<td align="right" id="total_gestion"></td>
							<td align="right" id="disponible_gestion"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" id="tipo_comision_select">
				<div class="form-group">
					<label for="id_cliente" class="control-label">Tipo de Comisión <b style="color:red">*</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fas fa-list"></i></span>
						<select id="tipo_comision" class="form-control">
							<option value="">-Sin selección-</option>
							<option value="Venta">Venta</option>
							<option value="Gestión">Gestión</option>
							<option value="Operativa">Operativa</option>
						</select>
					</div>
					<span class="help-block">
					    <strong id="tipo_comision_error" style="color:red"></strong>
					</span>
				</div>                
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6" id="tipo_comision_input" hidden>
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
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
			<!--<div class="col-4 col-md-4 col-sm-4 col-xs-6">
				<div class="form-group" text id="gerencia_operativa_id">
					<br>
					<label for="gerencia_operativa" class="container">20% de gerencia operativa
						<input type="checkbox" name="gerencia_operativa" id="gerencia_operativa">
						<span class="checkmark"></span>
					</label>
				</div>
				<input type="text" name="gerencia_operativa_check" id="gerencia_operativa_check">
			</div>-->
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
				<div class="form-group">
					<label class="control-label">Responsable <b style="color:red">*</b></label>
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
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
				<div class="form-group">
					<label class="control-label">Porcentaje <b style="color:red">*</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fas fa-percent"></i></span>
						<input type="number" step="any" max="100" min="1" class="form-control" name="porcentaje_comision" id="porcentaje_comision" autocomplete="off" style="text-align: center" data-tooltip="tooltip" title="Presionar el botón 'Enter' para actualizar el monto">
						<div class="input-group-btn">
							<a id="btn-actualizar-porcentaje-comision" class="btn btn-warning" data-tooltip="tooltip" title="Actualizar porcentaje"><i class="glyphicon glyphicon-refresh"></i></a>
						</div>
					</div>
					<span class="help-block">
					    <strong id="porcentaje_comision_error" style="color:red"></strong>
					</span>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
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
				<input type="hidden" value="{{ Auth::user()->id }}" id="id_admin_comision">
				<input type="hidden" id="id_comision">
				<input id="_token_comisiones" value="{{ csrf_token() }}" type="hidden">
				<button type="button" id="btn-guardar-comision" class="btn btn-success btn-flat" title="Actualizar datos de la factura" data-tooltip="tooltip">
					Guardar <i class="fas fa-save"></i></span>
				</button>
				<a class="btn btn-gris btn-flat" id="btn-cancelar-comision">Cancelar <i class="fas fa-times"></i></a>
				<button type="button" class="btn btn-gris btn-flat btn-cerrar-actualizar" data-dismiss="modal">
					Cerrar y Actualizar <i class="fas fa-sync"></i></span>
				</button>
			</div>
		</div>
		<br>
		<hr>
		<div class="row">
			<div id="comisiones-listado"></div>
		</div>

	</div>
</form>