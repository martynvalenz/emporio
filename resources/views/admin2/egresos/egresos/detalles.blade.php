<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-egreso-{{ $egreso->id }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Detalles de Egreso</h4>
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
						<div class="form-group">
							<label for="id_proveedor">Proveedor</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->nombre_comercial }}">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="id_categoria">Categoría</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->categoria }}">
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="fecha">Fecha de Egreso</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" class="form-control" value="{{ $egreso->fecha }}">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="id_cuenta">Cuenta</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->tarjeta_tipo }} {{ $egreso->banco }}">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="id_forma_pago">Forma de pago</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->codigo }} {{ $egreso->forma_pago }}">
							</div>
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

					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Subtotal</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-money"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->subtotal }}">
							</div>
						</div>
					</div>

					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="porcentaje_iva">Porcentaje IVA</label>
							<div class="input-group">
								<span class="input-group-addon"><i>%</i></span>
								<input type="text" class="form-control" value="{{ $egreso->porcentaje_iva }}">
							</div>
						</div>
					</div>

					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>IVA</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-money"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->iva }}">
							</div>
						</div>
					</div>

					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Monto Total</label>
							<div class="input-group">
								<span class="input-group-addon" style="background-color:green; color:white"><i class="fa fa-money"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->total }}">
							</div>
						</div>
					</div>

				</div>
				<div class="row">

					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="cheque">Folio de Cheque</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->cheque }}">
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="movimiento">Movimiento Bancario</label>
							<div class="input-group">
								<span class="input-group-addon"><i>#</i></span>
								<input type="text" class="form-control" value="{{ $egreso->movimiento }}">
							</div>
						</div>
					</div>

				</div>
				<hr>
				<div class="row">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label for="cheque">Cliente</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->cliente }}">
							</div>
						</div>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label for="movimiento">Servicio asociado</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->clave }} {{ $egreso->servicio }} {{ $egreso->tramite }} {{ $egreso->clase }}">
							</div>
						</div>
					</div>

				</div>
				<hr>
				<div class="row">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<div class="form-group">
							<label for="concepto">Descripción</label>
							<textarea class="form-control has-feedback-left" name="concepto" id="concepto" rows="3" placeholder="Anote una descripción...">{{ $egreso->concepto }}</textarea>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="estatus">Estatus</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-flag"></i></span>
								<select name="estatus" class="form-control" disabled>
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

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group has-feedback">
						<div class="form-group">
							<label for="concepto">Usuario</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" class="form-control" value="{{ $egreso->iniciales }} - {{ $egreso->nombre }} {{ $egreso->apellido }}">
							</div>
						</div>
					</div>
				</div>

				
				
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gris" data-dismiss="modal">
					Cerrar <span class="glyphicon glyphicon-remove"></span>
				</button>
			</div>
		</div>
	</div>
</div>