<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-{{ $clase->id }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h3 class="modal-title" style="color: white;">{{ $clase->clave }}</h3>
			</div>
			<div class="modal-body">
				<div class="row">

					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
							<label>Creada</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" value="{{ $clase->created_at->toDateString() }}" class="form-control" disabled style="background-color: white; color:black">
							</div>
						</div>
					</div>	
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
							<label>Última actualización</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="date" value="{{ $clase->updated_at->toDateString() }}" class="form-control" disabled style="background-color: white; color:black">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="form-group">
							<label>Clave</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
								<input type="text" value="{{ $clase->clave }}" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Clase</label>
							<p>{{ $clase->clase }}</p>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 form-group has-feedback">
					  <div class="form-group">
					    <label for="estatus">Estatus</label>
					    <div class="checkbox">
					      <label>
					        {!! Form::checkbox('estatus', null, $clase->estatus == 1 ? true : false, array('class'=> 'icheckbox_minimal-blue')) !!} Activo
					      </label>
					    </div>
					  </div>
					</div>
				</div>
				<hr>

				<div class="row">
				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    <label for="comentarios">Descripción</label>
				    <p>{!! htmlspecialchars_decode($clase->descripcion) !!}</p>
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