<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-razones">
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
                                <label for="razon_social_razon" class="control-label">Razón Social <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-university" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" class="form-control mayusculas" placeholder="Razon Social..." name="razon_social_razon" id="razon_social_razon">
                                    <input type="hidden" id="id_razon_social">
                                </div>
                                <span class="help-block">
                                    <strong id="razon_social_razon_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="rfc" class="control-label">RFC <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-qrcode"></i>
                                    </span>
                                    <input type="text" class="form-control mayusculas" placeholder="RFC..." name="rfc_razon" id="rfc_razon">
                                </div>
                                <span class="help-block">
                                    <strong id="rfc_razon_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a id="btn-guardar-razon" class="btn btn-primary btn-flat" title="Guardar razón social" data-tooltip="tooltip"><i class="fas fa-save"></i> Guardar</a>
                            <a id="btn-cancelar-razon" class="btn btn-gris btn-flat"><i class="fas fa-times"></i> Cancelar</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="listado-razones"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_cliente_razon">
                    <button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
                    Cerrar <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>