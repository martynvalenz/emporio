<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-ingreso">
    <form>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: white;"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true" style="font-size: 35px; color: white;"><b>&times;</b></span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" id="id_cliente_ingreso_select">
                            <div class="form-group">
                                <label for="id_cliente_ingreso" class="control-label">Cliente</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
                                    <select class="form-control default-select2" name="id_cliente_ingreso" id="id_cliente_ingreso" data-live-search="true" data-style="btn-primary"> 
                                    </select>
                                    <input type="hidden" id="id_cliente_ingreso_val">
                                    <input type="hidden" id="id_cliente_ingreso_ant">
                                </div>
                                <span class="help-block">
                                    <strong id="id_cliente_ingreso_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12" hidden id="id_cliente_ingreso_div">
                            <div class="form-group">
                                <label for="id_cliente" class="control-label">Cliente</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-trophy"></i></span>
                                    <input type="text" id="id_cliente_ingreso_text" class="form-control">
                                </div>
                            </div>                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="fecha_ingreso" class="control-label">Fecha <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="fecha_ingreso" name="fecha_ingreso" class="form-control datepicker-autoClose centered" autocomplete="off" style="text-align: center">
                                </div>
                                <span class="help-block">
                                    <strong id="fecha_ingreso_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="tipo_ingreso" class="control-label">Tipo de Ingreso <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                    <select name="" id="tipo_ingreso" class="form-control">
                                        <option value="Ingreso">Cliente</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Inversión">Inversión</option>
                                    </select>
                                </div>
                            </div>                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="id_cuenta_ingreso" class="control-label">Cuenta <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
                                    <select name="id_cuenta_ingreso" id="id_cuenta_ingreso" class="form-control">
                                        <option value="">-Sin selección-</option>
                                        @foreach($cuentas as $cuenta)
                                            <option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">
                                    <strong id="id_cuenta_ingreso_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="id_forma_pago_ingreso" class="control-label">Forma de pago <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-credit-card"></i></span>
                                    <select name="id_forma_pago_ingreso" id="id_forma_pago_ingreso" class="form-control">
                                        <option value="">-Sin selección-</option>
                                        @foreach($formas_pago as $forma_pago)
                                            <option value="{{ $forma_pago->id }}">{{ $forma_pago->forma_pago }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">
                                    <strong id="id_forma_pago_ingreso_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="monto_ingreso" class="control-label">Monto <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon" style="background-image: linear-gradient(to right, #7FC0BF, #54C8DF , #49B9E9);"><i class="fas fa-money-bill-alt" style="color: white"></i></span>
                                    <input type="number" step="any" id="monto_ingreso" name="monto_ingreso" class="form-control centered" min="0">
                                    <input type="hidden" id="monto_ingreso_ant">
                                </div>
                                <span class="help-block">
                                    <strong id="monto_ingreso_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="saldo_ingreso" class="control-label">Saldo del Cliente</label>
                                <div class="input-group">
                                    <span class="input-group-addon" class="btn btn-warning"><i class="fas fa-money-bill-alt"></i></span>
                                    <input type="number" step="any" id="saldo_ingreso" name="saldo_ingreso" class="form-control centered" disabled style="background-color: white; color: black">
                                    <input type="hidden" id="saldo_ingreso_val">
                                    <input type="hidden" id="saldo_ingreso_ant">
                                </div>
                                <span class="help-block">
                                    <strong id="saldo_ingreso_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>
                        <!--<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="pagado_ingreso" class="control-label">Monto Pagado</label>
                                <div class="input-group">
                                    <span class="input-group-addon" class="btn btn-warning"><i class="fas fa-money-bill-alt"></i></span>
                                    <input type="number" step="any" id="pagado_ingreso" name="pagado_ingreso" class="form-control centered" disabled style="background-color: white; color: black">
                                    <input type="hidden" id="pagado_ingreso_val">
                                </div>
                                <span class="help-block">
                                    <strong id="pagado_ingreso_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>-->
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="movimiento_ingreso" class="control-label"># Movimiento</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-hashtag"></i></span>
                                    <input type="text" id="movimiento_ingreso" class="form-control centered">
                                </div>
                                <span class="help-block">
                                    <strong id="movimiento_ingreso_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="form-group">
                                <label for="cheque_ingreso" class="control-label">Cheque</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-hashtag"></i></span>
                                    <input type="text" id="cheque_ingreso" class="form-control centered">
                                </div>
                                <span class="help-block">
                                    <strong id="cheque_ingreso_error" style="color:red"></strong>
                                </span>
                            </div>                
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Comentarios</label>
                            <textarea name="comentarios_ingreso" id="comentarios_ingreso" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_ingreso">
                    <input type="hidden" id="accion_ingreso">
                    <input type="hidden" id="estatus_ingreso">
                    <input type="hidden" id="orden_ingreso">
                    <input type="hidden" id="porcentaje_iva_ingreso" value="{{ $porcentaje_iva->porcentaje_iva }}">
                    <button class="btn btn-grey" data-dismiss="modal">Cerrar <i class="fas fa-times"></i></button>   
                    <a class="btn btn-primary" id="btn-save-ingreso"></a> 
                </div>
            </div>
        </div>
    </form>
</div>