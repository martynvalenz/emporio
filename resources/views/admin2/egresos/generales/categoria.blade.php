<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar-categoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #008CC2">
                <button type="button" class="close btn-categoria-cerrar" aria-label="Cerrar">
                <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                </button>
                <h4 class="modal-title" style="color: white;">Agregar categoría de egresos</h4>

            </div>
            <form>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Categoía <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <input type="text" class="form-control" placeholder="Nombre de categoria..." name="categoria_agregar" id="categoria_agregar">

                            </div>
                            <span class="help-block">
                                <strong id="categoria_agregar_error" style="color:red"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Tipo de Egreso <b style="color:red">*</b></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                <select name="clasificacion" id="clasificacion" class="form-control">
                                    <option value="">-Sin selección-</option>
                                    <option value="Despacho">Despacho</option>
                                    <option value="Hogar">Hogar</option>
                                    <option value="Personal">Personal</option>
                                </select>
                            </div>
                            <span class="help-block">
                                <strong id="clasificacion_error" style="color:red"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="categoria" class="control-label">Descripción</label>
                            <textarea name="descripcion_categoria" id="descripcion_categoria" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="tipo_categoria">
                <button type="button" id="btn-guardar-categoria" class="btn btn-primary btn-flat">Guardar <i class="glyphicon glyphicon-floppy-disk"></i></button>
                <button type="button" class="btn btn-gris btn-flat btn-categoria-cerrar">
                Cerrar <span class="glyphicon glyphicon-remove"></span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>