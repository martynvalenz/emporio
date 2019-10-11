<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-tarjeta-credito">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" id="encabezado_tarjeta" style="color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 id="egresos-title_tarjeta" style="color: white;"></h4>
					<input type="hidden" id="id_egreso_tarjeta" name="id_egreso_tarjeta">
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Tipo de Egreso <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<select name="tipo_tarjeta" id="tipo_tarjeta" class="form-control">
										<option value="">-Sin selección-</option>
										<option value="Despacho" selected>Despacho</option>
										<option value="Hogar">Hogar</option>
										<option value="Personal">Personal</option>
									</select>
								</div>
								<span class="help-block">
								    <strong id="tipo_tarjeta_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_categoria">Categoría <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<input type="text" disabled class="form-control" value="PAGO DE TARJETA DE CRÉDITO">
									<input type="hidden" value="59" id="id_categoria_tarjeta">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="fecha">Fecha de Egreso <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="input" name="fecha_tarjeta" id="fecha_tarjeta" class="form-control datepicker" autocomplete="off">
								</div>
								<span class="help-block">
								    <strong id="fecha_tarjeta_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_cuenta">Cuenta de Pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
									<select name="id_cuenta_tarjeta" id="id_cuenta_tarjeta" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_cuenta_tarjeta_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_forma_pago">Forma de pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
									<select name="id_forma_pago_tarjeta" id="id_forma_pago_tarjeta" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($formas_pago as $forma)
											<option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_forma_pago_tarjeta_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label>Monto Total <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
									<input type="number" step="any" id="total_tarjeta" name="total_tarjeta" class="form-control varo" value="0.00">
									<input type="hidden" id="total_tarjeta_ant">
									<input type="hidden" id="porcentaje_iva_tarjeta" value="{{ $porcentaje_iva->porcentaje_iva }}">
									<input type="hidden" id="iva_tarjeta_ant">
									<input type="hidden" id="subtotal_tarjeta_ant">
								</div>
								<span class="help-block">
								    <strong id="total_tarjeta_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label>Monto Restante</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
									<input type="text" id="monto_restante_tarjeta" name="monto_restante_tarjeta" class="form-control varo" value="0" disabled>
									<input type="hidden" id="monto_restante_tarjeta_val" value="0">
								</div>
								<span class="help-block">
								    <strong id="restante_tarjeta_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label>Monto Pagado</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
									<input type="text" id="pagado_tarjeta_show" name="pagado_tarjeta_show" class="form-control varo" value="0" disabled>
									<input type="hidden" id="pagado_tarjeta">
								</div>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="cheque">Folio de Cheque</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
									<input type="text" name="cheque_tarjeta" id="cheque_tarjeta" class="form-control varo" autocomplete="off">
								</div>
								<span class="help-block">
								    <strong id="cheque_tarjeta_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="movimiento">Movimiento Bancario</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" name="movimiento_tarjeta" id="movimiento_tarjeta" class="form-control varo" autocomplete="off">
								</div>
								<span class="help-block">
								    <strong id="movimiento_tarjeta_error" style="color:red"></strong>
								</span>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<div class="form-group">
								<label for="concepto">Comentarios</label>
								<textarea class="form-control has-feedback-left" name="concepto_tarjeta" id="concepto_tarjeta" rows="3" placeholder="Anote una descripción..."></textarea>
							</div>
							<span class="help-block">
							    <strong id="concepto_tarjeta_error" style="color:red"></strong>
							</span>
						</div>					
					</div>
					<div class="row pull-right">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
								Cerrar <span class="glyphicon glyphicon-remove"></span>
							</button>
							<button type="button" id="btn-tarjeta" class="btn btn-primary btn-flat"></button>
						</div>
					</div>
					<br>
					<hr>
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_cuenta">Cuenta de Tarjeta de crédito <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
									<select name="id_cuenta_pendiente" id="id_cuenta_pendiente" class="form-control">
										<option value="">-Sin selección-</option>
										@foreach($cuentas_credito as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_cuenta_pendiente_error" style="color:red"></strong>
								</span>
							</div>
						</div>	
					</div>
					<div id="servicios_tarjeta"></div>
					<div id="servicios-pagados_tarjeta"></div>
					
				</div>
				<div class="modal-footer">
					<input type="hidden" id="accion_tarjeta">
				</div>
			</div>
		</div>
	</form>
</div>