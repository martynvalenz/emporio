	<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-{{ $detalle->id }}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Detalle de Factura: {{ $detalle->id }}</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Creada</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" value="{{ Carbon\Carbon::parse($detalle->created_at)->format('d/m/Y') }}" class="form-control" disabled style="background-color: white">
								</div>
								
							</div>
						</div>	
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Última actualización</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" value="{{ Carbon\Carbon::parse($detalle->updated_at)->format('d/m/Y') }}" class="form-control" disabled style="background-color: white">
								</div>
								
							</div>
						</div>
					</div>
					<hr>

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Factura</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
									<input type="text" value="{{ $detalle->folio_factura }}" class="form-control" disabled style="background-color: white; text-align: center;">
								</div>	
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Recibo</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
									<input type="text" value="{{ $detalle->folio_recibo }}" class="form-control" disabled style="background-color: white; text-align: center;">
								</div>	
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Monto</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-money"></i></span>
									<input type="text" value="$ {{ number_format($detalle->monto,2) }}" class="form-control" disabled style="background-color: white; text-align: center;">
								</div>	
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Cliente</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" value="{{ $detalle->nombre_comercial }}" class="form-control" disabled style="background-color: white">
								</div>	
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>RFC</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
									<input type="text" value="{{ $detalle->rfc }}" class="form-control" disabled style="background-color: white">
								</div>	
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Razón Social</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bank"></i></span>
									<input type="text" value="{{ $detalle->razon_social }}" class="form-control" disabled style="background-color: white">
								</div>	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Servicio</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
									<textarea class="form-control" rows="3" disabled style="background-color: white">{{ $detalle->clave }} {{ $detalle->servicio }} {{ $detalle->tramite }} {{ $detalle->marca }} {{ $detalle->clase }}</textarea>
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