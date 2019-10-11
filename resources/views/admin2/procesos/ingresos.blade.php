<form>
	<div class="modal-body">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
			    <div class="form-group">
			        <label class="control-label">Cliente <b style="color:red">*</b></label>
			        <div class="input-group">
			            <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
			            <input type="text" id="nombre_comercial_cobranza" class="form-control" disabled>
			            <input type="hidden" id="id_cliente_cobranza" name="id_cliente_cobranza">
			        </div>
			    </div>                
			</div>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="form-group">
					<label for="folio_cobranza" class="control-label">Cobro <b style="color:red">*</b></label>
					<div class="input-group">
						<span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
						<select name="folio_cobranza" id="folio_cobranza" class="form-control">
							<option value=""> - </option>
						</select>
						<div class="input-group-btn">
							<a class="btn btn-info" title="Agregar cobro" data-tooltip="tooltip" data-toggle="modal" data-target="#agregar_cobranza" id="btn_agregar_cobranza"><i class="fa fa-plus"></i>
							</a>
						</div>
					</div>
					<span class="help-block">
					    <strong id="folio_cobranza_error" style="color:red"></strong>
					</span>
					@include('admin.procesos.cobranza')
				</div>
			</div>
		</div>
		<div class="row">
		    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
		        <div class="form-group">
		            <label for="fecha" class="control-label">Fecha <b style="color:red">*</b></label>
		            <div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                <input type="text" id="fecha_cobranza" name="fecha_cobranza" class="form-control datepicker" autocomplete="off" style="text-align: center">
		            </div>
		            <span class="help-block">
		                <strong id="fecha_cobranza_error" style="color:red"></strong>
		            </span>
		        </div>                
		    </div>
		    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
		        <div class="form-group">
		            <label class="control-label">Cuenta <b style="color:red">*</b></label>
		            <div class="input-group">
		                <span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
		                <select name="cuenta_cobranza" id="cuenta_cobranza" class="form-control">
		                    <option value=""> - </option>
		                    @foreach($cuentas as $cuenta)
		                        <option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
		                    @endforeach
		                </select>
		            </div>
		            <span class="help-block">
		                <strong id="cuenta_cobranza_error" style="color:red"></strong>
		            </span>
		        </div>
		    </div>
		    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
		        <div class="form-group">
		            <label class="control-label">Forma de Pago <b style="color:red">*</b></label>
		            <div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
		                <select name="forma_pago_cobranza" id="forma_pago_cobranza" class="form-control">
		                    <option value=""> - </option>
		                    @foreach($formas_pago as $forma_pago)
		                        <option value="{{ $forma_pago->id }}">{{ $forma_pago->forma_pago }}</option>
		                    @endforeach
		                </select>
		            </div>
		            <span class="help-block">
		                <strong id="forma_pago_cobranza_error" style="color:red"></strong>
		            </span>
		        </div>
		    </div>
		</div>
		<div class="row">
		    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		        <div class="form-group">
		            <label>Monto Total <b style="color:red">*</b></label>
		            <div class="input-group">
		                <span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
		                <input type="number" step="any" id="monto_cobranza" name="monto_cobranza" class="form-control" style="text-align: center">
		                <input type="hidden" name="deposito" id="deposito">
		            </div>
		            <span class="help-block">
		                <strong id="monto_cobranza_error" style="color:red"></strong>
		            </span>
		        </div>
		    </div>
		    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		        <div class="form-group">
		            <label>Monto Restante</label>
		            <div class="input-group">
		                <span class="input-group-addon" style="background-color:orange; color:white"><i class="far fa-money-bill-alt"></i></span>
		                <input type="number" step="any" class="form-control" step="any" id="monto_cobranza_restante_mostrar" disabled style="text-align: center; background-color: white; color: gray">
		                <input type="hidden" id="monto_cobranza_restante" name="monto_cobranza_restante" class="form-control">
		            </div>
		            <span class="help-block">
		                <strong id="monto_cobranza_restante_error" style="color:red"></strong>
		            </span>
		        </div>
		    </div>
		    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		        <div class="form-group">
		            <label>Folio de Cheque</label>
		            <div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
		                <input type="text" name="cheque" id="cheque" class="form-control" style="text-align: center">
		            </div>
		            <span class="help-block">
		                <strong id="cheque_error" style="color:red"></strong>
		            </span>
		        </div>
		    </div>

		    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
		        <div class="form-group">
		            <label>Movimiento Bancario</label>
		            <div class="input-group">
		                <span class="input-group-addon"><i>#</i></span>
		                <input type="text" name="movimiento" id="movimiento" class="form-control" style="text-align: center">
		            </div>
		            <span class="help-block">
		                <strong id="movimiento_error" style="color:red"></strong>
		            </span>
		        </div>
		    </div>
		</div>
		<div class="row">
		    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		        <label>Comentarios</label>
		        <textarea name="comentarios_cobranza" id="comentarios_cobranza" rows="3" class="form-control"></textarea>
		    </div>
		</div>
		<br>
		<div class="row pull-right">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin_cobranza">
				<input name="_token_cobranza" value="{{ csrf_token() }}" type="hidden">
				<button type="button" id="btn-actualizar-cobro" class="btn btn-success btn-flat" title="Actualizar datos del cobro" data-tooltip="tooltip">
					Actualizar Cobro <i class="fas fa-save"></i></span>
				</button>
				<button type="button" class="btn btn-gris btn-flat btn-cerrar-actualizar" data-dismiss="modal">
					Cerrar y Actualizar <i class="fas fa-sync"></i></span>
				</button>
			</div>
		</div>
		<br>
		<div id="facturas-pendientes-cobro"></div>
		<div id="facturas-detalles-datos"></div>
		<br>

	</div>

	<div class="modal-footer">
		<div class="row">
			<div class="col-md-offset-8 col-md-4 col-sm-12 col-xs-12">
				<div class="table-responsive" style="font: bold; border: 1px solid #D2D6DF;">
					<table class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%" >
						<tbody style="font-size: 18px">
							<tr id="totales-carrito">
								<td>Subtotal</td>
								<td align="right" id="subtotal_cobranza"></td>
								<input type="hidden" id="subtotal_cobranza_final" name="subtotal_cobranza_final">
							</tr>
							<tr>
								<td>IVA</td>
								<td align="right" id="iva_cobranza"></td>
								<input type="hidden" id="iva_cobranza_final" name="iva_cobranza_final">
								<input type="hidden" id="porcentaje_iva_cobranza" name="porcentaje_iva_cobranza">
							</tr>
							<tr>
								<td>Total</td>
								<td align="right" id="total_cobranza"></td>
								<input type="hidden" id="total_cobranza_final" name="total_cobranza_final" value="">
								<input type="hidden" id="pagado_cobranza" name="pagado_cobranza">
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>