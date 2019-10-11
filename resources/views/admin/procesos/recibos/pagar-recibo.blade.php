<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-pagar-recibo">
	<form>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="color: white;"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="color: white;"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="monto_pagar_documento" class="control-label">Monto de la factura/recibo <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color: green; color:white"><i class="fa fa-money-bill-alt"></i></span>
									<input type="number" step="any" id="monto_pagar_documento" name="monto_pagar_documento" class="form-control centered">
									<input type="hidden" id="monto_pagar_documento_max">
								</div>
								<span class="help-block">
								    <strong id="monto_pagar_documento_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<hr>
					<!-- Folio nuevo -->
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="radio radio-css">
								<input type="radio" id="ingreso_nuevo_pagar_documento" name="radio_css" checked />
								<label for="ingreso_nuevo_pagar_documento"><h4>Pagar factura/recibo con un ingreso nuevo</h4></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="monto_cobro_pagar_documento" class="control-label">Monto del ingreso <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-money-bill-alt"></i></span>
									<input type="number" step="any" id="monto_cobro_pagar_documento" name="monto_cobro_pagar_documento" class="form-control centered">
								</div>
								<span class="help-block">
								    <strong id="monto_cobro_pagar_documento_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="fecha_pagar_documento" class="control-label">Fecha <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" id="fecha_pagar_documento" name="fecha_pagar_documento" class="form-control datepicker-autoClose centered" autocomplete="off">
								</div>
								<span class="help-block">
								    <strong id="fecha_pagar_documento_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
					</div>
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_cuenta_pagar_documento" class="control-label">Cuenta <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
									<select name="id_cuenta_pagar_documento" id="id_cuenta_pagar_documento" class="form-control">
										<option value="">-Sin selección-</option>
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_cuenta_pagar_documento_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_forma_pago_pagar_documento" class="control-label">Forma de pago <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-credit-card"></i></span>
									<select name="id_forma_pago_pagar_documento" id="id_forma_pago_pagar_documento" class="form-control">
										<option value="">-Sin selección-</option>
										@foreach($formas_pago as $forma_pago)
											<option value="{{ $forma_pago->id }}">{{ $forma_pago->forma_pago }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_forma_pago_pagar_documento_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
					</div>
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="movimiento_pagar_documento" class="control-label"># Movimiento</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-hashtag"></i></span>
									<input type="text" id="movimiento_pagar_documento" class="form-control centered">
								</div>
								<span class="help-block">
								    <strong id="movimiento_pagar_documento_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="cheque_pagar_documento" class="control-label">Cheque</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-hashtag"></i></span>
									<input type="text" id="cheque_pagar_documento" class="form-control centered">
								</div>
								<span class="help-block">
								    <strong id="cheque_pagar_documento_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="">Comentarios</label>
								<div class="input-group">
									<textarea id="concepto_pagar_documento" class="form-control" cols="3"></textarea>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- Folio existente -->
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="radio radio-css">
								<input type="radio" id="ingreso_existente_pagar_documento" name="radio_css" />
								<label for="ingreso_existente_pagar_documento"><h4>Pagar factura/recibo con un ingreso existente</h4></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Cobro <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
									<select id="select_cobro_pagar_documento" class="form-control">
										
									</select>
								</div>
								<span class="help-block">
								    <strong id="select_cobro_pagar_documento_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
						<div class="col-lg-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Monto disponible</label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color: orange; color: white"><i class="fas fa-money-bill-alt"></i></span>
									<input type="text" id="monto_restante_cobro_documento" class="form-control centered" disabled style="background-color: white;">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="orden_pagar_documento">
					<input type="hidden" id="id_pagar_documento">
					<input type="hidden" id="id_cliente_pagar_documento">
					<input type="hidden" id="pagado_pagar_documento">
					<input type="hidden" id="saldo_pagar_documento">
					<input type="hidden" id="total_pagar_documento">
					<input type="hidden" id="porcentaje_iva_pagar_documento">
					<input type="hidden" id="iva_pagar_documento">
					<input type="hidden" id="id_servicio_pagar_documento">

					<input type="hidden" id="pago_is_nuevo" value="1">
					<!--<input type="text" id="pago_is_existente" value="0">-->
					<input type="hidden" id="id_cobro_cobro_documento">
					<input type="hidden" id="total_cobro_documento">
					<input type="hidden" id="pagado_cobro_documento">
					<input type="hidden" id="restante_cobro_documento">
					<input type="hidden" id="porcentaje_iva_cobro_documento">

					
					<button data-dismiss="modal" class="btn btn-grey">Cerrar <i class="fas fa-times"></i></button>
					<a class="btn btn-primary" id="btn-pagar-factura">Guardar <i class="fas fa-save"></i></a>
				</div>
			</div>
		</div>
	</form>
</div>