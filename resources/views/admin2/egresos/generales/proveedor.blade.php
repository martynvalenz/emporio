<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-proveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #008CC2">
                <button type="button" class="close btn-proveedor-cerrar" aria-label="Cerrar">
                <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                </button>
                <h4 class="modal-title" style="color: white;">Agregar categoría de egresos</h4>

            </div>
            <form>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="categoria" class="control-label">Proveedor <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <input type="text" class="form-control" placeholder="Nombre comercial..." name="nombre_comercial" id="nombre_comercial">

                            </div>
                            <span class="help-block">
                                <strong id="nombre_comercial_error" style="color:red"></strong>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-guardar-proveedor" class="btn btn-primary btn-flat">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
                <button type="button" class="btn btn-gris btn-flat btn-proveedor-cerrar">
                Cerrar <span class="glyphicon glyphicon-remove"></span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>