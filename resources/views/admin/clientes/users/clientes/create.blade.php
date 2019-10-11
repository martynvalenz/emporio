<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="users-create">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Agregar usuario o contacto de empresa</h4>
			</div>
			<form role="form" action="{{ route('clientes-users.store') }}" method="post">
			{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="id_cliente">Nombre Comercial</label>
								<input type="hidden" value="{{ $cliente->id }}" name="id_cliente">
								<input type="text" value="{{ $cliente->nombre_comercial }}" class="form-control" disabled>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
						    <label for="titulo" class="control-label">Titulo *</label>
						    <div class="input-group">
						      <span class="input-group-addon"><i class="fas fa-bookmark"></i></span>
						      <input type="text" class="form-control" placeholder="Título..." name="titulo" id="titulo" value="{{old('titulo')}}">
						    </div>
						    @if ($errors->has('titulo'))
						        <span class="help-block">
						            <strong>{{ $errors->first('titulo') }}</strong>
						        </span>
						    @endif
						  </div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
						    <label for="nombre" class="control-label">Nombre *</label>
						    <div class="input-group">
						      <span class="input-group-addon"><i class="fa fa-user"></i></span>
						      <input type="text" class="form-control" placeholder="Nombre y Apellido del contacto..." name="nombre" id="nombre" value="{{old('nombre')}}">
						    </div>
						    @if ($errors->has('nombre'))
						        <span class="help-block">
						            <strong>{{ $errors->first('nombre') }}</strong>
						        </span>
						    @endif
						  </div>
						</div>
					   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					    <div class="form-group">
					      <label for="id_puesto">Puesto</label>
					      <div class="input-group">
					      	<span class="input-group-addon"><i class="glyphicon glyphicon-tower"></i></span>
					      	<input type="text" class="form-control" placeholder="Puesto..." name="puesto" id="puesto" value="{{ old('puesto') }}">
					      </div>
					    </div>
					    @if ($errors->has('puesto'))
					        <span class="help-block">
					            <strong>{{ $errors->first('puesto') }}</strong>
					        </span>
					    @endif
					  </div>
					  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					    <div class="form-group {{ $errors->has('area') ? ' has-error' : '' }}">
					      <label for="area" class="control-label">Área</label>
					      <div class="input-group">
					        <span class="input-group-addon"><i class="fa fa-sitemap" aria-hidden="true"></i></span>
					        <input type="text" class="form-control" placeholder="Área de la empresa..." name="area" id="area" value="{{old('area')}}">
					      </div>
					      @if ($errors->has('area'))
					          <span class="help-block">
					              <strong>{{ $errors->first('area') }}</strong>
					          </span>
					      @endif
					    </div>
					  </div>
					 </div>

					 <hr>

					 <div class="row">
					 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 	  <div class="form-group">
					 	    <label for="id_pais">Razón Social</label>
					 	    <div class="input-group">
		 	    		 	    <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
		 	    		 	    <select class="form-control" name="id_pais" id="id_pais" style="width: 100%;">
		 	    		 	      @foreach ($razones_sociales as $razon)
		 	    	 	           <option value="{{ $razon->id }}">{{ $razon->razon_social }} | {{ $razon->rfc }}</option>
		 	    	 	          @endforeach
		 	    		 	    </select>
					 	    </div>
					 	  </div>
					 	</div>
					 </div>

					<hr>

					<div class="row">
					  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
					    <div class="form-group">
					      <label for="tipo" class="control-label">Tipo</label>
					      <select name="tipo" id="tipo" class="form-control">
					      	<option value="">---</option>
				        	<option value="Telefono">Teléfono</option>
				        	<option value="Celular">Celular</option>
				        	<option value="Fax">Fax</option>
					        </select>
					    </div>
					  </div>
					  <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
					  	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					  	  <div class="form-group">
					  	    <label for="telefono" class="control-label">Teléfono Principal</label>
					  	    <div class="input-group">
					  	      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
					  	      <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
					  	    </div>
					  	  </div>
					  	</div>
					  	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					  		<div class="form-group">
					  	    <label for="ext" class="control-label">Ext.</label>
					  	    <div class="input-group">
					  	      <input type="text" class="form-control" name="ext" id="ext" value="{{ old('ext') }}">
					  	    </div>
					  	  </div>
					  	</div>
					  </div>

					  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
					    <div class="form-group">
					      <label for="tipo2" class="control-label">Tipo</label>
					      <select name="tipo2" id="tipo2" class="form-control">
					      	<option value="">---</option>
				        	<option value="Telefono">Teléfono</option>
				        	<option value="Celular">Celular</option>
				        	<option value="Fax">Fax</option>
					        </select>
					    </div>
					  </div>
					  <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
					  	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					  	  <div class="form-group">
					  	    <label for="telefono2" class="control-label">Teléfono Principal</label>
					  	    <div class="input-group">
					  	      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
					  	      <input type="text" class="form-control" name="telefono2" id="telefono2" value="{{ old('telefono2') }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
					  	    </div>
					  	  </div>
					  	</div>
					  	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					  		<div class="form-group">
					  	    <label for="ext2" class="control-label">Ext.</label>
					  	    <div class="input-group">
					  	      <input type="text" class="form-control" name="ext2" id="ext2" value="{{ old('ext2') }}">
					  	    </div>
					  	  </div>
					  	</div>
					  </div>

					 <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
					    <div class="form-group">
					      <label for="tipo3" class="control-label">Tipo</label>
					      <select name="tipo3" id="tipo3" class="form-control">
					      	<option value="">---</option>
				        	<option value="Telefono">Teléfono</option>
				        	<option value="Celular">Celular</option>
				        	<option value="Fax">Fax</option>
					        </select>
					    </div>
					  </div>
					  <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
					  	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
					  	  <div class="form-group">
					  	    <label for="telefono3" class="control-label">Teléfono Principal</label>
					  	    <div class="input-group">
					  	      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
					  	      <input type="text" class="form-control" name="telefono3" id="telefono3" value="{{ old('telefono3') }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
					  	    </div>
					  	  </div>
					  	</div>
					  	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					  		<div class="form-group">
					  	    <label for="ext3" class="control-label">Ext.</label>
					  	    <div class="input-group">
					  	      <input type="text" class="form-control" name="ext3" id="ext3" value="{{ old('ext3') }}">
					  	    </div>
					  	  </div>
					  	</div>
					  </div>


					</div>

					<hr>

					<div class="row">
					
						   
						  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
						      <label for="email" class="control-label">Correo Principal</label>
						      <div class="input-group">
						        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						        <input type="email" class="form-control" placeholder="Correo..." name="email" id="email" value="{{old('email')}}">
						      </div>
						      @if ($errors->has('email'))
						          <span class="help-block">
						              <strong>{{ $errors->first('email') }}</strong>
						          </span>
						      @endif
						    </div>
						  </div>

						  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						    <div class="form-group {{ $errors->has('email2') ? ' has-error' : '' }}">
						      <label for="email2" class="control-label">Correo 2</label>
						      <div class="input-group">
						        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						        <input type="email" class="form-control" placeholder="Correo..." name="email2" id="email2" value="{{old('email2')}}">
						      </div>
						      @if ($errors->has('email2'))
						          <span class="help-block">
						              <strong>{{ $errors->first('email2') }}</strong>
						          </span>
						      @endif
						    </div>
						  </div>

						  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						    <div class="form-group {{ $errors->has('email3') ? ' has-error' : '' }}">
						      <label for="email3" class="control-label">Correo 3</label>
						      <div class="input-group">
						        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						        <input type="email" class="form-control" placeholder="Correo..." name="email3" id="email3" value="{{old('email3')}}">
						      </div>
						      @if ($errors->has('email3'))
						          <span class="help-block">
						              <strong>{{ $errors->first('email3') }}</strong>
						          </span>
						      @endif
						    </div>
						  </div>

						</div>

						<div class="row">

						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						    <div class="form-group {{ $errors->has('user') ? ' has-error' : '' }}">
						      <label for="user" class="control-label">Usuario</label>
						      <div class="input-group">
						        <span class="input-group-addon"><i class="fa fa-user"></i></span>
						        <input type="text" class="form-control" placeholder="Usuario de acceso..." name="user" id="user">
						      </div>
						      @if ($errors->has('user'))
						          <span class="help-block">
						              <strong>{{ $errors->first('user') }}</strong>
						          </span>
						      @endif
						    </div>
						  </div>

						  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
						      <label for="password" class="control-label">Contraseña</label>
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

						  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
						      <label for="password_confirmation" class="control-label">Confirmar Contraseña</label>
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

						  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 form-group has-feedback">
						    <div class="form-group">
						      <label for="estatus">Estatus</label>
						      <div class="checkbox">
						        <label>
						          <input class="icheckbox_minimal-blue" type="checkbox" name="estatus"
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
					  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					    <label for="comentarios">Comentarios</label>
					    <textarea name="comentarios" rows="4" class="form-control">{{ old('comentarios') }}</textarea>
					    <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
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
			</form>
		</div>
	</div>
</div>