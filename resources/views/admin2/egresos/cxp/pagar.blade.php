<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-pagar">
    <form>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #4EA75B">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
                    </button>
                    <h4 class="modal-title" style="color: white;">Pagar Egreso</h4>
                </div>
                <div class="modal-body">

                    <div class="row pull-right">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="created_at">Creado</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="text" id="created_at" class="form-control" data-tooltip="tooltip">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="updated_at">Último cambio</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="text" id="updated_at" class="form-control" data-tooltip="tooltip">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="tipo">Tipo de Egreso</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                    <input type="text" class="form-control" id="tipo_pagar">
                                </div>
                                <span class="help-block">
                                    <strong id="tipo_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="id_categoria">Categoría</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                    <input type="text" class="form-control" id="categoria_pagar">
                                </div>
                                <span class="help-block">
                                    <strong id="id_categoria_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="id_proveedor">Proveedor</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" id="proveedor_pagar">
                                </div>
                                <span class="help-block">
                                    <strong id="id_proveedor_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="id_cuenta">Cuenta <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-piggy-bank"></i></span>
                                    <select name="id_cuenta_pagar" id="id_cuenta_pagar" class="form-control">
                                        <option value="">-Seleccionar cuenta-</option>
                                        @foreach ($cuentas as $cuenta)
                                            <option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">
                                    <strong id="id_cuenta_pagar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="id_forma_pago">Forma de pago <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    <select name="id_forma_pago_pagar" id="id_forma_pago_pagar" class="form-control">
                                        <option value="">-Seleccionar forma de pago-</option>
                                        @foreach ($formas_pago as $forma)
                                            <option value="{{ $forma->id }}">{{ $forma->codigo }} - {{ $forma->forma_pago }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="help-block">
                                    <strong id="id_forma_pago_pagar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="fecha">Fecha de Egreso <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" name="fecha_pagar" id="fecha_pagar" class="form-control datepicker" autocomplete="off" style="text-align: center">
                                </div>
                                <span class="help-block">
                                    <strong id="fecha_pagar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label for="con_iva">con Factura?</label>
                                <select name="con_iva_pagar" id="con_iva_pagar" class="form-control">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Monto Total <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon" style="background-color:green; color:white"><i class="far fa-money-bill-alt"></i></span>
                                    <input type="number" step="any" id="total_pagar" name="total_pagar" class="form-control" style="text-align: center">
                                </div>
                                <span class="help-block">
                                    <strong id="total_pagar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label for="porcentaje_iva">Porcentaje IVA <b style="color:red">*</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i>%</i></span>
                                    <input type="text" name="porcentaje_iva_pagar" id="porcentaje_iva_pagar" class="form-control" style="text-align: center">
                                </div>
                                <span class="help-block">
                                    <strong id="porcentaje_iva_pagar_error" style="color:red"></strong>
                                </span>
                            </div>
                        </div>

                    </div>

                    <hr>
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="concepto">Descripción</label>
                                <textarea class="form-control has-feedback-left" name="concepto_pagar" id="concepto_pagar" rows="3" placeholder="Anote una descripción..."></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" id="estatus_pagar" value="Pagado">
                    <input type="hidden" id="pagado" value="1">
                    <input type="hidden" id="id_egreso_pagar">
                    <button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
                        Cerrar <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <a class="btn btn-success btn-flat" id="btn-pagar">
                        <span class="fas fa-money-bill-alt"></span> Pagar
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>