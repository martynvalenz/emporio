<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-terminar-requisitos">
	<form>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="modal-title-terminar-requisitos" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<h3><i class="fas fa-archive"></i> Alta en Control y Archivar</h3>
							<br>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-info"><i class="far fa-calendar-alt"></i> Fecha</label>
									</span>
									<input type="text" name="alta_control_archivar_fecha_requisitos" id="alta_control_archivar_fecha_requisitos" class="form-control datepicker" autocomplete="off" style="text-align: center">
									<input type="hidden" id="alta_control_archivar_fecha_requisitos_val">
								</div>
								<span class="help-block">
								    <strong id="alta_control_archivar_error" style="color:red"></strong>
								</span>
							</div>
							<br>
						</div>
					
					
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-success"><i class="fa fa-bullhorn"></i> Estatus</label>
									</span>
									<select class="form-control" name="alta_control_archivar_requisitos" id="alta_control_archivar_requisitos" style="width: 100%;">
				                        <option value="" selected>-</option>
										<option value="Realizado">Realizado</option>
										<option value="No Aplica">No Aplica</option>
										<option value="Cancelado">Cancelado</option>
		                     		</select>
		                     		<input type="hidden" id="alta_control_archivar_requisitos_val">
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
									<select class="form-control" name="estatus_tramite_requisitos" id="estatus_tramite_requisitos" style="width: 100%;">
                    						<option value="Pendiente">Pendiente</option>
                                            <option value="Terminado">Terminado</option>
                                            <option value="Cancelado">Cancelado</option>
                                            <option value="No Registro">No Registro</option>
		                     		</select>
								</div>
								<span class="help-block">
								    <strong id="estatus_tramite_requisitos_error" style="color:red"></strong>
								</span>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_servicio_terminar_requisitos" id="id_servicio_terminar_requisitos">
					<input type="hidden" name="id_control_terminar_requisitos" id="id_control_terminar_requisitos">
					<input type="hidden" name="id_cliente_terminar_requisitos" id="id_cliente_terminar_requisitos">
					<input type="hidden" name="id_admin_terminar_requisitos" id="id_admin_terminar_requisitos" value="{{ Auth::user()->id }}">
					<input name="_token_terminar_requisitos" value="{{ csrf_token() }}" type="hidden">
					<input id="fecha_terminar_requisitos" type="hidden" class="datepicker">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						Cerrar
					</button>
					<a id="btn-terminar-requisitos" class="btn btn-primary btn-flat">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar <i class="fas fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>