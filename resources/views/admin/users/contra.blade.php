<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-contra">
    <form>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1869B3;">
                    <h4 class="modal-title" style="color: white;">Modificar Contraseña</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true" style="color: white;"><b>&times;</b></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>
                        ¿Desea cambiar la contraseña para el usuario: <span id="usuario_password"></span> ?
                    </h4>
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 ">
                            <div class="form-group">
                                <label for="contra" class="control-label">Contraseña Actual</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" id="contra_actual" disabled style="background-color: white; color:#4d4d4d">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 ">
                            <div class="form-group">
                                <label for="password" class="control-label">Contraseña Nueva *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" class="form-control" placeholder="Contraseña..." name="password_nuevo" id="password_nuevo">
                                </div>
                                <span class="help-block">
                                    <strong id="password_nuevo_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-8 ">
                            <div class="form-group">
                                <label for="password_confirmation" class="control-label">Confirmar Contraseña *</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                    <input type="text" class="form-control" placeholder="Contraseña..." name="password_confirmation_nuevo" id="password_confirmation_nuevo">
                                </div>
                                <span class="help-block">
                                    <strong id="password_confirmation_nuevo_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_password">
                    <button type="button" class="btn btn-grey" data-dismiss="modal">
                    Cerrar <span class="fas fa-times"></span>
                    </button>
                    <button type="button" class="btn btn-primary" id="btn-guardar-contra">
                    <span class="fas fa-save"></span> Actualizar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>