<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-editar-{{ $moneda->id }}">
	{{ Form::Open(array('action'=>array('MonedasController@update', $moneda->id), 'method'=>'put')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #3A8B8A">
					<h4 class="modal-title" style="color: white;">Editar moneda y tipo de cambio</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="color: white;"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea actualizar el tipo de cambio o datos de la moneda?
					</h4>

					<hr>

					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Creada</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="date" value="{{ $moneda->created_at->toDateString() }}" class="form-control" disabled>
								</div>
								
							</div>
						</div>	
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label>Última actualización</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="date" value="{{ $moneda->updated_at->toDateString() }}" class="form-control" disabled>
								</div>
								
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group {{ $errors->has('clave') ? ' has-error' : '' }}">
								<label for="clave">Clave</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" value="@if(old('clave')){{ old('clave') }}@else{{ $moneda->clave }}@endif" name="clave" id="clave" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group {{ $errors->has('moneda') ? ' has-error' : '' }}">
								<label for="moneda">Moneda</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
									<input type="text" value="@if(old('moneda')){{ old('moneda') }}@else{{ $moneda->moneda }}@endif" name="moneda" id="moneda" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
							<div class="form-group {{ $errors->has('pais') ? ' has-error' : '' }}">
								<label for="pais">País</label>
								<select class="form-control" name="pais" id="pais" style="width: 100%;">
								  @foreach ($paises as $pais)
								    @if ($pais->pais == $moneda->pais)
								      <option value="{{ $pais->pais }}" selected>{{ $pais->pais }}</option>
								    @else
								      <option value="{{ $pais->pais }}">{{ $pais->pais }}</option>
								    @endif
								  @endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('conversion') ? ' has-error' : '' }}">
								<label for="conversion">Tipo de cambio</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
									<input type="decimal" value="@if(old('conversion')){{ old('conversion') }}@else{{ $moneda->conversion }}@endif" name="conversion" id="conversion" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  							<div class="form-group">
  								<label for="">Estatus</label>
  								<select name="estatus" id="estatus" class="form-control">
  									@if($moneda->estatus == 1)
	  									<option value="1" selected>Activo</option>
	  									<option value="0">Inactivo</option>
	  								@else
	  									<option value="1">Activo</option>
	  									<option value="0" selected>Inactivo</option>
	  								@endif
  								</select>
  							</div>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-grey" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<button type="submit" class="btn btn-success">
						<span class="fas fa-save"></span> Actualizar
					</button>
				</div>
			</div>
		</div>
	{{ Form::Close() }}
</div>