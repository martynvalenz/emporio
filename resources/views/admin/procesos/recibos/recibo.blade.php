<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-recibo">
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
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="id_cliente_recibo_select">
							<div class="form-group">
								<label for="id_cliente" class="control-label">Cliente <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-trophy"></i></span>
									<select class="form-control default-select2" name="id_cliente_recibo" id="id_cliente_recibo" data-live-search="true" data-style="btn-primary"> 
									</select>
									<input type="hidden" id="id_cliente_recibo_val">
								</div>
								<span class="help-block">
								    <strong id="id_cliente_recibo_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" hidden id="id_cliente_recibo_div">
							<div class="form-group">
								<label for="id_cliente" class="control-label">Cliente <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-trophy"></i></span>
									<input type="text" id="id_cliente_recibo_text" class="form-control">
								</div>
								<span class="help-block">
								    <strong id="id_cliente_recibo_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="fecha_recibo" class="control-label">Fecha <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" id="fecha_recibo" name="fecha_recibo" class="form-control datepicker-autoClose centered" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="fecha_recibo_error" style="color:red"></strong>
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
									<select name="id_razon_social_recibo" id="id_razon_social_recibo" class="form-control">
										<option value="" selected>-Seleccionar opción-</option>
									</select>
									<div class="input-group-btn">
										<a class="btn btn-info mostrar-razon" title="Agregar nueva razón social" data-tooltip="tooltip" onclick="AgregarRazonSocialRecibo()">
											<i class="fa fa-plus"></i>
										</a>
									</div>
								</div>
								@include('admin.procesos.recibos.razon')
							</div>                
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="folio_recibo" class="control-label">Folio de Recibo <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-file-pdf"></i></span>
									<input type="text" class="form-control" name="folio_recibo" id="folio_recibo" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="folio_recibo_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Porcentaje IVA <b style="color:red">*</b></label>
								<div class="input-group m-b-10">
									<div class="input-group-prepend">
										<span class="input-group-text"><input type="checkbox" id="porcentaje_iva_recibo_check" /></span>
									</div>
									<input type="number" step="any" id="porcentaje_iva_recibo" value="{{ $porcentaje_iva->porcentaje_iva }}" class="form-control centered">
									<input type="hidden" id="porcentaje_iva_recibo_check_val">
								</div>
								<span class="help-block">
								    <strong id="porcentaje_iva_recibo_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label>Comentarios</label>
							<textarea name="comentarios_recibo" id="comentarios_recibo" rows="3" class="form-control"></textarea>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" id="id_recibo">
							<input type="hidden" id="monto_recibo" value="0">
							<input type="hidden" id="detalles_recibo" value="0">
							<input type="hidden" id="accion_recibo" value="Create">
							<input type="hidden" id="estatus_recibo">
							<input type="hidden" id="tipo_recibo" value="Recibo">
							<a class="btn btn-grey" data-dismiss="modal">
								Cerrar <span class="fas fa-times"></span>
							</a>
							<a class="btn btn-primary" id="btn-save-recibo">
								Guardar <span class="fas fa-save"></span>
							</a>
						</div>
					</div>
					<hr>
					
					<div class="row">
						<div id="servicios-pendientes-recibo"></div>
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
											<td align="right" id="subtotal_recibo"></td>
											<input type="hidden" id="subtotal_final_recibo" name="subtotal_final_recibo" value="">
										</tr>
										<tr>
											<td>IVA</td>
											<td align="right" id="iva_recibo"></td>
											<input type="hidden" id="iva_final_recibo" name="iva_final_recibo" value="">
										</tr>
										<tr>
											<td>Total</td>
											<td align="right" id="total_recibo"></td>
											<input type="hidden" id="total_final_recibo" name="total_final_recibo" value="">
											<input type="hidden" id="pagado_recibo" name="pagado_recibo">
											<input type="hidden" id="saldo_recibo" name="saldo_recibo">
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