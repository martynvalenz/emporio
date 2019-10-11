<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-edit-{{ $egreso->id }}">
	{{ Form::Open(array('action'=>array('EgresosController@update', $egreso->id), 'method'=>'put')) }}
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Editar Egreso</h4>
				</div>
				<div class="modal-body">

					<div class="row pull-right">
					  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					    <div class="form-group">
					      <label for="created_at">Creado</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
					        <input type="text" value="{{ Carbon\Carbon::parse($egreso->created_at)->diffForHumans() }}" class="form-control" style="background-color: #f5f5f5;" disabled title="{{ Carbon\Carbon::parse($egreso->created_at)->format('d/m/Y') }}" data-tooltip="tooltip">
					      </div>
					    </div>
					  </div>

					  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					    <div class="form-group">
					      <label for="updated_at">Último cambio</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
					        <input type="text" value="{{ Carbon\Carbon::parse($egreso->updated_at)->diffForHumans() }}" class="form-control" style="background-color: #f5f5f5;" disabled title="{{ Carbon\Carbon::parse($egreso->updated_at)->format('d/m/Y') }}" data-tooltip="tooltip">
					      </div>
					    </div>
					  </div>  

					  @if($egreso->estatus == 'Cancelado')
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						  <div class="form-group">
						    <label for="updated_at">Cancelado</label>
						    <div class="input-group">
						      <span class="input-group-addon" style="background-color: red; color:white"><i class="fa fa-calendar"></i></span>
						      <input type="text" value="{{ Carbon\Carbon::parse($egreso->cancelado_at)->diffForHumans() }}" class="form-control" style="background-color: #f5f5f5;" disabled title="{{ Carbon\Carbon::parse($egreso->cancelado_at)->format('d/m/Y') }}" data-tooltip="tooltip">
						    </div>
						  </div>
						</div> 
					  @endif
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('id_proveedor') ? ' has-error' : '' }}">
								<label for="id_proveedor">Proveedor</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<select name="id_proveedor" id="id_proveedor" class="form-control">
										@foreach ($proveedores as $proveedor)
											@if ($proveedor->id == $egreso->id_proveedor)
												<option value="{{ $proveedor->id }}" selected>{{ $proveedor->nombre_comercial }}</option>
											@else
												<option value="{{ $proveedor->id }}">{{ $proveedor->nombre_comercial }}</option>
											@endif
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
										@foreach ($categoria_egresos as $cat)
											@if ($cat->id == $egreso->id_categoria)
												<option value="{{ $cat->id }}" selected>{{ $cat->categoria }}</option>
											@else
												<option value="{{ $cat->id }}">{{ $cat->categoria }}</option>
											@endif
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
									<input type="date" name="fecha" id="fecha" class="form-control" value="@if(old('fecha')){{ old('fecha') }}@else{{ $egreso->fecha }}@endif">
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
										@foreach ($cuentas as $cuenta)
											@if ($cuenta->id == $egreso->id_cuenta)
												<option value="{{ $cuenta->id }}" selected>{{ $cuenta->tipo }} {{ $cuenta->alias }}</option>
											@else
												<option value="{{ $cuenta->id }}">{{ $cuenta->tipo }} {{ $cuenta->alias }}</option>
											@endif
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
										@foreach ($formas_pago as $forma)
											@if ($forma->id == $egreso->id_forma_pago)
												<option value="{{ $forma->id }}" selected>{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
											@else
												<option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
											@endif
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
									@if($egreso->con_iva == 1)
	  							    	<option value="1" selected>Si</option>
	  							    	<option value="0">No</option>
	  							    @else
	  							    	<option value="1">Si</option>
	  							    	<option value="0" selected>No</option>
	  							    @endif
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
									<span class="input-group-addon" style="background-color:green; color:white"><i class="fa fa-money"></i></span>
									<input type="text" id="total" name="total" class="form-control" value="@if(old('total')){{ old('total') }}@else{{ $egreso->total }}@endif">
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group {{ $errors->has('porcentaje_iva') ? ' has-error' : '' }}">
								<label for="porcentaje_iva">Porcentaje IVA</label>
								<div class="input-group">
									<span class="input-group-addon"><i>%</i></span>
									<input type="text" name="porcentaje_iva" id="porcentaje_iva" value="{{ $porcentaje_iva->porcentaje_iva }}" class="form-control">
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
									<input type="text" name="cheque" id="cheque" value="@if(old('cheque')){{ old('cheque') }}@else{{ $egreso->cheque }}@endif" class="form-control">
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
									<input type="text" name="movimiento" id="movimiento" value="@if(old('movimiento')){{ old('movimiento') }}@else{{ $egreso->movimiento }}@endif" class="form-control">
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
									<select name="id_cliente" id="cliente-{{ $egreso->id_cliente }}" class="form-control">
										<option value="">-Sin selección-</option>
										@foreach ($clientes as $cliente)
											@if ($cliente->id == $egreso->id_cliente)
											<option value="{{ $cliente->id }}" selected>{{ $cliente->nombre_comercial }}</option>
											@else
												<option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
											@endif			
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
									<select name="id_servicio" id="servicio-{{ $egreso->id_servicio }}" class="form-control">
										<option value="">-Sin selección-</option>
										@foreach ($servicios as $servicio)
											@if ($servicio->id == $egreso->id_servicio)
												<option value="{{ $servicio->id }}" selected>{{ $servicio->CatalogoServicios->clave }} {{ $servicio->CatalogoServicios->servicio }} {{ $servicio->tramite }} {{ $servicio->clase }}</option>
											@elseif($servicio->id_cliente == $egreso->id_cliente)
												<option value="{{ $servicio->id }}">{{ $servicio->CatalogoServicios->clave }} {{ $servicio->CatalogoServicios->servicio }} {{ $servicio->tramite }} {{ $servicio->clase }}</option>
											@endif
										@endforeach
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
								<textarea class="form-control has-feedback-left" name="concepto" id="concepto" rows="3" placeholder="Anote una descripción...">@if(old('concepto')){{ old('concepto') }}@else{{ $egreso->concepto }}@endif</textarea>
							</div>
						</div>

						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="estatus">Estatus</label>
								<select name="estatus" class="form-control">
									@if($egreso->estatus == "Pagado")
	  							    	<option value="Pagado" selected>Pagado</option>
	  							    	<option value="Pendiente">Pendiente</option>
	  							    	<option value="Cancelado">Cancelado</option>
	  							    @elseif($egreso->estatus == "Pendiente")
	  							    	<option value="Pagado">Pagado</option>
	  							    	<option value="Pendiente" selected>Pendiente</option>
	  							    	<option value="Cancelado">Cancelado</option>
	  							    @elseif($egreso->estatus == "Cancelado")
	  							    	<option value="Pagado">Pagado</option>
	  							    	<option value="Pendiente">Pendiente</option>
	  							    	<option value="Cancelado" selected>Cancelado</option>
	  							    @endif
								</select>
							</div>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-azul">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	{{ Form::Close() }}
</div>