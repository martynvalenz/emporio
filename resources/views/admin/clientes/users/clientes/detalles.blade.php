<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-{{ $user->id }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Usuario: {{ $user->nombre }}</h4>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					  <div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
					    <label for="titulo" class="control-label">Titulo</label>
					    <div class="input-group">
					      <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>
					      <input type="text" class="form-control" placeholder="Título..." name="titulo" id="titulo" value="@if(old('titulo')){{ old('titulo') }}@else{{ $user->titulo }}@endif">
					    </div>
					  </div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					  <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
					    <label for="nombre" class="control-label">Nombre</label>
					    <div class="input-group">
					      <span class="input-group-addon"><i class="fa fa-user"></i></span>
					      <input type="text" class="form-control" placeholder="Nombre y Apellido del contacto..." name="nombre" id="nombre" value="@if(old('nombre')){{ old('nombre') }}@else{{ $user->nombre }}@endif">
					    </div>
					  </div>
					</div>
				   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group">
				      <label for="id_puesto">Puesto</label>
				      <div class="input-group">
				      	<span class="input-group-addon"><i class="glyphicon glyphicon-tower"></i></span>
				      	<input type="text" class="form-control" placeholder="Puesto..." name="puesto" id="puesto" value="@if(old('puesto')){{ old('puesto') }}@else{{ $user->puesto }}@endif">
				      </div>
				    </div>
				  </div>
				  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				    <div class="form-group {{ $errors->has('area') ? ' has-error' : '' }}">
				      <label for="area" class="control-label">Área</label>
				      <div class="input-group">
				        <span class="input-group-addon"><i class="fa fa-sitemap" aria-hidden="true"></i></span>
				        <input type="text" class="form-control" placeholder="Área de la empresa..." name="area" id="area" value="@if(old('area')){{ old('area') }}@else{{ $user->area }}@endif">
				      </div>
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
                            <select class="form-control" name="id_estrategia" id="id_estrategia" style="width: 100%;" disabled>
                                @foreach ($razones_sociales as $razon)
		 	    		 	        @if ($razon->id == $user->id_razon_social)
		 	    		 	       		<option value="{{ $razon->id }}" selected>{{ $razon->razon_social }} | {{ $razon->rfc }}</option>
		 	    		 	        @else
		 	    		 	        	<option value="{{ $razon->id }}">{{ $razon->razon_social }} | {{ $razon->rfc }}</option>
		 	    		 	        @endif
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
                            <label for="tipo" class="control-label" >Tipo</label>
                            <input type="text" value="{{ $user->tipo }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Teléfono Principal</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $user->telefono }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label for="ext" class="control-label">Ext.</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ext" id="ext" value="{{ $user->ext }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="tipo2" class="control-label">Tipo</label>
                            <input type="text" value="{{ $user->tipo2 }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label for="telefono2" class="control-label">Teléfono Principal</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" name="telefono2" id="telefono2" value="{{ $user->telefono2 }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label for="ext2" class="control-label">Ext.</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ext2" id="ext2" value="{{ $user->ext2 }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="tipo3" class="control-label">Tipo</label>
                            <input type="text" value="{{ $user->tipo3 }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label for="telefono3" class="control-label">Teléfono Principal</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" name="telefono3" id="telefono3" value="{{ $user->telefono3 }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label for="ext3" class="control-label">Ext.</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ext3" id="ext3" value="{{ $user->ext3 }}">
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
                                <input type="email" class="form-control" placeholder="Correo..." name="email" id="email" value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group {{ $errors->has('email2') ? ' has-error' : '' }}">
                            <label for="email2" class="control-label">Correo 2</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Correo..." name="email2" id="email2" value="{{ $user->email2 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group {{ $errors->has('email3') ? ' has-error' : '' }}">
                            <label for="email3" class="control-label">Correo 3</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" placeholder="Correo..." name="email3" id="email3" value="{{ $user->email3 }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group {{ $errors->has('user') ? ' has-error' : '' }}">
                            <label for="user" class="control-label">Usuario</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Usuario de acceso..." name="user" id="user" value="{{ $user->user }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group {{ $errors->has('contra') ? ' has-error' : '' }}">
                            <label for="contra" class="control-label">Contraseña Actual</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control" placeholder="Contraseña..." name="contra" id="contra" value="{{ $user->contra }}">
                            </div>
                        </div>
                    </div>
				</div>

				<div class="row">
					
					  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
					    <label for="comentarios">Comentarios</label>
					    <textarea name="comentarios" rows="3" class="form-control">@if(old('comentarios')){{ old('comentarios') }}@else{{ $user->comentarios }}@endif</textarea>
					    <span class="fath-list form-control-feedback left" aria-hidden="true"></span>
					  </div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gris" data-dismiss="modal">
					Cerrar <span class="glyphicon glyphicon-remove"></span>
				</button>
			</div>
		</div>
	</div>
</div>