<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-editar-{{ $control->id }}">
	{{ Form::Open(array('action'=>array('ControlController@update', $control->id), 'method'=>'put')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Editar: {{ $control->nombre }}</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-info"><i class="fa fa-plus"></i> Marca</label>
									</span>
									<input type="text" name="nombre" id="nombre" class="form-control" value="@if(old('nombre')){{ old('nombre') }}@else{{ $control->nombre }}@endif" placeholder="Nombre de marca o título...">
								</div>
								@if ($errors->has('nombre'))
								    <span class="help-block">
								        <strong>{{ $errors->first('nombre') }}</strong>
								    </span>
								@endif
							</div>
							<br>
						</div>

					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-success"><i class="fa fa-user"></i> Cliente</label>
									</span>
									<select class="form-control" name="id_cliente" id="id_cliente" style="width: 100%;">
				                       @foreach ($clientes as $cliente)
				                         @if ($cliente->id == $control->id_cliente)
				                           <option value="{{ $cliente->id }}" selected>{{ $cliente->nombre_comercial }}</option>
				                         @else
				                           <option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
				                         @endif
				                       @endforeach
		                     		</select>
								</div>
								@if ($errors->has('id_cliente'))
								    <span class="help-block">
								        <strong>{{ $errors->first('id_cliente') }}</strong>
								    </span>
								@endif
							</div>
						</div>
						
					</div>
					<div class="row">
						<br>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="descripcion">Descripción</label>
							<textarea name="descripcion" id="descripcion" rows="3" class="form-control">@if(old('descripcion')){{ old('descripcion') }}@else{{ $control->descripcion }}@endif</textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="estatus" value="{{ $control->estatus }}">
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