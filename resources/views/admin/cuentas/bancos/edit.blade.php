<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-edit-{{ $banco->id }}">
	{{ Form::Open(array('action'=>array('BancosController@update', $banco->id), 'method'=>'put')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Editar Banco</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group {{ $errors->has('banco') ? ' has-error' : '' }}">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-info"><i class="fas fa-university"></i> Banco</label>
									</span>
									<input type="text" name="banco" id="banco" class="form-control" value="@if(old('banco')){{ old('banco') }}@else{{ $banco->banco }}@endif" placeholder="Nombre del Banco...">
								</div>
								@if ($errors->has('banco'))
								    <span class="help-block">
								        <strong>{{ $errors->first('banco') }}</strong>
								    </span>
								@endif
							</div>
							<br>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<button type="submit" class="btn btn-success">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	{{ Form::Close() }}
</div>