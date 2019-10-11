<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-cxp">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;"></h4>
				</div>
				<div class="modal-body">

					<div class="row">

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="tipo">Tipo de Egreso <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<select name="tipo" id="tipo" class="form-control">
										<option value="">-Sin selección-</option>
										<option value="Despacho">Despacho</option>
										<option value="Hogar">Hogar</option>
										<option value="Personal">Personal</option>
									</select>
								</div>
								<span class="help-block">
								    <strong id="tipo_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_categoria">Categoría <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<select name="id_categoria" id="id_categoria" class="form-control">
										<option value="">-Sin selección-</option>
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_categoria_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="id_proveedor">Proveedor</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<select name="id_proveedor" id="id_proveedor" class="form-control">
										<option value="">-Sin seleccion-</option>
										@foreach($proveedores as $proveedor)
											<option value="{{ $proveedor->id }}">{{ $proveedor->nombre_comercial }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_proveedor_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">

						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="con_iva">con Factura?</label>
								<select name="con_iva" id="con_iva" class="form-control">
  							    	<option value="1" selected>Si</option>
  							    	<option value="0">No</option>
  							    </select>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label>Monto Total <b style="color:red">*</b></label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
									<input type="number" step="any" id="total" name="total" class="form-control" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="total_error" style="color:red"></strong>
								</span>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="porcentaje_iva">Porcentaje IVA</label>
								<div class="input-group">
									<span class="input-group-addon"><i>%</i></span>
									<input type="text" name="porcentaje_iva" id="porcentaje_iva" value="{{ $porcentaje_iva->porcentaje_iva }}" class="form-control" style="text-align: center">
								</div>
								<span class="help-block">
								    <strong id="porcentaje_iva_error" style="color:red"></strong>
								</span>
							</div>
						</div>

					</div>
					<hr>
					<div class="row">

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<div class="form-group">
								<label for="concepto">Descripción</label>
								<textarea class="form-control" name="concepto" id="concepto" rows="3" placeholder="Anote una descripción..."></textarea>
							</div>
						</div>					
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="accion">
					<input type="hidden" id="id_egreso">
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<a class="btn btn-primary btn-flat" id="btn-egreso">
						
					</a>
				</div>
			</div>
		</div>
	</form>
</div>