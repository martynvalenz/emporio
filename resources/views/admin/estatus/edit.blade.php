<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-editar">
	<form action="">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3><i class="fas fa-book"></i> Asignar servicio a una de las Bitácoras de Estatus</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="">Seleccionar Estatus</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-hourglass-half"></i>
									</span>
									<select class="form-control" name="id_bitacoras_estatus_tramites" id="id_bitacoras_estatus_tramites">
										<option value="" selected>-Seleccionar-</option>
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

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="">Seleccionar Subcategoría</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-book"></i>
									</span>
									<select class="form-control" name="subcategoria_estatus_tramites" id="subcategoria_estatus_tramites">
										<option value="">-Seleccionar-</option>
		                     		</select>
		                     		<input type="hidden" id="id_subcategoria_estatus_tramites">
								</div>
								<span class="help-block">
								    <strong id="subcategoria_estatus_tramites_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>

					<div class="row" hidden>
						<input type="number" class="centered" id="comprobacion_uso_tramites">
						<input type="number" class="centered" id="recordatorio_tramites">
						<input type="number" class="centered" id="vencimiento_tramites">

						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6" >
							<div class="form-group">
								<label for="">¿Declara su uso?</label>
								<div class="checkbox checkbox-css">
									<input type="checkbox" id="comprueba_uso" disabled/>
									<label for="comprueba_uso">Sí</label>
								</div>
							</div>
							<input type="text" name="comprueba_uso_check" id="comprueba_uso_check" value="0">
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
									<input type="text" name="fecha_inicio_tramites" id="fecha_inicio_tramites" class="form-control datepicker-autoClose centered">
									<div class="input-group-btn">
										<a class="btn btn-warning btn-flat" title="Actualizar fechas" data-tooltip="tooltip" id="btn-actualizar-fechas"><i class="fas fa-sync"></i></a>
									</div>
								</div>
								<span class="help-block">
								    <strong id="fecha_inicio_tramites_error" style="color:red"></strong>
								</span>								
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Declaración de uso</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-calendar-alt"></i>
									</span>
									<input type="text" name="fecha_comprobacion_uso_tramites" id="fecha_comprobacion_uso_tramites" class="form-control datepicker-autoClose centered" autocomplete="off">
								</div>	
								<span class="help-block">
								    <strong id="fecha_comprobacion_uso_tramites_error" style="color:red"></strong>
								</span>								
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Fecha de Recordatorio</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-calendar-alt"></i>
									</span>
									<input type="text" name="fecha_recordatorio_tramites" id="fecha_recordatorio_tramites" class="form-control datepicker-autoClose centered" autocomplete="off">
								</div>	
								<span class="help-block">
								    <strong id="fecha_recordatorio_tramites_error" style="color:red"></strong>
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
									<input type="text" name="fecha_vencimiento_tramites" id="fecha_vencimiento_tramites" class="form-control datepicker-autoClose centered" autocomplete="off">
								</div>	
								<span class="help-block">
								    <strong id="fecha_vencimiento_tramites_error" style="color:red"></strong>
								</span>							
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Expediente</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-hashtag"></i>
									</span>
									<input type="text" name="numero_expediente_tramites" id="numero_expediente_tramites" class="form-control centered" autocomplete="off">
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
									<input type="text" name="numero_registro_tramites" id="numero_registro_tramites" class="form-control centered" autocomplete="off">
								</div>	
								<span class="help-block">
								    <strong id="numero_registro_tramites_error" style="color:red"></strong>
								</span>								
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Estatus</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fas fa-bookmark"></i>
									</span>
									<select name="estatus_tramites" id="estatus_tramites" class="form-control ">
										<option value="">-Seleccionar Estatus-</option>
										@foreach($listado_estatus as $listado)
											<option value="{{ $listado->id }}_{{ $listado->color }}_{{ $listado->texto }}">{{ $listado->estatus }}</option>
										@endforeach
									</select>
									<input type="hidden" id="id_estatus_val">
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
						<input type="hidden" id="id_catalogo_servicio_tramites">
						<input type="hidden" id="renovacion_tramites">
						<input type="hidden" id="estatus_boolean">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<a id="btn-guardar-estatus-tramites" class="btn btn-primary btn-flat" id="btn-activar-bitacora" title="Guardar cambios al estatus" data-tooltip="tooltip">
								<span class="fas fa-save"></span> Guardar
							</a>
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
					<button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>