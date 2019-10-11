<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-egreso-comision">
	<form role="form" action="{{ route('insertar.comision') }}" method="post">
		{{ csrf_field() }}
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
								<label for="">Seleccionar usuario <b style="color: red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon btn btn-primary" onclick="CreateComision();"><i class="fas fa-user"></i></span>
									<select class="form-control" name="comision_usuario" id="comision_usuario">
										<option value="">-Seleccionar-</option>
		                     		</select>
		                     		<input type="hidden" id="comision_usuario_val">
		                     		<div class="input-group-btn">
		                     			<a class="btn btn-info" onclick="ActualizarListadoComisiones()" title="Actualizar listado de comisiones" data-tooltip="tooltip"><i class="fas fa-sync"></i></a>
		                     		</div>
								</div>
								<span class="help-block">
								    <strong id="comision_usuario_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="comision_fecha">Fecha de Pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="input" name="comision_fecha" id="comision_fecha" class="form-control datepicker-autoClose centered" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="comision_fecha_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="comision_id_cuenta">Cuenta <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
									<select name="comision_id_cuenta" id="comision_id_cuenta" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="comision_id_cuenta_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="comision_id_forma_pago">Forma de pago <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
									<select name="comision_id_forma_pago" id="comision_id_forma_pago" class="form-control">
										<option value="">-Sin seleccíon-</option>
										@foreach($formas_pago as $forma)
											<option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="comision_id_forma_pago_error" style="color:red"></strong>
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
									<input type="text" id="comision_total" name="comision_total" class="form-control"  style="text-align: center; background-color: white; color: black; font-weight: bold" disabled>
									<input type="hidden" id="comision_total_val" name="comision_total_val">
								</div>
								<span class="help-block">
								    <strong id="comision_total_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="comision_cheque">Folio de Cheque</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
									<input type="text" name="comision_cheque" id="comision_cheque" class="form-control" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="comision_cheque_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="comision_movimiento">Movimiento Bancario</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" name="comision_movimiento" id="comision_movimiento" class="form-control" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="comision_movimiento_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<label for="comision_estatus">Estatus</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-flag"></i></span>
									<input type="text" name="comision_estatus" id="comision_estatus" class="form-control" autocomplete="off" style="text-align: center">
								</div>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="comision_concepto">Comentarios</label>
								<textarea class="form-control has-feedback-left" name="comision_concepto" id="comision_concepto" rows="3" placeholder="Anote una descripción..."></textarea>
							</div>
							<span class="help-block">
							    <strong id="comision_concepto_error" style="color:red"></strong>
							</span>
						</div>					
					</div>
					<br>
					<div class="row" style="text-align: left">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<a id="btn-aplicar-comision-egreso" onclick="AplicarComision()" class="btn btn-primary btn-flat"><i class="fas fa-money-bill-alt"></i> Actualizar</a>
							<button type="submit" class="btn btn-success"><span class="fas fa-save"> </span> Guardar Comisión</button>
						</div>
					</div>
					<hr>
					<!--<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div id="listado-comision-create"></div>
						</div>
					</div>-->
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div id="listado-comision-edit"></div>
						</div>
					</div>
					

				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_comision_egreso">
					<input type="hidden" id="orden_egresos_comision" name="orden_egresos_comision">
					<button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<!--<button class="btn btn-primary btn-flat" id="btn-save-comision">
						<span class="fas fa-save"></span> Guardar
					</button>-->
				</div>
			</div>
		</div>
	</form>
</div>