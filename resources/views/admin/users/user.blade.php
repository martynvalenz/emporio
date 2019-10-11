<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-user">
    <form>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1869B3;">
                    <h4 class="modal-title" style="color: white;"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true" style="color: white;"><b>&times;</b></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="">Puesto <b style="color: red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-user-shield"></i></span>
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="">-Sin selección-</option>
                                        @foreach ($puestos as $puesto)
                                            <option value="{{ $puesto->id }}">{{ $puesto->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">
                                    <strong id="role_id_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="">Área <b style="color: red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-address-card"></i></span>
                                    <select name="area" id="area" class="form-control">
                                        <option value="">-Sin selección-</option>
                                        <option value="Juridico">Jurudico</option>
                                        <option value="Administracion">Administración</option>
                                        <option value="Gestion">Gestión</option>
                                        <option value="Direccion">Dirección</option>
                                        <option value="Operaciones">Operaciones</option>
                                    </select>
                                </div>
                                <span class="help-block">
                                    <strong id="area_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="">Iniciales <b style="color: red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-audio-description"></i></span>
                                    <input type="text" name="iniciales" id="iniciales" class="form-control centered mayusculas">
                                </div>
                                <span class="help-block">
                                    <strong id="iniciales_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Nombre <b style="color: red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                </div>
                                <span class="help-block">
                                    <strong id="nombre_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Apellido <b style="color: red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                    <input type="text" name="apellido" id="apellido" class="form-control">
                                </div>
                                <span class="help-block">
                                    <strong id="apellido_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Nombre de usuario</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-user-circle"></i></span>
                                    <input type="text" name="usuario" id="usuario" class="form-control">
                                </div>
                                <span class="help-block">
                                    <strong id="usuario_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-key"></i></span>
                                    <input type="text" name="password" id="password" class="form-control">
                                </div>
                                <span class="help-block">
                                    <strong id="password_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Correo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                                <span class="help-block">
                                    <strong id="email_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Teléfono</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="telefono" id="telefono" class="form-control centered" data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                                <span class="help-block">
                                    <strong id="telefono_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Celular</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-mobile-alt"></i></span>
                                    <input type="text" name="celular" id="celular" class="form-control centered" data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                                <span class="help-block">
                                    <strong id="celular_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Oficina</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
                                    <input type="text" name="oficina" id="oficina" class="form-control centered" data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                                <span class="help-block">
                                    <strong id="oficina_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <div class="checkbox checkbox-css">
                                    <input type="checkbox" id="estatus" />
                                    <label for="estatus">Activo</label>
                                </div>
                            </div>
                            <input type="hidden" name="estatus" id="estatus_check">
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <div class="checkbox checkbox-css">
                                    <input type="checkbox" id="acepta_comision" />
                                    <label for="acepta_comision">Comisiona?</label>
                                </div>
                            </div>
                            <input type="hidden" name="acepta_comision" id="acepta_comision_check">
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <div class="checkbox checkbox-css">
                                    <input type="checkbox" id="responsabilidad" />
                                    <label for="responsabilidad">Responsable en bitácoras?</label>
                                </div>
                            </div>
                            <input type="hidden" name="responsabilidad" id="responsabilidad_check">
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <div class="checkbox checkbox-css">
                                    <input type="checkbox" id="nomina" />
                                    <label for="nomina">Nómina?</label>
                                </div>
                            </div>
                            <input type="hidden" name="nomina" id="nomina_check">
                        </div>
                    </div>
                    <div class="row" id="sueldo_quincenal_boolean">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Sueldo Quincenal <b style="color: red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-money-bill-alt"></i></span>
                                    <input type="number" step="any" name="sueldo_quincenal" id="sueldo_quincenal" class="form-control centered">
                                </div>
                                <span class="help-block">
                                    <strong id="sueldo_quincenal_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_usuario">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">
                    Cerrar <span class="fas fa-times"></span>
                    </button>
                    <button type="button" class="btn btn-primary" id="btn-save-user">
                    <span class="fas fa-save"></span> Guardar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>