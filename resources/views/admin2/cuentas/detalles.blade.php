<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-{{ $cuenta->id }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Cuenta: {{ $cuenta->alias }}</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label>Creada</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" value="{{ $cuenta->created_at->toDateString() }}" class="form-control" disabled style="background-color: white">
							</div>
							
						</div>
					</div>	
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label>Última actualización</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" value="{{ $cuenta->updated_at->toDateString() }}" class="form-control" disabled style="background-color: white">
							</div>
							
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Tipo de Cuenta</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
								<input type="text" value="{{ $cuenta->tipo }}" class="form-control" disabled style="background-color: white">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Alias</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
								<input type="text" value="{{ $cuenta->alias }}" class="form-control" disabled style="background-color: white">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Banco</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-university"></i></span>
								<input type="text" value="{{ $cuenta->banco }}" class="form-control" disabled style="background-color: white">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label>Cuenta</label>
							<div class="input-group">
								<span class="input-group-addon"><i><b>#</b></i></span>
								<input type="text" value="{{ $cuenta->cuenta }}" class="form-control" disabled style="background-color: white">
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label>Número de Tarjeta</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-credit-card-alt"></i></span>
								<input type="text" value="{{ $cuenta->tarjeta }}" class="form-control" disabled style="background-color: white" data-inputmask='"mask": "#### #### #### ####"' data-mask>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="form-group">
							<label>CLABE</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
								<input type="text" value="{{ $cuenta->clabe }}" class="form-control" disabled style="background-color: white">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Saldo Inicial</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-money"></i></span>
								<input type="number" value="{{ number_format($cuenta->saldo_inicial,2) }}" class="form-control" disabled style="background-color: white">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					  <label for="comentarios">Comentarios</label>
					  <textarea rows="3" class="form-control has-feedback-left" disabled style="background-color: white">{{ $cuenta->comentarios }}</textarea>
					  <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
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