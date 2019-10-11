<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-marcas">
    <div class="modal-dialog modal-lg">
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
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="marca" class="control-label">Marca, nombre comercial, slogan, etc <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-copyright" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control mayusculas" placeholder="Marca..." name="marca" id="marca">
                                    <input type="hidden" id="id_razon_social">
                                </div>
                                <span class="help-block">
                                    <strong id="marca_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a id="btn-guardar-marca" class="btn btn-primary btn-flat" title="Guardar marca" data-tooltip="tooltip"><i class="fas fa-save"></i> Guardar</a>
                            <a id="btn-cancelar-marca" class="btn btn-gris btn-flat"><i class="fas fa-times"></i> Cancelar</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="listado-marcas"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_cliente_marca">
                    <button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
                    Cerrar <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>