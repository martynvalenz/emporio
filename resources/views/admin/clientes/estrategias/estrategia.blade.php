<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-estrategia">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true" style="font-size: 35px; color: white;"><b>&times;</b></span>
                </button>
                <h4 class="modal-title" style="color: white;"></h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="form-group">
                                <label for="estrategia" class="control-label">Estrategia</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-chart-line"></i></span>
                                    <input type="text" class="form-control" placeholder="Nombre  estrategia..." name="estrategia" id="estrategia">
                                </div>
                                <span class="help-block">
                                    <strong id="estrategia_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label for="estatus">Estatus</label>
                                <select class="form-control" name="estatus" id="estatus">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_estrategia">
                    <button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
                    Cerrar <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button id="btn-save">Guardar <i class="fas fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>