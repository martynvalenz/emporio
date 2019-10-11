<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-{{ $user->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                </button>
                <h3 class="modal-title" style="color: white;">Usuario: {{ $user->iniciales }} - {{ $user->nombre }} {{ $user->apellido }}</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="{{ asset('images/users/'.$user->imagen) }}" alt="Imagen de {{ $user->iniciales }}" height="150px">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Creado</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" value="{{ $user->created_at->toDateString() }}" class="form-control" disabled style="background-color: white; color:black">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Última actualización</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" value="{{ $user->updated_at->toDateString() }}" class="form-control" disabled style="background-color: white; color:black">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="id_puesto" class="control-label">Puesto</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                                <input type="text" class="form-control" value="{{ $user->puestos->puesto }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre" class="control-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" value="{{ $user->nombre }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="apellido" class="control-label">Apellidos</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" value="{{ $user->apellido }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="iniciales" class="control-label">Iniciales</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                <input type="text" class="form-control" value="{{ $user->iniciales }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="usuario" class="control-label">Nombre corto</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                <input type="text" class="form-control" value="{{ $user->usuario }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="email" class="control-label">Correo</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs 12">
                        <div class="form-group">
                            <label for="contra" class="control-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="text" class="form-control" value="{{ $user->contra }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="rfc" class="control-label">RFC</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
                                <input type="text" class="form-control mayusculas" value="{{ $user->rfc }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="imss" class="control-label">IMSS</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <input type="text" class="form-control" value="{{ $user->imss }}">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2>Dirección</h2>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="calle" class="control-label">Calle</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                                <input type="text" class="form-control" value="{{ $user->calle }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="numero" class="control-label">Número</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i><b>#</b></i></span>
                                <input type="text" class="form-control" value="{{ $user->numero }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="numero_int" class="control-label">Número Interno</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i><b>#</b></i></span>
                                <input type="text" class="form-control" value="{{ $user->numero_int }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label for="cp" class="control-label">Código Postal</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i><b>CP</b></i></span>
                                <input type="text" class="form-control" value="{{ $user->cp }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="colonia" class="control-label">Colonia</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                <input type="text" class="form-control" value="{{ $user->colonia }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="localidad" class="control-label">Localidad</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                                <input type="text" class="form-control" value="{{ $user->localidad }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="municipio" class="control-label">Municipio</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-pin"></i></span>
                                <input type="text" class="form-control" value="{{ $user->municipio }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="id_estado" class="control-label">Estado</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                <input type="text" class="form-control" value="{{ $user->estados->estado }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="id_pais" class="control-label">País</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                                <input type="text" class="form-control" value="{{ $user->paises->pais }}">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="telefono" class="control-label">Teléfono</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" value="{{ $user->telefono }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="oficina" class="control-label">Teléfono de Oficina</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" value="{{ $user->oficina }}" data-inputmask='"mask": "(###) ###-#### ext. ####"' data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="celular" class="control-label">Celular</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" value="{{ $user->celular }}" data-inputmask='"mask": "(###) ###-####"' data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group has-feedback">
                        <div class="form-group">
                            <label for="estatus">Estatus</label>
                            <div class="checkbox">
                                <label>
                                {!! Form::checkbox('estatus', null, $user->estatus == 1 ? true : false, array('class'=> 'icheckbox_minimal-blue')) !!} Activo
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 form-group has-feedback">
                        <div class="form-group">
                            <label for="acepta_comision">Aplica Comisión</label>
                            <div class="checkbox">
                                <label>
                                {!! Form::checkbox('acepta_comision', null, $user->acepta_comision == 1 ? true : false, array('class'=> 'icheckbox_minimal-blue')) !!} Activo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="comentarios">Comentarios</label>
                        <p>{!! htmlspecialchars_decode($user->comentarios) !!}</p>
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
