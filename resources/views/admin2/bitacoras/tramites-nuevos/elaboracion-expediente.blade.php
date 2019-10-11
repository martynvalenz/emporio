<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-elaboracion-expediente">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title-elaboracion" id="modal-title-envio-expediente-tramite" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="glyphicon glyphicon-folder-close"></i> Elaboración de Expediente</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="elaboracion_expediente_fecha_elaboracion" id="elaboracion_expediente_fecha_elaboracion" class="form-control datepicker" autocomplete="off" style="text-align: center">
									</div>
									<span class="help-block">
									    <strong id="elaboracion_expediente_fecha_elaboracion_error" style="color:red"></strong>
									</span>
								</div>
								<br>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-success"><i class="fa fa-bullhorn"></i></label>
										</span>
										<select class="form-control" name="elaboracion_expediente_elaboracion" id="elaboracion_expediente_elaboracion" style="width: 100%;">
					                        <option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fa fa-truck"></i> Envío de Expediente al cliente</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="envio_expediente_fecha_elaboracion" id="envio_expediente_fecha_elaboracion" class="form-control datepicker" autocomplete="off" style="text-align: center">
									</div>
									<span class="help-block">
									    <strong id="envio_expediente_fecha_elaboracion_error" style="color:red"></strong>
									</span>
								</div>
								<br>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-success"><i class="fa fa-bullhorn"></i></label>
										</span>
										<select class="form-control" name="envio_expediente_elaboracion" id="envio_expediente_elaboracion" style="width: 100%;">
					                        <option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
									</div>
								</div>
							</div>
						</div>
						
					</div>

					<div class="row">

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label>Estatus de Trámite</label>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-success"><i class="fa fa-bookmark"></i> Trámite</label>
									</span>
									<select class="form-control" name="estatus_tramite_tramites_nuevos" id="estatus_tramite_tramites_nuevos" style="width: 100%;">
										<option value="Pendiente">Pendiente</option>
				                        <option value="Terminado">Terminado</option>
				                        <option value="Cancelado">Cancelado</option>		                     		</select>
								</div>
								<span class="help-block">
								    <strong id="estatus_tramite_tramites_nuevos_error" style="color:red"></strong>
								</span>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_servicio_elaboracion" id="id_servicio_elaboracion">
					<input type="hidden" name="id_control_elaboracion" id="id_control_elaboracion">
					<input type="hidden" name="id_cliente_elaboracion" id="id_cliente_elaboracion">
					<input name="_token_elaboracion" value="{{ csrf_token() }}" type="hidden">
					<input id="fecha_elaboracion" type="hidden" class="datepicker">
					<input id="presentacion_fecha" type="hidden" class="datepicker">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						Cerrar
					</button>
					<a id="btn-elaboracion-expediente" class="btn btn-primary btn-flat">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar <i class="fas fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>