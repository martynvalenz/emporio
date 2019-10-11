<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-nomina-edit">
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
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="form-group">
								<label for="fecha_inicio_nomina_edit">Desde <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="input" name="fecha_inicio_nomina_edit" id="fecha_inicio_nomina_edit" class="form-control datepicker-autoClose centered" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="fecha_inicio_nomina_edit_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="form-group">
								<label for="fecha_fin_nomina_edit">Hasta <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="input" name="fecha_fin_nomina_edit" id="fecha_fin_nomina_edit" class="form-control datepicker-autoClose centered" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="fecha_fin_nomina_edit_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="form-group">
								<label for="tipo_nomina_edit">Concepto <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-list"></i></span>
									<select id="tipo_nomina_edit" class="form-control">
										<option value="Nómina">Nómina</option>
										<option value="Aguinaldo">Aguinaldo</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
							<div class="form-group">
								<label for="tipo_nomina_edit">Monto <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-list"></i></span>
									<input type="number" step="any" id="monto_nomina_edit" class="form-control centered">
								</div>
								<span class="help-block">
								    <strong id="fecha_fin_nomina_edit_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_cuenta_nomina_edit">Cuenta <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
									<select name="id_cuenta_nomina_edit" id="id_cuenta_nomina_edit" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_cuenta_nomina_edit_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_forma_pago_nomina_edit">Forma de pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
									<select name="id_forma_pago_nomina_edit" id="id_forma_pago_nomina_edit" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($formas_pago as $forma)
											<option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_forma_pago_nomina_edit_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="concepto_nomina_edit">Comentarios</label>
								<textarea class="form-control has-feedback-left" name="concepto_nomina_edit" id="concepto_nomina_edit" rows="3" placeholder="Anote una descripción..."></textarea>
							</div>
							<span class="help-block">
							    <strong id="concepto_nomina_edit_error" style="color:red"></strong>
							</span>
						</div>					
					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div id="listado-empleados-nomina-edit"></div>
						</div>
					</div>

					
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_egreso_nomina_edit">
					<button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<a class="btn btn-primary btn-flat" id="btn-save-nomina-edit">
						<span class="fas fa-save"></span> Guardar
					</a>
				</div>
			</div>
		</div>
	</form>
</div>