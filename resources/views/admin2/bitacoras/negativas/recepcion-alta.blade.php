<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-recepcion-alta">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="modal-title-recepcion-alta-negativa" style="color: white;"></h4>
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
										<input style="text-align: center" type="text" name="alta_estatus_fecha_negativa" id="alta_estatus_fecha_negativa" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="alta_estatus_negativa_error" style="color:red"></strong>
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
										<select class="form-control" name="alta_estatus_negativa" id="alta_estatus_negativa" style="width: 100%;">
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
										<input style="text-align: center" type="text" name="escaneo_fecha_negativa" id="escaneo_fecha_negativa" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="escaneo_negativa_error" style="color:red"></strong>
									</span>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-success"><i class="fa fa-bullhorn"></i></label>
										</span>
										<select class="form-control" name="escaneo_negativa" id="escaneo_negativa" style="width: 100%;">
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
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<h3 style="text-align: center"><i class="fas fa-calendar-alt" aria-hidden="true"></i> Fecha de Vencimiento</h3>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
									</span>
									<input style="text-align: center" type="text" name="vencimiento_tramite_fecha_negativa" id="vencimiento_tramite_fecha_negativa" class="form-control datepicker" autocomplete="off">
								</div>
								<span class="help-block">
								    <strong id="vencimiento_tramite_negativa_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_servicio_recepcion_negativa" id="id_servicio_recepcion_negativa">
					<input type="hidden" name="id_control_recepcion_negativa" id="id_control_recepcion_negativa">
					<input type="hidden" name="id_cliente_recepcion_negativa" id="id_cliente_recepcion_negativa">
					<input type="hidden" name="id_admin_recepcion_negativa" id="id_admin_recepcion_negativa" value="{{ Auth::user()->id }}">
					<input name="_token_recepcion_negativa" value="{{ csrf_token() }}" type="hidden">
					<input id="fecha_recepcion_negativa" type="hidden" class="datepicker">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						Cerrar
					</button>
					<a id="btn-alta-estatus-negativa" class="btn btn-primary btn-flat">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar <i class="fas fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>