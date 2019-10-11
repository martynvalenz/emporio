<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-contactos">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: white;">Contactos de Registro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true" style="font-size: 35px; color: white;"><b>&times;</b></span>
                </button>
                
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="nombre_contacto" class="control-label">Nombre <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-user" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto">
                                </div>
                                <span class="help-block">
                                    <strong id="nombre_contacto_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="rfc" class="control-label">Puesto</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                    <input type="text" class="form-control" name="puesto_contacto" id="puesto_contacto">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="rfc" class="control-label">Título</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-project-diagram"></i>
                                    </span>
                                    <input type="text" class="form-control" name="titulo_contacto" id="titulo_contacto" placeholder="Licenciado, Contador, etc...">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="rfc" class="control-label">Área</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                    <input type="text" class="form-control" name="area_contacto" id="area_contacto" placeholder="Área en la empresa">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="telefono_contacto" class="control-label">Teléfono 1</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-phone" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control centered" name="telefono_contacto" id="telefono_contacto"  data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="telefono2_contacto" class="control-label">Teléfono 2</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-phone" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control centered" name="telefono2_contacto" id="telefono2_contacto"  data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="telefono3_contacto" class="control-label">Teléfono 3</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-phone" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control centered" name="telefono3_contacto" id="telefono3_contacto"  data-inputmask='"mask": "(###) ###-####"' data-mask>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="email_contacto" class="control-label">email 1</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-envelope" aria-hidden="true"></i>
                                    </span>
                                    <input type="email" class="form-control minusculas" name="email_contacto" id="email_contacto">
                                </div>
                                <span class="help-block">
                                    <strong id="email_contacto_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="email2_contacto" class="control-label">email 2</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-envelope" aria-hidden="true"></i>
                                    </span>
                                    <input type="email" class="form-control minusculas" name="email2_contacto" id="email2_contacto">
                                </div>
                                <span class="help-block">
                                    <strong id="email2_contacto_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="" class="control-label">Comentarios</label>
                                <div class="input-group">
                                    <textarea class="form-control" name="comentarios_contacto" id="comentarios_contacto"rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a id="btn-guardar-contacto" class="btn btn-primary btn-flat" title="Guardar razón social" data-tooltip="tooltip"><i class="fas fa-save"></i> Guardar</a>
                            <a id="btn-cancelar-contacto" class="btn btn-grey btn-flat"><i class="fas fa-eraser"></i> Borrar</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="listado-contactos"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_cliente_contacto">
                    <input type="hidden" id="id_contacto">
                    <button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
                    Cerrar <span class="fas fa-times"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>