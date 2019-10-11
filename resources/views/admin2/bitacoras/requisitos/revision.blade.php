<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-revision-requisitos">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="modal-title-revision-requisitos" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fas fa-search"></i> Revisión</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input style="text-align: center" type="text" name="revision_fecha_requisitos" id="revision_fecha_requisitos" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="revision_requisitos_error" style="color:red"></strong>
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
										<select class="form-control" name="revision_requisitos" id="revision_requisitos" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="fas fa-clipboard-check"></i> Presentación</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input style="text-align: center" type="text" name="presentacion_fecha_requisitos" id="presentacion_fecha_requisitos" class="form-control datepicker" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="presentacion_requisitos_error" style="color:red"></strong>
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
										<select class="form-control" name="presentacion_requisitos" id="presentacion_requisitos" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="fas fa-database"></i> Alta en Estatus</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input style="text-align: center" type="text" name="alta_estatus_fecha_requisitos" id="alta_estatus_fecha_requisitos" class="form-control datepicker" autocomplete="off">
										<input type="hidden" id="alta_estatus_fecha_requisitos_val">
									</div>
									<span class="help-block">
									    <strong id="alta_estatus_requisitos_error" style="color:red"></strong>
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
										<select class="form-control" name="alta_estatus_requisitos" id="alta_estatus_requisitos" style="width: 100%;">
					                        <option value="" selected>-</option>
											<option value="Realizado">Realizado</option>
											<option value="No Aplica">No Aplica</option>
											<option value="Cancelado">Cancelado</option>
			                     		</select>
			                     		<input type="hidden" id="alta_estatus_requisitos_val">
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3><i class="fas fa-book"></i> Asignar servicio a una de las Bitácoras de Estatus</h3>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-primary"><i class="fa fa-hourglass-half"></i> Bitácora Estatus</label>
										</span>
										<select class="form-control" name="id_bitacoras_estatus_requisitos" id="id_bitacoras_estatus_requisitos" style="width: 100%;">
											<option value="">-Seleccionar-</option>
											@foreach($bitacoras_estatus as $est)
												<option value="{{ $est->id }}">{{ $est->clave }} - {{ $est->bitacora }}</option>
											@endforeach
			                     		</select>
			                     		<input type="hidden" id="id_bitacoras_estatus_requisitos_value">
									</div>
									<span class="help-block">
								    <strong id="id_bitacoras_estatus_requisitos_error" style="color:red"></strong>
								</span>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_servicio_revision_requisitos" id="id_servicio_revision_requisitos">
					<input type="hidden" name="id_control_revision_requisitos" id="id_control_revision_requisitos">
					<input type="hidden" name="id_cliente_revision_requisitos" id="id_cliente_revision_requisitos">
					<input type="hidden" name="id_admin_revision_requisitos" id="id_admin_revision_requisitos" value="{{ Auth::user()->id }}">
					<input name="_token_revision_requisitos" value="{{ csrf_token() }}" type="hidden">
					<input id="fecha_revision_requisitos" type="hidden" class="datepicker">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						Cerrar
					</button>
					<a id="btn-revision-requisitos" class="btn btn-primary btn-flat">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar <i class="fas fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>