<form>
	<div class="modal-body">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="form-group">
					<label class="control-label">Cliente <b style="color:red">*</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fas fa-trophy"></i></span>
						<input type="text" id="nombre_comercial_recibo" class="form-control" disabled>
						<input type="hidden" id="id_cliente_recibo" name="id_cliente_recibo">
					</div>
				</div>                
			</div>
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
				<div class="form-group">
					<label for="fecha" class="control-label">Fecha <b style="color:red">*</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input type="text" id="fecha_recibo" name="fecha_recibo" class="form-control datepicker" autocomplete="off" style="text-align: center">
					</div>
					<span class="help-block">
					    <strong id="fecha_recibo_error" style="color:red"></strong>
					</span>
				</div>                
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
				<div class="form-group">
					<label for="folio_recibo" class="control-label">Folio de Recibo <b style="color:red">*</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="far fa-file-pdf"></i></span>
						<select name="folio_recibo" id="folio_recibo" class="form-control">
							<option value=""> - </option>
						</select>
						<input type="hidden" class="form-control" name="folio_recibo" id="folio_recibo" autocomplete="off" style="text-align: center">
						<div class="input-group-btn">
							<a class="btn btn-info" title="Actualizar Recibo" data-tooltip="tooltip" data-toggle="modal" data-target="#agregar_recibo" id="btn-agregar-recibo"><i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<span class="help-block">
					    <strong id="folio_recibo_error" style="color:red"></strong>
					</span>
					@include('admin.procesos.recibo')
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<label class="control-label">Monto</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
					<input type="number" step="any" name="monto_recibo" id="monto_recibo" class="form-control" style="text-align: center" data-tooltip="tooltip" min="1">
					<div class="input-group-btn">
						<button type="button" id="btn-recibir" class="btn btn-primary btn-flat" title="Agregar monto del servicio al recibo" data-tooltip="tooltip">
							<i class="fas fa-save"></i>
						</button>
					</div>
					<input type="hidden" id="monto_recibo_limite" name="monto_recibo_limite">
					<input type="hidden" id="monto_recibido" name="monto_recibido">
				</div>
				<span class="help-block">
				    <strong id="monto_recibo_error" style="color:red"></strong>
				</span>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<label class="control-label">Porcentaje IVA</label>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="input-group">
							<span class="input-group-addon"><i>%</i></span>
							<input type="number" step="any" name="porcentaje_iva_recibo" id="porcentaje_iva_recibo" value="{{ $porcentaje_iva->porcentaje_iva }}" class="form-control" style="text-align: center">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="form-group">
							<label class="container">¿Aplica IVA?
								<input type="checkbox" name="aplica_iva_recibo" id="aplica_iva_recibo">
								<span class="checkmark"></span>
							</label>
						</div>
						<input type="hidden" name="aplica_iva_recibo_check" id="aplica_iva_recibo_check">
					</div>
				</div>
				<span class="help-block">
				    <strong id="porcentaje_iva_recibo_error" style="color:red"></strong>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label>Comentarios</label>
				<textarea name="comentarios_recibo" id="comentarios_recibo" rows="3" class="form-control"></textarea>
			</div>
		</div>
		<br>
		<div class="row pull-right">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin_recibo">
				<input name="_token_recibo" value="{{ csrf_token() }}" type="hidden">
				<button type="button" id="btn-actualizar-recibo" class="btn btn-success btn-flat" title="Actualizar datos del recibo" data-tooltip="tooltip">
					Actualizar Recibo <i class="fas fa-save"></i>
				</button>
				<button type="button" class="btn btn-gris btn-flat btn-cerrar-actualizar" data-dismiss="modal">
					Cerrar y Actualizar <i class="fas fa-sync"></i></span>
				</button>
			</div>
		</div>
		<br>
		<div class="row">
			<div id="servicios-recibidos"></div>
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
</form>