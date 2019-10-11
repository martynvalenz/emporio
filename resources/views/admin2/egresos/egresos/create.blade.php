<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="agregar">
	<form role="form" action="{{ route('egresos.store') }}" method="post">
	{{ csrf_field() }}
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Agregar Egreso</h4>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('id_proveedor') ? ' has-error' : '' }}">
								<label for="id_proveedor">Proveedor</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<select name="id_proveedor" id="id_proveedor" class="form-control">
										<option value="1">Gastos Varios</option>
										@foreach($proveedores as $proveedor)
											<option value="{{ $proveedor->id }}">{{ $proveedor->nombre_comercial }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('id_categoria') ? ' has-error' : '' }}">
								<label for="id_categoria">Categoría *</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<select name="id_categoria" id="id_categoria" class="form-control">
										<option value="">-Sin selección-</option>
										@foreach($categoria_egresos as $cat)
											<option value="{{ $cat->id }}" title="{{ $cat->descripción }}">{{ $cat->categoria }}</option>
										@endforeach
									</select>
								</div>
								@if ($errors->has('id_categoria'))
								    <span class="help-block">
								        <strong>{{ $errors->first('id_categoria') }}</strong>
								    </span>
								@endif
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
								<label for="fecha">Fecha de Egreso</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="date" name="fecha" id="fecha" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('id_cuenta') ? ' has-error' : '' }}">
								<label for="id_cuenta">Cuenta *</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
									<select name="id_cuenta" id="id_cuenta" class="form-control">
										@foreach($cuentas as $cuenta)
											<option value="{{ $cuenta->id }}">{{ $cuenta->tipo }} {{ $cuenta->alias	 }}</option>
										@endforeach
									</select>
								</div>
								@if ($errors->has('id_cuenta'))
								    <span class="help-block">
								        <strong>{{ $errors->first('id_cuenta') }}</strong>
								    </span>
								@endif
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('id_forma_pago') ? ' has-error' : '' }}">
								<label for="id_forma_pago">Forma de pago *</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
									<select name="id_forma_pago" id="id_forma_pago" class="form-control">
										@foreach($formas_pago as $forma)
											<option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
										@endforeach
									</select>
								</div>
								@if ($errors->has('id_forma_pago'))
								    <span class="help-block">
								        <strong>{{ $errors->first('id_forma_pago') }}</strong>
								    </span>
								@endif
							</div>
						</div>
					</div>
					<hr>
					<div class="row">

						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="con_iva">con Factura?</label>
								<select name="con_iva" class="form-control">
  							    	<option value="1" selected>Si</option>
  							    	<option value="0">No</option>
  							    </select>
								@if ($errors->has('con_iva'))
								    <span class="help-block">
								        <strong>{{ $errors->first('con_iva') }}</strong>
								    </span>
								@endif
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label>Monto Total *</label>
								<div class="input-group">
									<span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
									<input type="text" id="total" name="total" class="form-control" value="{{ old('total') }}">
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group {{ $errors->has('porcentaje_iva') ? ' has-error' : '' }}">
								<label for="porcentaje_iva">Porcentaje IVA</label>
								<div class="input-group">
									<span class="input-group-addon"><i>%</i></span>
									<input type="text" name="porcentaje_iva" id="porcentaje_iva" value="{{ $porcentaje_iva->porcentaje_iva }}" class="form-control">
									<!--<div class="input-group-btn">  
								    	<button type="button" class="btn btn-warning" id="bt_actualizar" data-tooltip="tooltip" title="Actualizar totales" onclick="event.preventDefault();"><i class="glyphicon glyphicon-refresh"></i></button>
								  	</div>-->
								</div>
								@if ($errors->has('porcentaje_iva'))
								    <span class="help-block">
								        <strong>{{ $errors->first('porcentaje_iva') }}</strong>
								    </span>
								@endif
							</div>
						</div>

					</div>
					<div class="row">

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group {{ $errors->has('cheque') ? ' has-error' : '' }}">
								<label for="cheque">Folio de Cheque</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
									<input type="text" name="cheque" id="cheque" value="{{ old('cheque') }}" class="form-control">
								</div>
								@if ($errors->has('cheque'))
								    <span class="help-block">
								        <strong>{{ $errors->first('cheque') }}</strong>
								    </span>
								@endif
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group {{ $errors->has('movimiento') ? ' has-error' : '' }}">
								<label for="movimiento">Movimiento Bancario</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" name="movimiento" id="movimiento" value="{{ old('movimiento') }}" class="form-control">
								</div>
								@if ($errors->has('movimiento'))
								    <span class="help-block">
								        <strong>{{ $errors->first('movimiento') }}</strong>
								    </span>
								@endif
							</div>
						</div>

					</div>
					<hr>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
								<label for="id_cliente">Asociar egreso a un cliente</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<select name="id_cliente" id="id_cliente" class="form-control">
										<option value="">-Sin selección-</option>
										@foreach($clientes as $cliente)
											<option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
										@endforeach
									</select>
								</div>
								@if ($errors->has('id_cliente'))
								    <span class="help-block">
								        <strong>{{ $errors->first('id_cliente') }}</strong>
								    </span>
								@endif
							</div>
						</div>

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('id_servicio') ? ' has-error' : '' }}">
								<label for="id_servicio">Asociar egreso a un Servicio</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
									<select name="id_servicio" id="id_servicio" class="form-control">
										<option value="">-Sin selección-</option>
									</select>
								</div>
								@if ($errors->has('id_servicio'))
								    <span class="help-block">
								        <strong>{{ $errors->first('id_servicio') }}</strong>
								    </span>
								@endif
							</div>
						</div>
					</div>
					<hr>
					<div class="row">

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<div class="form-group">
								<label for="concepto">Descripción</label>
								<textarea class="form-control has-feedback-left" name="concepto" id="concepto" rows="3" placeholder="Anote una descripción...">{{ old('concepto') }}</textarea>
							</div>
						</div>					
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin">
					<button type="submit" class="btn btn-azul">
						<span class="glyphicon glyphicon-floppy-disk"></span> Agregar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>