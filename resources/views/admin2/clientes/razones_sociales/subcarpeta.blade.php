<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-subcarpeta-{{ $razon->id }}">
	{{ Form::Open(array('action'=>array('ClienteRazonesController@subcarpeta', $razon->id), 'method'=>'put')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Agregar carpeta para razón social</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('subcarpeta') ? ' has-error' : '' }}">
							  <label for="subcarpeta" class="control-label">Carpeta</label>
							  <div class="input-group">
							    <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
							    <input type="text" class="form-control" placeholder="URL de carpeta de Google Drive..." name="subcarpeta" id="subcarpeta" value="@if(old('subcarpeta')){{ old('subcarpeta') }}@else{{ $razon->subcarpeta }}@endif">
							  </div>
							  @if ($errors->has('subcarpeta'))
							      <span class="help-block">
							          <strong>{{ $errors->first('subcarpeta') }}</strong>
							      </span>
							  @endif
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="submit" class="btn btn-azul">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar
					</button>
				</div>
			</div>
		</div>
	{{ Form::Close() }}
</div>