<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-comisiones">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" id="encabezado">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 id="encabezado-title" style="color: white;"></h4>
					<input type="hidden" id="id_egreso_comision" name="id_egreso_comision">
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<div class="form-group">
								<label>Usuario <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<select id="id_usuario" class="form-control" title="Seleccionar un usuario para filtrar" data-tooltip="tooltip">
                                        <option value="">-Todos-</option>
                                        @foreach($admins as $admin)
                                            <option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                                        @endforeach
                                    </select>
								</div>
								<span class="help-block">
								    <strong id="id_usuario_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="fecha">Fecha de Pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="input" name="fecha" id="fecha" class="form-control datepicker" autocomplete="off" style="text-align: center">
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
								<label for="id_cuenta">Cuenta <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
									<select name="id_cuenta" id="id_cuenta" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_cuenta_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_forma_pago">Forma de pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
									<select name="id_forma_pago" id="id_forma_pago" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($formas_pago as $forma)
											<option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_forma_pago_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label>Monto Total <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
									<input type="number" step="any" id="total" name="total" class="form-control" value="0.00" style="text-align: center" disabled>
									<input type="hidden" id="total_val">
								</div>
								<span class="help-block">
								    <strong id="tota_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="cheque">Folio de Cheque</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
									<input type="text" name="cheque" id="cheque" class="form-control" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="cheque_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="movimiento">Movimiento Bancario</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" name="movimiento" id="movimiento" class="form-control" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="movimiento_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="estatus">Estatus</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-flag"></i></span>
									<input type="text" name="estatus" id="estatus" class="form-control" autocomplete="off" style="text-align: center">
								</div>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="concepto">Comentarios</label>
								<textarea class="form-control has-feedback-left" name="concepto" id="concepto" rows="3" placeholder="Anote una descripción..."></textarea>
							</div>
							<span class="help-block">
							    <strong id="concepto_error" style="color:red"></strong>
							</span>
						</div>					
					</div>
					<br>
					<div class="row pull-left">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<a id="btn-guardar-comision" class="btn btn-primary btn-flat"><i class="fas fa-save"></i> Guardar</a>
							<button type="button" class="btn btn-gris btn-flat btn-cerrar-actualizar" data-dismiss="modal">
								Cerrar <span class="glyphicon glyphicon-remove"></span>
							</button>
						</div>
					</div>
					<br>
					<hr>
					<div id="servicios"></div>
					<div id="servicios-pagados"></div>
					
				</div>
				<div class="modal-footer">
					<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin_egreso" id="id_admin_egreso">
					<input type="hidden" id="accion">
					<input type="hidden" id="_token_egresos" name="_token_egresos" value="{{ csrf_token() }}">
				</div>
			</div>
		</div>
	</form>
</div>