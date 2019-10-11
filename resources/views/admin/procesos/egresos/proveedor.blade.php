<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-agregar-proveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="header-proveedor">
                <h4 class="modal-title" id="proveedor-title" style="color: white;"></h4>
                <button type="button" class="close cerrar-proveedor" aria-label="Cerrar">
                    <span aria-hidden="true" style="color: white;"><b>&times;</b></span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="razon_social" class="control-label">Nombre comercial <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control mayusculas" placeholder="Nombre comercial del proveedor..." name="nombre_proveedor" id="nombre_proveedor" autocomplete="off">
                                </div>
                                <span class="help-block">
                                    <strong id="nombre_proveedor_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="checkbox checkbox-css">
                                    <input type="checkbox" class="realiza_pagos_check" id="realiza_pagos_check" onclick="" unchecked />
                                    <label for="realiza_pagos_check">Recibe pagos de servicios?</label>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="realiza_pagos_check_val" value="0">
                    <button type="button" class="btn btn-grey cerrar-proveedor">
                    Cerrar <i class="fas fa-times"></i>
                    </button>
                    <button type="button" id="btn-agregar-proveedor" class="btn btn-info">Agregar <i class="fas fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>