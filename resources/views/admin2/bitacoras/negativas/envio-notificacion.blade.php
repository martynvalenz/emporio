<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-envio-notificacion-negativa">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="modal-title-envio-notificacion-negativa" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fa fa-search-plus" aria-hidden="true"></i> Envío de Notificación</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-share-square"></i></label>
										</span>
										<input style="text-align: center" type="text" name="envio_notificacion_fecha_negativa" id="envio_notificacion_fecha_negativa" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="envio_notificacion_negativa_error" style="color:red"></strong>
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
										<select class="form-control" name="envio_notificacion_negativa" id="envio_notificacion_negativa" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="fas fa-user"></i> Respuesta del cliente</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-share-square"></i></label>
										</span>
										<input style="text-align: center" type="text" name="respuesta_cliente_fecha_negativa" id="respuesta_cliente_fecha_negativa" class="form-control datepicker" autocomplete="off">
										<input type="hidden" id="respuesta_cliente_fecha_negativa_val">
									</div>
									<span class="help-block">
									    <strong id="respuesta_cliente_negativa_error" style="color:red"></strong>
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
										<select class="form-control" name="respuesta_cliente_negativa" id="respuesta_cliente_negativa" style="width: 100%;">
					                        <option value="" selected>-</option>
											<option value="Realizado">Realizado</option>
											<option value="No Aplica">No Aplica</option>
											<option value="Cancelado">Cancelado</option>
			                     		</select>
			                     		<input type="hidden" id="respuesta_cliente_negativa_val">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Respuesta del Cliente</label>
							<textarea name="respuesta_cliente_comentarios_negativa" id="respuesta_cliente_comentarios_negativa" rows="3" class="form-control"></textarea>
							<input type="hidden" id="respuesta_cliente_comentarios_negativa_value">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_servicio_envio_notificacion_negativa" id="id_servicio_envio_notificacion_negativa">
					<input type="hidden" name="id_control_envio_notificacion_negativa" id="id_control_envio_notificacion_negativa">
					<input type="hidden" name="id_cliente_envio_notificacion_negativa" id="id_cliente_envio_notificacion_negativa">
					<input type="hidden" name="id_admin_envio_notificacion_negativa" id="id_admin_envio_notificacion_negativa" value="{{ Auth::user()->id }}">
					<input name="_token_envio_notificacion_negativa" value="{{ csrf_token() }}" type="hidden">
					<input id="fecha_envio_notificacion_negativa" type="hidden" class="datepicker">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						Cerrar
					</button>
					<a id="btn-envio-notificacion-negativa" class="btn btn-primary btn-flat">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar <i class="fas fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>