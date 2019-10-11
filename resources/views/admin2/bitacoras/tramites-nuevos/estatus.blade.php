<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-estatus">
	<form action="">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">

						<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
							<h3><i class="fas fa-book"></i> Asignar servicio a una de las Bitácoras de Estatus</h3>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-primary"><i class="fa fa-hourglass-half"></i> Bitácora Estatus</label>
										</span>
										<select class="form-control" name="id_bitacoras_estatus_tramites" id="id_bitacoras_estatus_tramites" style="width: 100%;">
											<option value="">-Seleccionar-</option>
											@foreach($bitacoras_estatus as $est)
												<option value="{{ $est->id }}">{{ $est->clave }} - {{ $est->bitacora }}</option>
											@endforeach
			                     		</select>
			                     		<input type="hidden" id="id_bitacoras_estatus_tramites_value">
									</div>
									<span class="help-block">
									    <strong id="id_bitacoras_estatus_tramites_error" style="color:red"></strong>
									</span>
								</div>
						</div>
						
					</div>

					<div class="row" id="tipo_bitacora">
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Fecha de inicio</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-calendar-alt"></i>
									</span>
									<input type="text" name="fecha_inicio_tramites" id="fecha_inicio_tramites" class="form-control datepicker" autocomplete="off" style="text-align: center">
									<div class="input-group-btn">
										<a class="btn btn-warning btn-flat" title="Actualizar fechas" data-tooltip="tooltip" id="btn-actualizar-fechas"><i class="glyphicon glyphicon-refresh"></i></a>
									</div>
								</div>
								<span class="help-block">
								    <strong id="fecha_inicio_tramites_error" style="color:red"></strong>
								</span>								
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Comprobación de uso</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-calendar-alt"></i>
									</span>
									<input type="text" name="fecha_comprobacion_uso_tramites" id="fecha_comprobacion_uso_tramites" class="form-control datepicker" autocomplete="off" style="text-align: center">
								</div>	
								<span class="help-block">
								    <strong id="fecha_comprobacion_uso_tramites_error" style="color:red"></strong>
								</span>								
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Fecha de Vencimiento</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-calendar-alt"></i>
									</span>
									<input type="text" name="fecha_vencimiento_tramites" id="fecha_vencimiento_tramites" class="form-control datepicker" autocomplete="off" style="text-align: center">
								</div>	
								<span class="help-block">
								    <strong id="fecha_vencimiento_tramites_error" style="color:red"></strong>
								</span>							
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Expediente</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-hashtag"></i>
									</span>
									<input type="text" name="numero_expediente_tramites" id="numero_expediente_tramites" class="form-control" autocomplete="off" style="text-align: center">
								</div>	
								<span class="help-block">
								    <strong id="numero_expediente_tramites_error" style="color:red"></strong>
								</span>							
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Registro</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-hashtag"></i>
									</span>
									<input type="text" name="numero_registro_tramites" id="numero_registro_tramites" class="form-control" autocomplete="off" style="text-align: center">
								</div>	
								<span class="help-block">
								    <strong id="numero_registro_tramites_error" style="color:red"></strong>
								</span>								
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Estatus</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-bookmark"></i>
									</span>
									<select name="estatus_tramites" id="estatus_tramites" class="form-control">
										<option value="">-Seleccionar Estatus-</option>
										@foreach($listado_estatus as $estatus)
											<option value="{{ $estatus->id }}">{{ $estatus->estatus }}</option>
										@endforeach
									</select>
								</div>	
								<span class="help-block">
								    <strong id="estatus_tramites_error" style="color:red"></strong>
								</span>								
							</div>
						</div>

					</div>
					<div class="row">
						<input type="hidden" id="id_estatus_tramites">
						<input type="hidden" id="id_marca_tramites">
						<input type="hidden" id="id_cliente_tramites">
						<input type="hidden" id="id_clase_tramites">
						<input type="hidden" id="id_servicio_tramites">
						<input type="hidden" id="id_admin_tramites" value="{{ Auth::user()->id }}">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<button type="button" id="btn-guardar-estatus-tramites" class="btn btn-primary btn-flat" id="btn-activar-bitacora" title="Guardar cambios al estatus" data-tooltip="tooltip">
								<span class="fas fa-save"></span> Guardar
							</button>
							<button type="button" class="btn btn-warning btn-flat" onclick="LimpiarEstatus()" title="Borrar datos de formulario" data-tooltip="tooltip">Borrar <i class="fas fa-eraser"></i></button>
						</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3><i class="fas fa-book"></i> Actualizar estatus</h3>
							<br>
							<div id="listado-estatus"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>