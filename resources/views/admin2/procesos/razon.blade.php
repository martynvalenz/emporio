<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar_razon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #009051;">
                <button type="button" class="close cerrar-razon" aria-label="Cerrar">
                    <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                </button>
                <h4 class="modal-title" style="color: white;">Agregar Razón Social</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="razon_social" class="control-label">Razón Social <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control mayusculas" placeholder="Razon Social..." name="razon_social_razon" id="razon_social_razon" autocomplete="off">
                                </div>
                                <span class="help-block">
                                    <strong id="razon_social_razon_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="rfc" class="control-label">RFC <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-qrcode"></i></span>
                                    <input type="text" class="form-control mayusculas" placeholder="RFC..." name="rfc_razon" id="rfc_razon" autocomplete="off">
                                </div>
                                <span class="help-block">
                                    <strong id="rfc_razon_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input name="_token_razon" value="{{ csrf_token() }}" type="hidden">
                    <input name="id_admin_razon" id="id_admin_razon" value="{{ Auth::user()->id }}" type="hidden">
                    <button type="button" id="btn_razon" class="btn btn-success btn-flat">Agregar <i class="glyphicon glyphicon-floppy-disk"></i></button>
                    <button type="button" class="btn btn-gris btn-flat cerrar-razon">
                    Cerrar
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
</div>