<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar_factura">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #008CC2;">
                <button type="button" class="close cerrar-factura" aria-label="Cerrar">
                    <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                </button>
                <h4 class="modal-title" style="color: white;">Agregar Folio</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Folio de Factura <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="far fa-file-pdf" aria-hidden="true"></i></span>
                                    <input type="text" style="text-align: center" class="form-control" placeholder="####" name="folio_factura_agregar" id="folio_factura_agregar" autocomplete="off">
                                </div>
                                <span class="help-block">
                                    <strong id="folio_factura_agregar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input name="_token_factura" value="{{ csrf_token() }}" type="hidden">
                    <input name="id_admin_factura_agregar" id="id_admin_factura_agregar" value="{{ Auth::user()->id }}" type="hidden">
                    <button type="button" class="btn btn-gris btn-flat cerrar-factura">
                    Cerrar
                    </button>
                    <button type="button" id="btn_agregar_factura" class="btn btn-primary btn-flat">Agregar <i class="glyphicon glyphicon-floppy-disk"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>