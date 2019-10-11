<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-agregar-razon-recibo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-razon-social">
                <h4 class="modal-title" style="color: white;">Agregar Razón Social</h4>
                <button type="button" class="close cerrar-razon-recibo" aria-label="Cerrar">
                    <span aria-hidden="true" style="color: white;"><b>&times;</b></span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="razon_social" class="control-label">Razón Social <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control mayusculas" placeholder="Razon Social..." name="razon_social_recibo" id="razon_social_recibo" autocomplete="off">
                                </div>
                                <span class="help-block">
                                    <strong id="razon_social_recibo_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="rfc" class="control-label">RFC <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-qrcode"></i></span>
                                    <input type="text" class="form-control mayusculas" placeholder="RFC..." name="rfc_recibo" id="rfc_recibo" autocomplete="off">
                                </div>
                                <span class="help-block">
                                    <strong id="rfc_recibo_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-grey cerrar-razon-recibo">
                    Cerrar <i class="fas fa-times"></i>
                    </button>
                    <button type="button" id="btn-agregar-razon-recibo" class="btn btn-info">Agregar <i class="fas fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>