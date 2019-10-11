<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-editar-{{ $user->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                </button>
                <h4 class="modal-title" style="color: white;">Editar usuario: {{ $user->nombre }}</h4>
            </div>
            {{ Form::Open(array('action'=>array('ClienteUsersController@update', $user->id), 'method'=>'put')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group {{ $errors->has('titulo') ? ' has-error' : '' }}">
                            <label for="titulo" class="control-label">Titulo</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-bookmark"></i></span>
                                <input type="text" class="form-control" placeholder="Título..." name="titulo" id="titulo" value="@if(old('titulo')){{ old('titulo') }}@else{{ $user->titulo }}@endif">
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
                                <input type="text" class="form-control" placeholder="Nombre y Apellido del contacto..." name="nombre" id="nombre" value="@if(old('nombre')){{ old('nombre') }}@else{{ $user->nombre }}@endif">
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
                                <input type="text" class="form-control" placeholder="Puesto..." name="puesto" id="puesto" value="@if(old('puesto')){{ old('puesto') }}@else{{ $user->puesto }}@endif">
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
                                <input type="text" class="form-control" placeholder="Área de la empresa..." name="area" id="area" value="@if(old('area')){{ old('area') }}@else{{ $user->area }}@endif">
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
                            <label>Cliente *</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                <select name="id_cliente" class="form-control">
                                    <option value="">--Seleccionar Cliente--</option>
                                    @foreach ($clientes as $cliente)
                                        @if ($cliente->id == $user->id_cliente)
                                            <option value="{{ $cliente->id }}" selected>{{ $cliente->nombre_comercial }}</option>
                                        @else
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre_comercial }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="id_pais">Razón Social</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                <select class="form-control" name="id_estrategia" id="id_estrategia" style="width: 100%;">
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
                    </div>-->
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="tipo" class="control-label">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control" value="{{ old('tipo') }}">
                                @if($user->tipo == null)
                                    <option value="" selected>---</option>
                                    <option value="Telefono">Teléfono</option>
                                    <option value="Celular">Celular</option>
                                    <option value="Fax">Fax</option>
                                @elseif($user->tipo == 'Telefono')
                                    <option value="">---</option>
                                    <option value="Telefono" selected>Teléfono</option>
                                    <option value="Celular">Celular</option>
                                    <option value="Fax">Fax</option>
                                @elseif($user->tipo == 'Celular')
                                    <option value="">---</option>
                                    <option value="Telefono">Teléfono</option>
                                    <option value="Celular" selected>Celular</option>
                                    <option value="Fax">Fax</option>
                                @elseif($user->tipo == 'Fax')
                                    <option value="">---</option>
                                    <option value="Telefono">Teléfono</option>
                                    <option value="Celular">Celular</option>
                                    <option value="Fax" selected>Fax</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Teléfono Principal</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" name="telefono" id="telefono" value="@if(old('telefono')){{ old('telefono') }}@else{{ $user->telefono }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label for="ext" class="control-label">Ext.</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ext" id="ext" value="@if(old('ext')){{ old('ext') }}@else{{ $user->ext }}@endif">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="tipo2" class="control-label">Tipo</label>
                            <select name="tipo2" id="tipo2" class="form-control" value="{{ old('tipo2') }}">
                                @if($user->tipo2 == null)
                                    <option value="" selected>---</option>
                                    <option value="Telefono">Teléfono</option>
                                    <option value="Celular">Celular</option>
                                    <option value="Fax">Fax</option>
                                @elseif($user->tipo2 == 'Telefono')
                                    <option value="">---</option>
                                    <option value="Telefono" selected>Teléfono</option>
                                    <option value="Celular">Celular</option>
                                    <option value="Fax">Fax</option>
                                @elseif($user->tipo2 == 'Celular')
                                    <option value="">---</option>
                                    <option value="Telefono">Teléfono</option>
                                    <option value="Celular" selected>Celular</option>
                                    <option value="Fax">Fax</option>
                                @elseif($user->tipo2 == 'Fax')
                                    <option value="">---</option>
                                    <option value="Telefono">Teléfono</option>
                                    <option value="Celular">Celular</option>
                                    <option value="Fax" selected>Fax</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label for="telefono2" class="control-label">Teléfono Principal</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" name="telefono2" id="telefono2" value="@if(old('telefono2')){{ old('telefono2') }}@else{{ $user->telefono2 }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label for="ext2" class="control-label">Ext.</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ext2" id="ext2" value="@if(old('ext2')){{ old('ext2') }}@else{{ $user->ext2 }}@endif">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label for="tipo3" class="control-label">Tipo</label>
                            <select name="tipo3" id="tipo3" class="form-control" value="{{ old('tipo3') }}">
                                @if($user->tipo3 == null)
                                    <option value="" selected>---</option>
                                    <option value="Telefono">Teléfono</option>
                                    <option value="Celular">Celular</option>
                                    <option value="Fax">Fax</option>
                                @elseif($user->tipo3 == 'Telefono')
                                    <option value="">---</option>
                                    <option value="Telefono" selected>Teléfono</option>
                                    <option value="Celular">Celular</option>
                                    <option value="Fax">Fax</option>
                                @elseif($user->tipo3 == 'Celular')
                                    <option value="">---</option>
                                    <option value="Telefono">Teléfono</option>
                                    <option value="Celular" selected>Celular</option>
                                    <option value="Fax">Fax</option>
                                @elseif($user->tipo3 == 'Fax')
                                    <option value="">---</option>
                                    <option value="Telefono">Teléfono</option>
                                    <option value="Celular">Celular</option>
                                    <option value="Fax" selected>Fax</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <div class="form-group">
                                <label for="telefono3" class="control-label">Teléfono Principal</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" name="telefono3" id="telefono3" value="@if(old('telefono3')){{ old('telefono3') }}@else{{ $user->telefono3 }}@endif" data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label for="ext3" class="control-label">Ext.</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ext3" id="ext3" value="@if(old('ext3')){{ old('ext3') }}@else{{ $user->ext3 }}@endif">
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
                                <input type="email" class="form-control" placeholder="Correo..." name="email" id="email" value="@if(old('email')){{ old('email') }}@else{{ $user->email }}@endif">
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
                                <input type="email" class="form-control" placeholder="Correo..." name="email2" id="email2" value="@if(old('email2')){{ old('email2') }}@else{{ $user->email2 }}@endif">
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
                                <input type="email" class="form-control" placeholder="Correo..." name="email3" id="email3" value="@if(old('email3')){{ old('email3') }}@else{{ $user->email3 }}@endif">
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
                                <input type="text" class="form-control" placeholder="Usuario de acceso..." name="user" id="user" value="@if(old('user')){{ old('user') }}@else{{ $user->user }}@endif">
                            </div>
                            @if ($errors->has('user'))
                            <span class="help-block">
                            <strong>{{ $errors->first('user') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group {{ $errors->has('contra') ? ' has-error' : '' }}">
                            <label for="contra" class="control-label">Contraseña Actual</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control" placeholder="Contraseña..." name="contra" id="contra" value="@if(old('contra')){{ old('contra') }}@else{{ $user->contra }}@endif">
                            </div>
                            @if ($errors->has('contra'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contra') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Cambiar Contraseña</label>
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
                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                <button type="button" class="btn btn-gris" data-dismiss="modal">
                Cerrar <span class="glyphicon glyphicon-remove"></span>
                </button>
                <button type="submit" class="btn btn-azul">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
            </div>
            {{ Form::Close() }}
        </div>
    </div>
</div>