<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-formato">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="modal-title-formato" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fa fa-file"></i> Formato</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="formato_fecha_formato" id="formato_fecha_formato" class="form-control datepicker" style="text-align: center" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="formato_fecha_formato_error" style="color:red"></strong>
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
										<select class="form-control" name="formato_formato" id="formato_formato" style="width: 100%;">
                                       		<option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
									</div>
									<span class="help-block">
									    <strong id="formato_formato_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="far fa-share-square"></i> Envío de Resutlados</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="envio_resultados_fecha_formato" id="envio_resultados_fecha_formato" class="form-control datepicker" style="text-align: center" autocomplete="off">
									</div>

									<span class="help-block">
									    <strong id="envio_resultados_fecha_formato_error" style="color:red"></strong>
									</span>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-success"><i class="fa fa-bullhorn"></i></label>
										</span>
										<select class="form-control" name="envio_resultados_formato" id="envio_resultados_formato" style="width: 100%;">
					                        <option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
									</div>
									<span class="help-block">
									    <strong id="envio_resultados_formato_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fas fa-handshake"></i> Contrato</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="contrato_fecha_formato" id="contrato_fecha_formato" class="form-control datepicker" style="text-align: center" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="contrato_fecha_formato_error" style="color:red"></strong>
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
										<select class="form-control" name="contrato_formato" id="contrato_formato" style="width: 100%;">
					                        <option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
									</div>
									<span class="help-block">
									    <strong id="contrato_formato_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fa fa-envelope"></i> Carta Poder</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="carta_poder_fecha_formato" id="carta_poder_fecha_formato" class="form-control datepicker" style="text-align: center" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="carta_poder_fecha_formato_error" style="color:red"></strong>
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
										<select class="form-control" name="carta_poder_formato" id="carta_poder_formato" style="width: 100%;">
					                        <option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
									</div>
									<span class="help-block">
									    <strong id="carta_poder_formato_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>

					</div>
					<div class="row">

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fa fa-image"></i> Logo</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="logo_fecha_formato" id="logo_fecha_formato" class="form-control datepicker" style="text-align: center" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="logo_fecha_formato_error" style="color:red"></strong>
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
										<select class="form-control" name="logo_formato" id="logo_formato" style="width: 100%;">
					                        <option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
									</div>
									<span class="help-block">
									    <strong id="logo_formato_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fa fa-book"></i> Reglas de Uso</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="reglas_uso_fecha_formato" id="reglas_uso_fecha_formato" class="form-control datepicker" style="text-align: center" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="reglas_uso_fecha_formato_error" style="color:red"></strong>
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
										<select class="form-control" name="reglas_uso_formato" id="reglas_uso_formato" style="width: 100%;">
					                        <option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
									</div>
									<span class="help-block">
									    <strong id="reglas_uso_formato_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>

					</div>
					<div class="row">

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 style="text-align: center"><i class="fa fa-print"></i> Escaneo de Documentos</h3>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-btn">
											<label class="btn btn-info"><i class="far fa-calendar-alt"></i></label>
										</span>
										<input type="text" name="escaneo_fecha_formato" id="escaneo_fecha_formato" class="form-control datepicker" style="text-align: center" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="escaneo_fecha_formato_error" style="color:red"></strong>
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
										<select class="form-control" name="escaneo_formato" id="escaneo_formato" style="width: 100%;">
					                        <option value="" selected>-</option>
                							<option value="Realizado">Realizado</option>
                							<option value="No Aplica">No Aplica</option>
                							<option value="Cancelado">Cancelado</option>
			                     		</select>
									</div>
									<span class="help-block">
									    <strong id="escaneo_formato_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<div class="input-group">
									<h3><i class="fa fa-image" aria-hidden="true"></i> Cargar Logo</h3>
									<input type="file" class="form-control" name="logo_url_formato" id="logo_url_formato">
								</div>
								<span class="help-block">
								    <strong id="logo_url_formato_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						
					</div>
					<div class="row">
						<div id="logo_formato_get"></div>
					</div>
					
					

				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_servicio_formato" id="id_servicio_formato">
					<input type="hidden" name="id_control_formato" id="id_control_formato">
					<input name="_token_formato" value="{{ csrf_token() }}" type="hidden">
					<input id="fecha_formato" type="hidden" class="datepicker">
					<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
						Cerrar
					</button>
					<a id="btn-formato" class="btn btn-primary btn-flat">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar <i class="fas fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</form>
</div>