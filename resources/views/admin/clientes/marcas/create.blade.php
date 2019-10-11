<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Agregar Marca nueva</h4>
			</div>
			<form role="form" action="{{ route('control.store') }}" method="post">
			{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-info"><i class="fa fa-plus"></i> Marca</button>
									</span>
									<input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Nombre de marca o título...">
								</div>
							</div>
							@if ($errors->has('nombre'))
							    <span class="help-block">
							        <strong>{{ $errors->first('nombre') }}</strong>
							    </span>
							@endif
							<br>
						</div>

					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('id_cliente') ? ' has-error' : '' }}">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-success"><i class="fa fa-user"></i> Cliente</button>
									</span>
									<input class="form-control" value="{{ $cliente->nombre_comercial }}" disabled>
									<input type="hidden" name="id_cliente" value="{{ $cliente->id }}">

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
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="descripcion">Descripción</label>
							<textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{ old('descripcion') }}</textarea>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="id_admin" value="{{ Auth::user()->id }}">
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<button type="submit" class="btn btn-azul"><span class="glyphicon glyphicon-floppy-disk"> </span> Agregar</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>