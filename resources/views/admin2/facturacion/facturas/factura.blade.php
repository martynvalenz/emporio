<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="factura-modal">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" id="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="modal-title" style="color: white;">Agregar Factura</h4>
				</div>
				<div class="modal-body">
					
					<div class="row">
						<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
							<div class="form-group">
								<label for="id_cliente" class="control-label">Cliente <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-trophy"></i></span>
									<select name="" id="id_cliente" data-live-search="true" class="form-control selectpicker">
										<option value="" selected>-Seleccionar cliente-</option>
										@foreach($clientes as $cliente)
											<option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
										@endforeach
									</select>
									<input type="hidden" id="id_cliente_val">
								</div>
								<span class="help-block">
								    <strong id="id_cliente_error" style="color:red"></strong>
								</span>
							</div>                
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="fecha" class="control-label">Fecha <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" id="fecha" name="fecha" class="form-control datepicker" autocomplete="off" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="fecha_error" style="color:red"></strong>
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
									<select name="id_razon_social" id="id_razon_social" class="form-control">
										<option value="" selected>-Seleccionar opción-</option>
									</select>
									<div class="input-group-btn">
										<a class="btn btn-info mostrar-razon" title="Agregar nueva razón social" data-tooltip="tooltip" id="btn_agregar_razon"><i class="fa fa-plus"></i>
										</a>
									</div>
								</div>
								@include('admin.procesos.razon')
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
							<textarea name="comentarios" id="comentarios" rows="3" class="form-control"></textarea>
						</div>
					</div>
					<br>
					<div class="row pull-right">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="hidden" id="id_factura">
							<input type="hidden" id="apagar_cliente" value="0">
							<input type="hidden" value="{{ Auth::user()->id }}" id="id_admin">
							<input type="hidden" id="monto" value="0">
							<input type="hidden" id="porcentaje_iva">
							<a class="btn btn-primary btn-flat" id="btn_factura">
								<span class="glyphicon glyphicon-floppy-disk"></span>
							</a>
							<a class="btn btn-gris btn-flat btn-cerrar-actualizar" data-dismiss="modal">
								Cerrar <span class="glyphicon glyphicon-remove"></span>
							</a>
						</div>
					</div>
					<br>
					<div class="row">
						<div id="servicios-pendientes"></div>
						<br>
						<div id="servicios-facturados"></div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-md-offset-8 col-md-4 col-sm-12 col-xs-12">
							<div class="table-responsive" style="font: bold; border: 1px solid #D2D6DF;">
								<table class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%" >
									<tbody style="font-size: 18px">
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