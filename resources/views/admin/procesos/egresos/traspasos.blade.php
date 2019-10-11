<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-traspaso">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="color:white"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" style="color:white">
						<span aria-hidden="true"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4>Cuenta de retiro</h4>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
							<div class="form-group">
								<label for="id_cuenta_traspaso">Cuenta <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
									<select name="id_cuenta_traspaso" id="id_cuenta_traspaso" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_cuenta_traspaso_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
							<div class="form-group">
								<label for="id_forma_pago_traspaso">Forma de pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
									<select name="id_forma_pago_traspaso" id="id_forma_pago_traspaso" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($formas_pago as $forma)
											<option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_forma_pago_traspaso_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="form-group">
								<label for="fecha_traspaso">Fecha <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="input" name="fecha_traspaso" id="fecha_traspaso" class="form-control datepicker-autoClose centered" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="fecha_traspaso_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="form-group">
								<label>Monto Total <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
									<input type="number" step="any" id="monto_traspaso" name="monto_traspaso" class="form-control centered"  style="text-align: center" value="0">
								</div>
								<span class="help-block">
								    <strong id="monto_traspaso_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4>Cuenta de depósito</h4>
						</div>
					</div>
					<div class="row">

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
							<div class="form-group">
								<label for="id_cuenta_traspaso_deposito">Cuenta <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
									<select name="id_cuenta_traspaso_deposito" id="id_cuenta_traspaso_deposito" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_cuenta_traspaso_deposito_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="cheque_traspaso">Folio de Cheque</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
									<input type="text" name="cheque_traspaso" id="cheque_traspaso" class="form-control" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="cheque_traspaso_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="movimiento_traspaso">Movimiento Bancario</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" name="movimiento_traspaso" id="movimiento_traspaso" class="form-control" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="movimiento_traspaso_error" style="color:red"></strong>
								</span>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="concepto_traspaso">Comentarios</label>
								<textarea class="form-control has-feedback-left" name="concepto_traspaso" id="concepto_traspaso" rows="3" placeholder="Anote una descripción..."></textarea>
							</div>
							<span class="help-block">
							    <strong id="concepto_traspaso_error" style="color:red"></strong>
							</span>
						</div>					
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_egreso_traspaso">
					<input type="hidden" id="orden_traspaso">
					<button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<a id="btn-guardar-traspaso" class="btn btn-primary btn-flat"><i class="fas fa-money-bill-alt"></i> Guardar</a>
				</div>
			</div>
		</div>
	</form>
</div>