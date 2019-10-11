<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-pagar-factura">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="color: white;"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="color: white;"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
					<div id="section-asignacion-factura">
						<div class="row">
							<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label for="monto_servicio_factura" class="control-label">Monto disponible a Facturar <b style="color:red">*</b></label>
									<div class="input-group">
										<span class="input-group-addon" style="background-color: green; color:white"><i class="fa fa-money-bill-alt"></i></span>
										<input type="number" step="any" id="monto_servicio_factura" name="monto_servicio_factura" class="form-control centered">
										<input type="hidden" id="monto_servicio_factura_max">
									</div>
									<span class="help-block">
									    <strong id="monto_servicio_factura_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>
						<hr>
						<!-- Folio nuevo -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="radio radio-css">
									<input type="radio" id="nuevo_servicio_factura" name="radio_css_factura" />
									<label for="nuevo_servicio_factura"><h4>Asignar servicio a un folio de factura nuevo</h4></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label for="folio_servicio_factura" class="control-label">Folio <b style="color:red">*</b></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-file-pdf"></i></span>
										<input type="text" id="folio_servicio_factura" name="folio_servicio_factura" class="form-control centered">
									</div>
									<span class="help-block">
									    <strong id="folio_servicio_factura_error" style="color:red"></strong>
									</span>
								</div>                
							</div>
							<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label for="fecha_servicio_factura" class="control-label">Fecha <b style="color:red">*</b></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" id="fecha_servicio_factura" name="fecha_servicio_factura" class="form-control datepicker-autoClose centered" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="fecha_servicio_factura_error" style="color:red"></strong>
									</span>
								</div>                
							</div>
							<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<label>Porcentaje IVA <b style="color:red">*</b></label>
									<div class="input-group m-b-10">
										<div class="input-group-prepend">
											<span class="input-group-text"><input type="checkbox" id="check_iva_servicio_factura" /></span>
										</div>
										<input type="number" step="any" class="form-control centered" value="{{ $porcentaje_iva->porcentaje_iva }}" id="porcentaje_iva_servicio_factura" />
										<input type="hidden" id="check_iva_servicio_factura_val">
									</div>
									<span class="help-block">
									    <strong id="porcentaje_iva_servicio_factura_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>
						<!--<hr>
						 Folio existente -->
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="radio radio-css">
									<input type="radio" id="existente_servicio_factura" name="radio_css_factura" checked />
									<label for="existente_servicio_factura"><h4>Asignar servicio a un folio de factura existente</h4></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-file-pdf"></i></span>
										<select id="select_servicio_factura" class="form-control">
											
										</select>
									</div>
									<span class="help-block">
									    <strong id="select_servicio_factura_error" style="color:red"></strong>
									</span>
								</div>                
							</div>
						</div>
						<input type="hidden" id="id_cliente_servicio_factura">
						<input type="hidden" id="id_servicio_factura">
						<input type="hidden" id="tipo_servicio_factura">
						<input type="hidden" id="facturado_servicio_factura">
						<input type="hidden" id="costo_servicio_factura">
						<input type="hidden" id="factura_is_existente" value="1">
						<!-- Factura existente -->
						<input type="hidden" id="id_folio_servicio_factura">
						<input type="hidden" id="subtotal_servicio_factura">
						<input type="hidden" id="porcentaje_iva_servicio_factura_val">
						<input type="hidden" id="pagado_servicio_factura">
						<a class="btn btn-primary" id="btn-save-servicio-factura">Guardar <i class="fas fa-save"></i></a>
					</div>
					<div id="section-cobro-factura">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<h4>Capturar ingresos del cliente</h4>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="monto_cobro_pagar_factura" class="control-label">Monto del ingreso <b style="color:red">*</b></label>
									<div class="input-group">
										<span class="input-group-addon" style="background-color: green "><i class="fas fa-money-bill-alt" style="color: white"></i></span>
										<input type="number" step="any" id="monto_cobro_pagar_factura" name="monto_cobro_pagar_factura" class="form-control centered" value="0">
									</div>
									<span class="help-block">
									    <strong id="monto_cobro_pagar_factura_error" style="color:red"></strong>
									</span>
								</div>                
							</div>
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="fecha_pagar_factura" class="control-label">Fecha <b style="color:red">*</b></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" id="fecha_pagar_factura" name="fecha_pagar_factura" class="form-control datepicker-autoClose centered" autocomplete="off">
									</div>
									<span class="help-block">
									    <strong id="fecha_pagar_factura_error" style="color:red"></strong>
									</span>
								</div>                
							</div>
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="movimiento_pagar_factura" class="control-label"># Movimiento</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-hashtag"></i></span>
										<input type="text" id="movimiento_pagar_factura" class="form-control centered">
									</div>
									<span class="help-block">
									    <strong id="movimiento_pagar_factura_error" style="color:red"></strong>
									</span>
								</div>                
							</div>
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="cheque_pagar_factura" class="control-label">Cheque</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-hashtag"></i></span>
										<input type="text" id="cheque_pagar_factura" class="form-control centered">
									</div>
									<span class="help-block">
									    <strong id="cheque_pagar_factura_error" style="color:red"></strong>
									</span>
								</div>                
							</div>
							
						</div>
						<div class="row">
							<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="id_cuenta_pagar_factura" class="control-label">Cuenta <b style="color:red">*</b></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
										<select name="id_cuenta_pagar_factura" id="id_cuenta_pagar_factura" class="form-control">
											<option value="">-Sin selección-</option>
											@foreach($cuentas as $cuenta)
												<option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
											@endforeach
										</select>
									</div>
									<span class="help-block">
									    <strong id="id_cuenta_pagar_factura_error" style="color:red"></strong>
									</span>
								</div>                
							</div>
							<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="id_forma_pago_pagar_factura" class="control-label">Forma de pago <b style="color:red">*</b></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-credit-card"></i></span>
										<select name="id_forma_pago_pagar_factura" id="id_forma_pago_pagar_factura" class="form-control">
											<option value="">-Sin selección-</option>
											@foreach($formas_pago as $forma_pago)
												<option value="{{ $forma_pago->id }}">{{ $forma_pago->forma_pago }}</option>
											@endforeach
										</select>
									</div>
									<span class="help-block">
									    <strong id="id_forma_pago_pagar_factura_error" style="color:red"></strong>
									</span>
								</div>                
							</div>
						</div>
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="">Comentarios</label>
									<div class="input-group">
										<textarea id="concepto_pagar_factura" class="form-control" cols="3"></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<a class="btn btn-primary" id="btn-generar-ingreso">Generar Ingreso <i class="fas fa-money-bill-alt"></i></a>
							</div>
						</div>

						<hr>

						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<h4>Pago de Factura/Recibo</h4>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="saldo_cliente" class="control-label">Saldo del cliente</label>
									<div class="input-group">
										<span class="input-group-addon" style="background-color: #218CBF"><i style="color: white" class="fas fa-hand-holding-usd"></i></span>
										<input type="number" step="any" id="saldo_cliente" name="saldo_cliente" class="form-control centered" disabled style="background-color: white; color:black; font-style: bold">
										<input type="hidden" id="saldo_cliente_val">
									</div>
									<span class="help-block">
									    <strong id="saldo_cliente_error" style="color:red"></strong>
									</span>
								</div>
							</div>

							<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="saldo_factura" class="control-label">Monto pendiente factura</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fas fa-money-bill-alt"></i></span>
										<input type="number" step="any" id="saldo_factura" name="saldo_factura" class="form-control centered" disabled style="background-color: white; color:black; font-style: bold">
									</div>
									<span class="help-block">
									    <strong id="saldo_factura_error" style="color:red"></strong>
									</span>
								</div>
							</div>
							<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="monto_pagar_factura" class="control-label">Monto a pagar <b style="color:red">*</b></label>
									<div class="input-group">
										<span class="input-group-addon" style="background-color: green; color:white"><i class="fas fa-money-bill-alt"></i></span>
										<input type="number" step="any" id="monto_pagar_factura" name="monto_pagar_factura" class="form-control centered">
										<input type="hidden" id="monto_pagar_factura_max">
									</div>
									<span class="help-block">
									    <strong id="monto_pagar_factura_error" style="color:red"></strong>
									</span>
								</div>
							</div>
							<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<div class="form-group">
									<label for="monto_pagar_factura" class="control-label">Estatus de Factura/Recibo</label>
									<div class="input-group">
										<span class="input-group-addon" id="estatus_pagar_factura_span"><i class="fas fa-flag" style="color: white"></i></span>
										<input type="text" class="form-control centered" disabled id="estatus_pagar_factura" style="background-color: white; color: black">
										<input type="hidden" id="estatus_pagar_factura_val">
									</div>
									<span class="help-block">
									    <strong id="monto_pagar_factura_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<a class="btn btn-green" id="btn-pagar-factura">Pagar Factura/Recibo <i class="fas fa-money-bill-alt"></i></a>
								<a class="btn btn-warning" id="btn-abrir-factura">Liberar Factura/Recibo <i class="fas fa-folder-open"></i></a>
								<a class="btn btn-danger" id="btn-cancelar-factura">Cancelar Factura/Recibo <i class="fas fa-times"></i></a>
							</div>
						</div>
						<br>
						<div class="row"  id="row_validar_pago_factura" hidden>
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="alert alert-warning fade show">
									<span class="close" data-dismiss="alert">×</span>
									<strong>Advertencia!</strong>
									El saldo del cliente es menor que el monto pendiente de la Factura/Recibo, ¿desea continuar con el pago del mismo? <a class="alert-link" id="btn-aplicar-pago-factura">Aplicar pago aquí</a>.
									<br>
									O bien, puede capturar un ingreso nuevo del cliente en el formulario de abajo.<i class="fas fa-arrow-down"></i> 
								</div>
							</div>
						</div>
						<hr>

						<div id="listado-factura-pagada"></div>	
						<br>
						{{-- <div class="row">
							<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 offset-xl-9 offset-lg-9 offset-md-8 offset-sm-6">
								<div class="form-group">
									<label>Porcentaje IVA <b style="color:red">*</b></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><input type="checkbox" id="con_iva_final_factura_pagada_check" /></span>
										</div>
										<input type="number" step="any" class="form-control centered" value="{{ $porcentaje_iva->porcentaje_iva }}" id="piva_final_factura_pagada" />
										<input type="hidden" id="con_iva_final_factura_pagada">
									</div>
									<span class="help-block">
									    <strong id="con_iva_final_factura_pagada_error" style="color:red"></strong>
									</span>
								</div>
							</div>
						</div>
						<br> --}}
						<div class="row float-right" style="text-align: right">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%" >
										<tbody style="font-size: 20px !important">
											<tr id="totales-carrito">
												<td>Subtotal</td>
												<td align="right" id="subtotal_factura_pagada"></td>
												<input type="hidden" id="subtotal_final_factura_pagada">
											</tr>
											<tr>
												<td>IVA</td>
												<td align="right" id="iva_factura_pagada"></td>
												<input type="hidden" id="piva_final_factura_pagada" />
												<input type="hidden" id="iva_final_factura_pagada">
												<input type="hidden" id="con_iva_final_factura_pagada">
											</tr>
											<tr>
												<td>Total</td>
												<td align="right" id="total_factura_pagada"></td>
												<input type="hidden" id="total_final_factura_pagada">
												<input type="hidden" id="pagado_factura_pagada">
												<input type="hidden" id="saldo_factura_pagada">
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						
						<div class="row" style="text-align: left">
							<div class="col-lg-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<input type="hidden" id="orden_pagar_factura">
								<input type="hidden" id="listado_pagar_factura">
								<input type="hidden" id="id_factura_pagar_factura">
								<input type="hidden" id="id_cliente_pagar_factura">
								<input type="hidden" id="pagado_pagar_factura">
								<input type="hidden" id="saldo_pagar_factura">
								<input type="hidden" id="total_pagar_factura">
								<input type="hidden" id="id_servicio_pagar_factura">
								<input type="hidden" id="tipo_pagar_factura">
								<input type="hidden" id="folio_pagar_factura">

								<input type="hidden" id="pago_is_nuevo" value="1">
								<!--<input type="hidden" id="pago_is_existente" value="0">-->
								<input type="hidden" id="porcentaje_iva_cobro_factura" value="{{ $porcentaje_iva->porcentaje_iva }}">
							</div>
						</div>
					</div>
					

				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-grey">Cerrar <i class="fas fa-times"></i></button>
				</div>
			</div>
		</div>
	</form>
</div>