<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="detalles-{{ $ingreso->id }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Detalles de Cobro: {{ $ingreso->id }}</h4>
			</div>
			<div class="modal-body">
				
				<div class="row">
				    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				      <div class="form-group">
				        <label for="id_cliente" class="control-label">Cliente</label>
				        <div class="input-group">
				            <span class="input-group-addon"><i class="fa fa-user"></i></span>
				            <input type="text" class="form-control" value="{{ $ingreso->nombre_comercial }}">
				        </div>
				      </div>                
				    </div>

				    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				      <div class="form-group">
				        <label for="fecha" class="control-label">Fecha</label>
				        <div class="input-group">
				            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				            <input type="date" value="{{ $ingreso->fecha }}" class="form-control">
				        </div>
				      </div>                
				    </div>


				</div>
				<div class="row">

				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				      <div class="form-group">
				        <label for="id_razon_social" class="control-label">Razón Social</label>
				        <div class="input-group">
				            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
				            <input type="text" class="form-control" value="{{ $ingreso->razon_social }} | {{ $ingreso->rfc }}">
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
								<input type="text" class="form-control" value="{{ $ingreso->alias }} {{ $ingreso->banco }}">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label for="id_forma_pago">Forma de pago <b style="color:red">*</b></label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
								<input type="text" class="form-control" value="{{ $ingreso->codigo }} - {{ $ingreso->forma_pago }}">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Monto Total</label>
							<div class="input-group">
								<span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
								<input type="text" class="form-control" value="{{ $ingreso->total }}">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="cheque">Folio de Cheque</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
								<input type="text" value="{{ $ingreso->cheque }}" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="movimiento">Movimiento Bancario</label>
							<div class="input-group">
								<span class="input-group-addon"><i>#</i></span>
								<input type="text" value="{{ $ingreso->movimiento }}" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
						<div class="form-group">
							<label for="porcentaje_iva">Porcentaje IVA</label>
							<div class="input-group">
								<span class="input-group-addon"><i>%</i></span>
								<input type="text" value="{{ $ingreso->porcentaje_iva }}" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<label for="porcentaje_iva">Usuario</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input type="text" value="{{ $ingreso->iniciales }} - {{ $ingreso->nombre }} {{ $ingreso->apellido }}" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="form-group">
							<label for="porcentaje_iva">Estatus</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-flag"></i></span>
								<input type="text" value="{{ $ingreso->estatus }}" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<label for="concepto">Comentarios</label>
						<textarea name="concepto" id="concepto" rows="3" class="form-control">{{ $ingreso->concepto }}</textarea>
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