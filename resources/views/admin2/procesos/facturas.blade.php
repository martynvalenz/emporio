<form>
	<div class="modal-body">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="form-group">
					<label for="id_cliente" class="control-label">Cliente <b style="color:red">*</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fas fa-trophy"></i></span>
						<input type="text" id="nombre_comercial_factura" class="form-control" disabled>
						<input type="hidden" id="id_cliente_factura" name="id_cliente_factura">
					</div>
				</div>                
			</div>
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="fecha" class="control-label">Fecha <b style="color:red">*</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" id="fecha_factura" name="fecha_factura" class="form-control datepicker" autocomplete="off" style="text-align: center">
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
							<option value="">-Seleccionar opción-</option>
						</select>
						<div class="input-group-btn">
							<a class="btn btn-info mostrar-razon" title="Agregar nueva razón social" data-tooltip="tooltip" data-toggle="modal" data-target="#agregar_razon" id="btn_agregar_razon"><i class="fa fa-plus"></i>
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
						<select name="folio_factura" id="folio_factura" class="form-control">
							<option value=""> - </option>
						</select>
						<input type="hidden" class="form-control" name="folio_factura_input" id="folio_factura_input" autocomplete="off" style="text-align: center">
						<div class="input-group-btn">
							<a class="btn btn-info" title="Agregar factura" data-tooltip="tooltip" data-toggle="modal" data-target="#agregar_factura" id="btn-agregar-factura"><i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<span class="help-block">
					    <strong id="folio_factura_error" style="color:red"></strong>
					</span>
					@include('admin.procesos.factura')
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<label class="control-label">Porcentaje IVA <b style="color:red">*</b></label>
				<div class="input-group">
					<span class="input-group-addon"><i>%</i></span>
					<input type="number" step="any" name="porcentaje_iva_factura" id="porcentaje_iva_factura" class="form-control" value="{{ $porcentaje_iva->porcentaje_iva }}" style="text-align: center">
					<input type="hidden" id="con_iva_factura" name="con_iva_factura" value="1">
				</div>
				<span class="help-block">
				    <strong id="porcentaje_iva_factura_error" style="color:red"></strong>
				</span>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<label class="control-label">Monto a Facturar <b style="color:red">*</b></label>
				<div class="input-group">
					<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
					<input type="number" step="any" name="monto_factura" id="monto_factura" class="form-control" style="text-align: center" min="1">
					<div class="input-group-btn">
						<button type="button" id="btn-facturar" class="btn btn-primary btn-flat" title="Agregar monto del servicio a la factura" data-tooltip="tooltip">
							<i class="fas fa-save"></i>
						</button>
					</div>
					<input type="hidden" id="monto_factura_limite" name="monto_factura_limite">
					<input type="hidden" id="monto_facturado" name="monto_facturado">
				</div>
				<span class="help-block">
				    <strong id="monto_factura_error" style="color:red"></strong>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Comentarios</label>
				<textarea name="comentarios_factura" id="comentarios_factura" rows="3" class="form-control"></textarea>
			</div>
		</div>
		<br>
		<div class="row pull-right">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin_factura">
				<input name="_token_factura_agregar" value="{{ csrf_token() }}" type="hidden">
				<button type="button" id="btn-actualizar-factura" class="btn btn-success btn-flat" title="Actualizar datos de la factura" data-tooltip="tooltip">
					Actualizar Factura <i class="fas fa-save"></i></span>
				</button>
				<button type="button" class="btn btn-gris btn-flat btn-cerrar-actualizar" data-dismiss="modal">
					Cerrar y Actualizar <i class="fas fa-sync"></i></span>
				</button>
			</div>
		</div>
		<br>
		<div class="row">
			<div id="servicios-pendientes"></div>
		</div>
		<br>
		<div class="row">
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
</form>