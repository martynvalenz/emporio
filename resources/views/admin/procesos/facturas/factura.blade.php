<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-factura">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" style="color: white;"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: white;"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="id_cliente_factura_select">
							<div class="form-group">
								<label for="id_cliente" class="control-label">Cliente <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-trophy"></i></span>
									<select class="form-control default-select2" name="id_cliente_factura" id="id_cliente_factura" data-live-search="true" data-style="btn-primary"> 
									</select>
									<input type="hidden" id="id_cliente_factura_val">
								</div>
								<span class="help-block">
								    <strong id="id_cliente_factura_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" hidden id="id_cliente_factura_div">
							<div class="form-group">
								<label for="id_cliente" class="control-label">Cliente <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-trophy"></i></span>
									<input type="text" id="id_cliente_factura_text" class="form-control">
								</div>
								<span class="help-block">
								    <strong id="id_cliente_factura_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="fecha_factura" class="control-label">Fecha <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" id="fecha_factura" name="fecha_factura" class="form-control datepicker-autoClose centered" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="fecha_factura_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
					</div>
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
							<div class="form-group">
								<label class="control-label">Seleccionar Razón Social</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-qrcode"></i></span>
									<select name="id_razon_social_factura" id="id_razon_social_factura" class="form-control">
										<option value="" selected>-Seleccionar opción-</option>
									</select>
									<div class="input-group-btn">
										<a class="btn btn-info mostrar-razon" title="Agregar nueva razón social" data-tooltip="tooltip" onclick="AgregarRazonSocial()"><i class="fa fa-plus"></i>
										</a>
									</div>
								</div>
								@include('admin.procesos.facturas.razon')
							</div>                
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="folio_factura" class="control-label">Folio de Factura <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-file-pdf"></i></span>
									<input type="text" class="form-control" name="folio_factura" id="folio_factura" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="folio_factura_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Comentarios</label>
							<textarea name="comentarios_factura" id="comentarios_factura" rows="3" class="form-control"></textarea>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" id="id_factura">
							<input type="hidden" id="monto_factura" value="0">
							<input type="hidden" id="detalles_factura" value="0">
							<input type="hidden" id="accion_factura" value="Create">
							<input type="hidden" id="estatus_factura">
							<input type="hidden" id="tipo_factura" value="Factura">
							<input type="hidden" id="porcentaje_iva_factura" value="{{ $porcentaje_iva->porcentaje_iva }}">
							<a class="btn btn-grey" id="btn-cerrar-factura" data-dismiss="modal">
								Cerrar <span class="fas fa-times"></span>
							</a>
							<a class="btn btn-primary" id="btn-save-factura">
								Guardar <span class="fas fa-save"></span>
							</a>
						</div>
					</div>
					<hr>
					
					<div class="row">
						<div id="servicios-pendientes-facturar"></div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%" >
									<tbody style="font-size: 20px !important">
										<tr id="totales-carrito">
											<td>Subtotal</td>
											<td align="right" id="subtotal_factura"></td>
											<input type="hidden" id="subtotal_final_factura" name="subtotal_final_factura" value="">
										</tr>
										<tr>
											<td>IVA</td>
											<td align="right" id="iva_factura"></td>
											<input type="hidden" id="iva_final_factura" name="iva_final_factura" value="">
										</tr>
										<tr>
											<td>Total</td>
											<td align="right" id="total_factura"></td>
											<input type="hidden" id="total_final_factura" name="total_final_factura" value="">
											<input type="hidden" id="pagado_factura" name="pagado_factura">
											<input type="hidden" id="saldo_factura" name="saldo_factura">
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>