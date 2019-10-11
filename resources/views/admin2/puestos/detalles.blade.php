<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-{{ $puesto->id }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Puesto: {{ $puesto->puesto }}</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label>Creado</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" value="{{ $puesto->created_at->toDateString() }}" class="form-control" disabled>
							</div>
							
						</div>
					</div>	
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label>Última actualización</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" value="{{ $puesto->updated_at->toDateString() }}" class="form-control" disabled>
							</div>
							
						</div>
					</div>
				</div>
				<hr>
				<p>{!! htmlspecialchars_decode($puesto->descripcion) !!}</p>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gris" data-dismiss="modal">
					Cerrar <span class="glyphicon glyphicon-remove"></span>
				</button>
			</div>
		</div>
	</div>
</div>