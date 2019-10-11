<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-recepcion">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="modal-title-recepcion" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="glyphicon glyphicon-level-up"></i> Recepción</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="recepcion_alta_fecha_recepcion" id="recepcion_alta_fecha_recepcion" class="form-control datepicker" autocomplete="off" style="text-align: center">
									</div>
									<span class="help-block">
									    <strong id="recepcion_alta_recepcion_error" style="color:red"></strong>
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
										<select class="form-control" name="recepcion_alta_recepcion" id="recepcion_alta_recepcion" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="glyphicon glyphicon-saved"></i> Marca lista para ingreso</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="marca_lista_ingreso_fecha_recepcion" id="marca_lista_ingreso_fecha_recepcion" class="form-control datepicker" autocomplete="off" style="text-align: center">
									</div>
									<span class="help-block">
									    <strong id="marca_lista_ingreso_recepcion_error" style="color:red"></strong>
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
										<select class="form-control" name="marca_lista_ingreso_recepcion" id="marca_lista_ingreso_recepcion" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="glyphicon glyphicon-thumbs-up"></i> Validación de marca en línea</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="validacion_marca_fecha_recepcion" id="validacion_marca_fecha_recepcion" class="form-control datepicker" autocomplete="off" style="text-align: center">
									</div>
									<span class="help-block">
									    <strong id="validacion_marca_recepcion_error" style="color:red"></strong>
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
										<select class="form-control" name="validacion_marca_recepcion" id="validacion_marca_recepcion" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="fa fa-search-plus"></i> Revisión y pago de marca</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="revision_fecha_recepcion" id="revision_fecha_recepcion" class="form-control datepicker" autocomplete="off" style="text-align: center">
									</div>
									<span class="help-block">
									    <strong id="revision_recepcion_error" style="color:red"></strong>
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
										<select class="form-control" name="revision_recepcion" id="revision_recepcion" style="width: 100%;">
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
							<h3 style="text-align: center"><i class="fas fa-file-excel"></i> Firma Fiel</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="firma_fiel_fecha_recepcion" id="firma_fiel_fecha_recepcion" class="form-control datepicker" autocomplete="off" style="text-align: center">
										<input type="hidden" id="firma_fiel_fecha_recepcion_value">
									</div>
									<span class="help-block">
									    <strong id="firma_fiel_recepcion_error" style="color:red"></strong>
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
										<select class="form-control" name="firma_fiel_recepcion" id="firma_fiel_recepcion" style="width: 100%;">
					                        <option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
			                     		<input type="hidden" id="firma_fiel_recepcion_value">
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="glyphicon glyphicon-print"></i> Impresión</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="impresion_fecha_recepcion" id="impresion_fecha_recepcion" class="form-control datepicker" autocomplete="off" style="text-align: center">
									</div>
								</div>
								<span class="help-block">
								    <strong id="impresion_recepcion_error" style="color:red"></strong>
								</span>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-success"><i class="fa fa-bullhorn"></i></label>
										</span>
										<select class="form-control" name="impresion_recepcion" id="impresion_recepcion" style="width: 100%;">
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

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3><i class="fas fa-book"></i> Asignar servicio a una de las Bitácoras de Estatus</h3>
							<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-primary"><i class="fa fa-hourglass-half"></i> Bitácora Estatus</label>
										</span>
										<select class="form-control" name="id_bitacoras_estatus_recepcion" id="id_bitacoras_estatus_recepcion" style="width: 100%;">
											<option value="">-Seleccionar-</option>
											@foreach($bitacoras_estatus as $est)
												<option value="{{ $est->id }}">{{ $est->clave }} - {{ $est->bitacora }}</option>
											@endforeach
			                     		</select>
			                     		<input type="hidden" id="id_bitacoras_estatus_recepcion_value">
									</div>
									<span class="help-block">
								    <strong id="id_bitacoras_estatus_recepcion_error" style="color:red"></strong>
								</span>
								</div>
							</div>
						</div>
						
					</div>
					

				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_servicio_recepcion" id="id_servicio_recepcion">
					<input type="hidden" name="id_control_recepcion" id="id_control_recepcion">
					<input type="hidden" name="id_cliente_recepcion" id="id_cliente_recepcion">
					<input type="hidden" name="id_admin_recepcion" id="id_admin_recepcion" value="{{ Auth::user()->id }}">
					<input name="_token_recepcion" value="{{ csrf_token() }}" type="hidden">
					<input id="fecha_recepcion" type="hidden" class="datepicker">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						Cerrar
					</button>
					<a id="btn-recepcion" class="btn btn-primary btn-flat">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar <i class="fas fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>