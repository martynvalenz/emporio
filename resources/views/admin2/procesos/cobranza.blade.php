<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar_cobranza">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #008CC2;">
                <button type="button" class="close cerrar-cobranza" aria-label="Cerrar">
                    <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                </button>
                <h4 class="modal-title" style="color: white;">Agregar Cobro</h4>
            </div>
            <form>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label for="fecha" class="control-label">Fecha <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="fecha_cobranza_agregar" name="fecha_cobranza_agregar" class="form-control datepicker" autocomplete="off" style="text-align: center">
                                </div>
                                <span class="help-block">
                                    <strong id="fecha_cobranza_agregar_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Cuenta <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
                                    <select name="cuenta_cobranza_agregar" id="cuenta_cobranza_agregar" class="form-control">
                                        <option value=""> - </option>
                                        @foreach($cuentas as $cuenta)
                                            <option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">
                                    <strong id="cuenta_cobranza_agregar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Forma de Pago <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    <select name="forma_pago_cobranza_agregar" id="forma_pago_cobranza_agregar" class="form-control">
                                        <option value=""> - </option>
                                        @foreach($formas_pago as $forma_pago)
                                            <option value="{{ $forma_pago->id }}">{{ $forma_pago->forma_pago }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">
                                    <strong id="forma_pago_cobranza_agregar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label>Monto Total <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
                                    <input type="number" step="any" id="monto_cobranza_agregar" name="monto_cobranza_agregar" class="form-control" style="text-align: center">
                                </div>
                                <span class="help-block">
                                    <strong id="monto_cobranza_agregar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label>Folio de Cheque</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sticky-note"></i></span>
                                    <input type="text" name="cheque_agregar" id="cheque_agregar" class="form-control" style="text-align: center">
                                </div>
                                <span class="help-block">
                                    <strong id="cheque_agregar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label>Movimiento Bancario</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i>#</i></span>
                                    <input type="text" name="movimiento_agregar" id="movimiento_agregar" class="form-control" style="text-align: center">
                                </div>
                                <span class="help-block">
                                    <strong id="movimiento_agregar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Comentarios</label>
                            <textarea name="comentarios_cobranza_agregar" id="comentarios_cobranza_agregar" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input name="_token_cobranza_agregar" value="{{ csrf_token() }}" type="hidden">
                    <input name="id_admin_cobranza_agregar" id="id_admin_cobranza_agregar" value="{{ Auth::user()->id }}" type="hidden">
                    <input type="hidden" value="{{ $porcentaje_iva->porcentaje_iva }}" name="porcentaje_iva_cobranza_agregar" id="porcentaje_iva_cobranza_agregar">
                    <button type="button" class="btn btn-gris btn-flat cerrar-cobranza">
                    Cerrar
                    </button>
                    <button type="button" id="btn_agregar_cobranza_nueva" class="btn btn-primary btn-flat">Agregar <i class="glyphicon glyphicon-floppy-disk"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>