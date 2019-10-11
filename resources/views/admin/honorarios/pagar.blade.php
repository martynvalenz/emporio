<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-pagar">
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
						<div class="col-xs-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="">Seleccionar proveedor</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-user"></i></span>
									<select class="form-control" id="proveedor_egreso">
										
		                     		</select>
		                     		{{-- <div class="input-group-btn">
		                     			<a class="btn btn-info" title="Agregar un proveedor" data-tooltip="tooltip" onclick="AgregarProveedor()"><i class="fas fa-user-plus"></i>
		                     			</a>
		                     		</div> --}}
								</div>
								<span class="help-block">
								    <strong id="proveedor_egreso_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="tipo_egreso">Tipo Egreso <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-list"></i></span>
									<select name="tipo_egreso" id="tipo_egreso" class="form-control">
										<option value="Despacho">Despacho</option>
									</select>
								</div>
								<span class="help-block">
								    <strong id="tipo_egreso_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="fecha">Fecha de Pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="input" name="fecha" id="fecha" class="form-control datepicker-autoClose centered" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="fecha_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_cuenta_egreso">Cuenta <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
									<select name="id_cuenta_egreso" id="id_cuenta_egreso" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_cuenta_egreso_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_forma_pago_egreso">Forma de pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
									<select name="id_forma_pago_egreso" id="id_forma_pago_egreso" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($formas_pago as $forma)
											<option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_forma_pago_egreso_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">

						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label>Porcentaje IVA <b style="color:red">*</b></label>
								<div class="input-group m-b-10">
									<div class="input-group-prepend">
										<span class="input-group-text"><input type="checkbox" id="check_porcentaje_iva_egreso" checked /></span>
									</div>
									<input type="number" step="any" class="form-control centered" value="{{ $porcentaje_iva->porcentaje_iva }}" id="porcentaje_iva_egreso" />
									<input type="hidden" id="check_porcentaje_iva_egreso_val" value="1">
								</div>
								<span class="help-block">
								    <strong id="porcentaje_iva_egreso_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label>Monto Total <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
									<input type="number" step="any" id="monto_egreso" name="monto_egreso" class="form-control"  style="text-align: center; background-color: white; color: black" disabled>
									<input type="hidden" id="monto_egreso_val">
								</div>
								<span class="help-block">
								    <strong id="monto_egreso_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="cheque_egreso">Folio de Cheque</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
									<input type="text" name="cheque_egreso" id="cheque_egreso" class="form-control" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="cheque_egreso_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="movimiento_egreso">Movimiento Bancario</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" name="movimiento_egreso" id="movimiento_egreso" class="form-control" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="movimiento_egreso_error" style="color:red"></strong>
								</span>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="concepto_egreso">Comentarios</label>
								<textarea class="form-control has-feedback-left" name="concepto_egreso" id="concepto_egreso" rows="3" placeholder="Anote una descripción..."></textarea>
							</div>
							<span class="help-block">
							    <strong id="concepto_egreso_error" style="color:red"></strong>
							</span>
						</div>					
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="orden_egreso">
					<button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<a id="btn-guardar-egreso" class="btn btn-primary btn-flat"><i class="fas fa-money-bill-alt"></i> Guardar</a>
					<!--<button class="btn btn-primary btn-flat" id="btn-save-comision">
						<span class="fas fa-save"></span> Guardar
					</button>-->
				</div>
			</div>
		</div>
	</form>
</div>