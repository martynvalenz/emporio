<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-elaboracion-notificacion-requisitos">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="modal-title-notificacion-requisitos" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fas fa-clipboard-list"></i> Elaboración de Notificación</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input style="text-align: center" type="text" name="elaboracion_notificacion_agradecimiento_fecha_requisitos" id="elaboracion_notificacion_agradecimiento_fecha_requisitos" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="elaboracion_notificacion_agradecimiento_requisitos_error" style="color:red"></strong>
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
										<select class="form-control" name="elaboracion_notificacion_agradecimiento_requisitos" id="elaboracion_notificacion_agradecimiento_requisitos" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="fas fa-paper-plane"></i> Envío de Notificación</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input style="text-align: center" type="text" name="envio_notificacion_fecha_requisitos" id="envio_notificacion_fecha_requisitos" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="envio_notificacion_requisitos_error" style="color:red"></strong>
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
										<select class="form-control" name="envio_notificacion_requisitos" id="envio_notificacion_requisitos" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="fas fa-money-bill-alt"></i></th> Fecha de cobro</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input style="text-align: center" type="text" name="pago_fecha_requisitos" id="pago_fecha_requisitos" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="pago_requisitos_error" style="color:red"></strong>
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
										<select class="form-control" name="pago_requisitos" id="pago_requisitos" style="width: 100%;">
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
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_servicio_elaboracion_notificacion_requisitos" id="id_servicio_elaboracion_notificacion_requisitos">
					<input type="hidden" name="id_control_elaboracion_notificacion_requisitos" id="id_control_elaboracion_notificacion_requisitos">
					<input type="hidden" name="id_cliente_elaboracion_notificacion_requisitos" id="id_cliente_elaboracion_notificacion_requisitos">
					<input type="hidden" name="id_admin_elaboracion_notificacion_requisitos" id="id_admin_elaboracion_notificacion_requisitos" value="{{ Auth::user()->id }}">
					<input name="_token_elaboracion_notificacion_requisitos" value="{{ csrf_token() }}" type="hidden">
					<input id="fecha_elaboracion_notificacion_requisitos" type="hidden" class="datepicker">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						Cerrar
					</button>
					<a id="btn-elaboracion-notificacion-requisitos" class="btn btn-primary btn-flat">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar <i class="fas fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>