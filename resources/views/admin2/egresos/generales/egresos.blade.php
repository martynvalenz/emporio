<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="egresos">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" id="encabezado" style="color: #008CC2">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 id="egresos-title" style="color: white;"></h4>
					<input type="hidden" id="id_egreso" name="id_egreso">
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Tipo de Egreso <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<select name="tipo" id="tipo" class="form-control">
										<option value="">-Sin selección-</option>
										<!--<option value="Despacho">Despacho</option>
										<option value="Hogar">Hogar</option>
										<option value="Personal">Personal</option>-->
									</select>
								</div>
								<span class="help-block">
								    <strong id="tipo_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_categoria">Categoría <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<select name="id_categoria" id="id_categoria" class="form-control">
									</select>
									<div class="input-group-btn">  
										<a type="button" class="btn btn-info btn-flat" data-tooltip="tooltip" title="Agregar categoría" data-toggle="modal" data-target="#agregar-categoria" onclick="AgregarCategoria()"><i class="glyphicon glyphicon-plus"></i></a>
										@include('admin.egresos.generales.categoria')
									</div>
								</div>
								<span class="help-block">
								    <strong id="id_categoria_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<div class="form-group">
								<label>Proveedor <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<select name="id_proveedor" id="id_proveedor" class="form-control selectpicker" data-live-search="true" style="width: 100%">
									</select>
									<div class="input-group-btn">  
										<a type="button" class="btn btn-info btn-flat" data-tooltip="tooltip" title="Agregar proveedor" data-toggle="modal" data-target="#modal-proveedor" onclick="AgregarProveedor()"><i class="glyphicon glyphicon-plus"></i></a>
										@include('admin.egresos.generales.proveedor')
									</div>
									<input type="hidden" id="aplicar_servicios">
									<input type="hidden" id="proveedor_val">
								</div>
								<span class="help-block">
								    <strong id="id_proveedor_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="fecha">Fecha de Egreso <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="input" name="fecha" id="fecha" class="form-control datepicker" autocomplete="off">
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

						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="con_iva">con Factura?</label>
								<div class="form-group">
									<label class="container">SI
										<input type="checkbox" name="con_iva" id="con_iva" checked>
										<span class="checkmark"></span>
									</label>
								</div>
								<input type="hidden" name="con_iva_checked" id="con_iva_checked" value="1">
								<span class="help-block">
								    <strong id="con_iva_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="porcentaje_iva">Porcentaje IVA <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon"><i>%</i></span>
									<input type="number" step="any" name="porcentaje_iva" id="porcentaje_iva" value="{{ $porcentaje_iva->porcentaje_iva }}" class="form-control varo">
								</div>
								<span class="help-block">
								    <strong id="porcentaje_iva_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label>Monto Total <span style="color:red">*</span></label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
									<input type="number" step="any" id="total" name="total" class="form-control varo" value="0.00">
									<input type="hidden" id="total_ant">
								</div>
								<span class="help-block">
								    <strong id="total_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" id="restante_div" hidden>
							<div class="form-group">
								<label>Monto Restante</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
									<input type="text" id="monto_restante" name="monto_restante" class="form-control varo" value="0" disabled>
									<input type="hidden" id="monto_restante_val">
									<input type="hidden" id="pagado">
								</div>
								<span class="help-block">
								    <strong id="restante_error" style="color:red"></strong>
								</span>
							</div>
						</div>

					</div>
					<div class="row">

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="cheque">Folio de Cheque</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
									<input type="text" name="cheque" id="cheque" class="form-control varo" autocomplete="off">
								</div>
								<span class="help-block">
								    <strong id="cheque_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="movimiento">Movimiento Bancario</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" name="movimiento" id="movimiento" class="form-control varo" autocomplete="off">
								</div>
								<span class="help-block">
								    <strong id="movimiento_error" style="color:red"></strong>
								</span>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<div class="form-group">
								<label for="concepto">Comentarios</label>
								<textarea class="form-control has-feedback-left" name="concepto" id="concepto" rows="3" placeholder="Anote una descripción..."></textarea>
							</div>
							<span class="help-block">
							    <strong id="concepto_error" style="color:red"></strong>
							</span>
						</div>					
					</div>
					<div class="row pull-right">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
								Cerrar <span class="glyphicon glyphicon-remove"></span>
							</button>
							<button type="button" id="btn-egreso" class="btn btn-primary btn-flat"></button>
						</div>
					</div>
					<br>
					<hr>
					<div id="servicios"></div>
					<div id="servicios-pagados"></div>
					
				</div>
				<div class="modal-footer">
					<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin_egreso" id="id_admin_egreso">
					<input type="hidden" id="apagar_tipo" value="0">
					<input type="hidden" id="accion">
					<input type="hidden" id="_token_egresos" name="_token_egresos" value="{{ csrf_token() }}">
					
				</div>
			</div>
		</div>
	</form>
</div>