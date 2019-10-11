<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-contra-{{ $user->id }}">
	{{ Form::Open(array('action'=>array('UserController@contra', $user->id), 'method'=>'put')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Modificar Contraseña</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea cambiar la contraseña para el usuario: <span> {{ $user->iniciales }} - {{ $user->nombre }} {{ $user->apellido }}</span> ?
					</h4>
					<hr>
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2">
							<div class="form-group">
							  <label for="contra" class="control-label">Contraseña Actual</label>
							  <div class="input-group">
							    <span class="input-group-addon"><i class="fa fa-user"></i></span>
							    <input type="text" class="form-control" disabled style="background-color: white; color:#666666" value={{ $user->contra }}>
							  </div>
							</div>
						</div>
						<div class="col-lg-8 col-lg-offset-2">
							<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
							  <label for="password" class="control-label">Contraseña Nueva *</label>
							  <div class="input-group">
							    <span class="input-group-addon"><i class="fa fa-key"></i></span>
							    <input type="text" class="form-control" placeholder="Contraseña..." name="password" id="password">
							  </div>
							  @if ($errors->has('password'))
							      <span class="help-block">
							          <strong>{{ $errors->first('password') }}</strong>
							      </span>
							  @endif
							</div>
						</div>
						<div class="col-lg-8 col-lg-offset-2">
							<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							  <label for="password_confirmation" class="control-label">Confirmar Contraseña *</label>
							  <div class="input-group">
							    <span class="input-group-addon"><i class="fa fa-key"></i></span>
							    <input type="text" class="form-control" placeholder="Contraseña..." name="password_confirmation" id="password_confirmation">
							  </div>
							  @if ($errors->has('password_confirmation'))
							      <span class="help-block">
							          <strong>{{ $errors->first('password_confirmation') }}</strong>
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
						<span class="glyphicon glyphicon-floppy-disk"></span> Actualizar
					</button>
				</div>
			</div>
		</div>
	{{ Form::Close() }}
</div>