<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-carpeta">
    <div class="modal-dialog">
        <form action="">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #218CBF">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                    </button>
                    <h4 class="modal-title" style="color: white;"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="carpeta" class="control-label">Carpeta</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-folder-open"></i></span>
                                    <input type="text" class="form-control" placeholder="URL de carpeta de Google Drive..." id="carpeta_agregar">
                                </div>
                                <span class="help-block">
                                    <strong id="carpeta_agregar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_cliente_carpeta">
                    <button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
                    Cerrar <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button class="btn btn-primary btn-flat" id="btn-carpeta-save">
                        <span class="fas fa-save"></span> Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>