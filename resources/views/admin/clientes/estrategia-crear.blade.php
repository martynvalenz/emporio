<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar-estrategia">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Agregar estrategia de captación</h4>
			</div>
			{{ Form::Open(array('action'=>array('ClientesController@estrategia_crear'), 'method'=>'post')) }}
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('estrategia') ? ' has-error' : '' }}">
							  <label for="estrategia" class="control-label">Estrategia</label>
							  <div class="input-group">
							    <span class="input-group-addon"><i class="fas fa-chart-line"></i></span>
							    <input type="text" class="form-control" placeholder="Nombre de estrategia..." name="estrategia" id="estrategia" value="{{old('estrategia')}}">
							  </div>
							  @if ($errors->has('estrategia'))
							      <span class="help-block">
							          <strong>{{ $errors->first('estrategia') }}</strong>
							      </span>
							  @endif
							</div>
						</div>	
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
							  <label for="estatus">Estatus</label>
							  <div class="checkbox">
							    <label disabled>
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
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
				</div>
			{{ Form::Close() }}
		</div>
	</div>
</div>