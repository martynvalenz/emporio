<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-edit-{{ $categoria->id }}">
	{{ Form::Open(array('action'=>array('CategoriaEgresosController@update', $categoria->id), 'method'=>'put')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Editar categoría</h4>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('clasificacion') ? ' has-error' : '' }}">
								<label for="clasificacion">Clasificación</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<select class="form-control" name="clasificacion" id="clasificacion" style="width: 100%;">
				                         @if ($categoria->clasificacion=='Despacho')
				                           <option value="Despacho" selected>Despacho</option>
					                       <option value="Personales">Personales</option>
					                       <option value="Hogar">Hogar</option>
				                         @elseif ($categoria->clasificacion=='Personales')
					                       <option value="Despacho">Despacho</option>
					                       <option value="Personales" selected>Personales</option>
					                       <option value="Hogar">Hogar</option>
				                         @elseif ($categoria->clasificacion=='Hogar')
				                           <option value="Despacho">Despacho</option>
				                       		<option value="Personales">Personales</option>
				                       		<option value="Hogar" selected>Hogar</option>
				                         @endif
		                     		</select>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('cuenta') ? ' has-error' : '' }}">
								<label for="cuenta">Cuenta</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-book"></i></span>
									<input type="text" value="@if(old('cuenta')){{ old('cuenta') }}@else{{ $categoria->cuenta }}@endif" name="cuenta" id="cuenta" class="form-control" placeholder="100001">
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('subcuenta') ? ' has-error' : '' }}">
								<label for="subcuenta">Subcuenta</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<input type="text" value="@if(old('subcuenta')){{ old('subcuenta') }}@else{{ $categoria->subcuenta }}@endif" name="subcuenta" id="subcuenta" class="form-control" placeholder="100001">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group {{ $errors->has('categoria') ? ' has-error' : '' }}">
								<label for="categoria">Categoría *</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
									<input type="text" value="@if(old('categoria')){{ old('categoria') }}@else{{ $categoria->categoria }}@endif" name="categoria" id="categoria" class="form-control" placeholder="Categoría...">
								</div>
								@if ($errors->has('categoria'))
								    <span class="help-block">
								        <strong>{{ $errors->first('categoria') }}</strong>
								    </span>
								@endif
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<div class="form-group">
								<label for="descripcion">Descripción</label>
								<textarea class="form-control has-feedback-left" name="descripcion" id="descripcion" rows="3" placeholder="Anote una descripción...">@if(old('descripcion')){{ old('descripcion') }}@else{{ $categoria->descripcion }}@endif</textarea>
							</div>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-azul">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>