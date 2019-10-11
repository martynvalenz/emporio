<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar-categoria">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Agregar categoría de egresos</h4>
			</div>
			{{ Form::Open(array('action'=>array('EgresosController@categoria'), 'method'=>'post')) }}
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('categoria') ? ' has-error' : '' }}">
							  <label for="categoria" class="control-label">Categoía *</label>
							  <div class="input-group">
							    <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
							    <input type="text" class="form-control" placeholder="Nombre de categoria..." name="categoria" id="categoria" value="{{old('categoria')}}">
							  </div>
							  @if ($errors->has('categoria'))
							      <span class="help-block">
							          <strong>{{ $errors->first('categoria') }}</strong>
							      </span>
							  @endif
							</div>
						</div>	

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
							  <label for="categoria" class="control-label">Descripción</label>
							  <textarea name="descripcion" id="descripcion" rows="3" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<input name="clasificacion" value="Despacho" type="hidden">
					<button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			{{ Form::Close() }}
		</div>
	</div>
</div>