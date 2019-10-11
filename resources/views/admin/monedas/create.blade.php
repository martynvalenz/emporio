<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-create">
	<form role="form" action="{{ route('monedas.store') }}" method="post">
	{{ csrf_field() }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #1869B3">
					<h4 class="modal-title" style="color: white;">Agregar moneda y tipo de cambio</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="color: white;"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<div class="form-group {{ $errors->has('clave') ? ' has-error' : '' }}">
								<label for="clave">Clave</label>
								<div class="input-group">
									<span class="input-group-addon"><i>#</i></span>
									<input type="text" value="{{ old('clave') }}" name="clave" id="clave" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
							<div class="form-group {{ $errors->has('moneda') ? ' has-error' : '' }}">
								<label for="moneda">Moneda</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
									<input type="text" value="{{ old('moneda') }}" name="moneda" id="moneda" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="form-group {{ $errors->has('pais') ? ' has-error' : '' }}">
								<label for="pais">País</label>
								<select class="form-control" name="pais" id="pais" style="width: 100%;">
								  @foreach ($paises as $pais)
								    <option>{{ $pais->pais }}</option>
								  @endforeach
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group {{ $errors->has('conversion') ? ' has-error' : '' }}">
								<label for="conversion">Tipo de cambio</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
									<input type="decimal" value="{{ old('conversion') }}" name="conversion" id="conversion" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="">Estatus</label>
								<select name="estatus" id="estatus" class="form-control">
									<option value="1">Activo</option>
									<option value="0">Inactivo</option>
								</select>
							</div>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-grey" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<button type="submit" class="btn btn-primary">
						<span class="fas fa-save"></span> Agregar
					</button>
				</div>
			</div>
		</div>
	</form>
</div>