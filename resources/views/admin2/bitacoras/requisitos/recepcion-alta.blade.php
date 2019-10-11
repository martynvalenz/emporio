<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-recepcion-alta-requisitos">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="modal-title-recepcion-alta-requisitos" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fas fa-sign-in-alt"></i> Recepción y alta en Estatus</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input style="text-align: center" type="text" name="recepcion_alta_fecha_requisitos" id="recepcion_alta_fecha_requisitos" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="recepcion_alta_requisitos_error" style="color:red"></strong>
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
										<select class="form-control" name="recepcion_alta_requisitos" id="recepcion_alta_requisitos" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="fa fa-print" aria-hidden="true"></i> Escaneo</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input style="text-align: center" type="text" name="escaneo_fecha_requisitos" id="escaneo_fecha_requisitos" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="escaneo_requisitos_error" style="color:red"></strong>
									</span>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-success"><i class="fa fa-bullhorn"></i></label>
										</span>
										<select class="form-control" name="escaneo_requisitos" id="escaneo_requisitos" style="width: 100%;">
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
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<h3 style="text-align: center"><i class="fas fa-calendar-alt" aria-hidden="true"></i> Fecha de Vencimiento</h3>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
									</span>
									<input style="text-align: center" type="text" name="vencimiento_tramite_fecha_requisitos" id="vencimiento_tramite_fecha_requisitos" class="form-control datepicker" autocomplete="off">
								</div>
								<span class="help-block">
								    <strong id="vencimiento_tramite_requisitos_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_servicio_recepcion_requisitos" id="id_servicio_recepcion_requisitos">
					<input type="hidden" name="id_control_recepcion_requisitos" id="id_control_recepcion_requisitos">
					<input type="hidden" name="id_cliente_recepcion_requisitos" id="id_cliente_recepcion_requisitos">
					<input type="hidden" name="id_admin_recepcion_requisitos" id="id_admin_recepcion_requisitos" value="{{ Auth::user()->id }}">
					<input name="_token_recepcion_requisitos" value="{{ csrf_token() }}" type="hidden">
					<input id="fecha_recepcion_requisitos" type="hidden" class="datepicker">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						Cerrar
					</button>
					<a id="btn-recepcion-requisitos" class="btn btn-primary btn-flat">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar <i class="fas fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>