<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-create">
	<form role="form" action="{{ route('categoria-servicios.store') }}" method="post">
	{{ csrf_field() }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Agregar categoría de servicios</h4>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('categoria') ? ' has-error' : '' }}">
								<label for="categoria">Categoría</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<input type="text" value="{{ old('categoria') }}" name="categoria" id="categoria" class="form-control" placeholder="Categoría...">
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<div class="form-group">
								<label for="descripcion">Descripción</label>
								<textarea class="form-control has-feedback-left" name="descripcion" id="descripcion" rows="3" placeholder="Anote una descripción...">{{ old('descripcion') }}</textarea>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
							  <label for="estatus">Estatus</label>
							  <div class="checkbox">
  							    <label>
  							      <input class="" type="checkbox" name="estatus"
  							      @if (old('estatus') == 1)
  							        checked
  							      @else
  							        unchecked
  							      @endif
  							      checked="checked"> Activo
  							    </label>
  							  </div>
							</div>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
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