<div class="modal fade modal-slide-in-right" aria-text="true" role="dialog" tabindex="-1" id="servicio-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" id="encabezado">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-text="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;" id="encabezado-servicio"></h4>
			</div>
			<form action="">
				<div class="modal-body">
					<div class="row">
					    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
					        <div class="form-group">
					            <label for="clave" class="control-label">Clave <b style="color:red">*</b></label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
					                <input type="text" class="form-control mayusculas" name="clave" id="clave">
					            </div>
					            <span class="help-block">
					                <strong id="clave_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
					        <div class="form-group">
					            <label for="servicio" class="control-label">Servicio <b style="color:red">*</b></label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-suitcase"></i></span>
					                <input type="text" class="form-control" name="servicio" id="servicio">
					            </div>
					            <span class="help-block">
								    <strong id="servicio_error" style="color:red"></strong>
								</span>
					        </div>
					    </div>
					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					        <label for="comentarios">Comentarios</label>
					        <textarea name="comentarios" id="comentarios" rows="3" class="form-control"></textarea>
					    </div>
					</div>
					<hr>
					<div class="row">
					    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="id_categoria_servicios" class="control-label">Categoría <b style="color:red">*</b></label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
					                <select name="id_categoria_servicios" id="id_categoria_servicios" class="form-control">
					                    <option value="">-</option>
					                    @foreach ($categoria_servicios as $servicio)
					                    	<option value="{{ $servicio->id }}">{{ $servicio->categoria }}</option>
					                    @endforeach
					                </select>
					            </div>
					            <span class="help-block">
					                <strong id="id_categoria_servicios_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="id_categoria_bitacora" class="control-label">Bitácora de Servicios <b style="color:red">*</b></label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
					                <select name="id_categoria_bitacora" id="id_categoria_bitacora" class="form-control">
					                    <option value="">-</option>
					                    @foreach ($categoria_bitacoras as $bitacora)
					                    	<option value="{{ $bitacora->id }}">{{ $bitacora->bitacora }} - {{ $bitacora->clave }}</option>
					                    @endforeach
					                </select>
					            </div>
					            <span class="help-block">
					                <strong id="id_categoria_bitacora_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					        <div class="form-group">
					            <label for="id_categoria_estatus" class="control-label">Bitácora de Estatus</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
					                <select name="id_categoria_estatus" id="id_categoria_estatus" class="form-control">
					                    <option value="">-</option>
					                    @foreach ($categoria_estatus as $estatus)
					                    	<option value="{{ $estatus->id }}">{{ $estatus->bitacora }} - {{ $estatus->clave }}</option>
					                    @endforeach
					                </select>
					            </div>
					            <span class="help-block">
					                <strong id="id_categoria_estatus_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					</div>
					<hr>
					<div class="row">
					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					        <h2>Costos</h2>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					        <div class="form-group">
					            <label for="concepto" class="control-label">Concepto de Costo <b style="color:red">*</b></label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
					                <select name="concepto" id="concepto" class="form-control">
					                    <option value="Neto">Neto</option>
					                    <option value="Porcentaje">Porcentaje</option>
					                    <option value="por Proyecto">por Proyecto</option>
					                </select>
					            </div>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					        <div class="form-group">
					            <label for="moneda" class="control-label">Moneda <b style="color:red">*</b></label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
					                <select name="moneda" id="moneda" class="form-control">
					                    @foreach ($monedas as $moneda)
					                    	<option value="{{ $moneda->clave }}">{{ $moneda->clave }} - {{ $moneda->moneda }}</option>
					                    @endforeach
					                </select>
					            </div>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					        <div class="form-group">
					            <label for="costo_servicio" class="control-label">Costo Emporio <b style="color:red">*</b></label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
					                <input type="number" step="any" style="text-align: center" class="form-control" name="costo_servicio" id="costo_servicio" min="0">
					            </div>
					            <span class="help-block">
					                <strong id="costo_servicio_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					        <div class="form-group">
					            <label class="control-label">Precio <b style="color:red">*</b></label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
					                <input type="number" step="any" style="text-align: center" class="form-control" name="costo" id="costo" min="0">
					            </div>
					            <span class="help-block">
					                <strong id="costo_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					</div>
					<hr>
					<div class="row">
					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					        <h2>Comisiones</h2>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					        <div class="form-group">
					            <label for="comision_venta" class="control-label">Comisión de Venta</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
					                <select name="comision_venta" id="comision_venta" class="form-control">
					                    <option value="">-</option>
					                    <option value="Monto Fijo">Monto Fijo</option>
					                    <option value="Porcentaje">Porcentaje</option>
					                    <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
					                </select>
					            </div>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					        <div class="form-group">
					            <label for="comision_venta_monto" class="control-label">Monto por venta</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i id="span_venta"></i></span>
					                <input type="number" step="any" style="text-align: center" class="form-control" name="comision_venta_monto" id="comision_venta_monto" min="0">
					            </div>
					            <span class="help-block">
					                <strong id="comision_venta_monto_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					        <div class="form-group">
					            <label for="comision_operativa" class="control-label">Comisión Operativa</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
					                <select name="comision_operativa" id="comision_operativa" class="form-control">
					                    <option value="">-</option>
					                    <option value="Monto Fijo">Monto Fijo</option>
					                    <option value="Porcentaje">Porcentaje</option>
					                    <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
					                </select>
					            </div>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					        <div class="form-group">
					            <label for="comision_operativa_monto" class="control-label">Monto operativo</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i id="span_operativo"></i></span>
					                <input type="number" step="any" style="text-align: center" class="form-control" name="comision_operativa_monto" id="comision_operativa_monto" min="0">
					            </div>
					            <span class="help-block">
					                <strong id="comision_operativa_monto_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					        <div class="form-group">
					            <label for="comision_gestion" class="control-label">Comisión por Gestión</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
					                <select name="comision_gestion" id="comision_gestion" class="form-control">
					                    <option value="">-</option>
					                    <option value="Monto Fijo">Monto Fijo</option>
					                    <option value="Porcentaje">Porcentaje</option>
					                    <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
					                </select>
					            </div>
					        </div>
					    </div>
					    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					        <div class="form-group">
					            <label for="comision_gestion_monto" class="control-label">Monto Gestión</label>
					            <div class="input-group">
					                <span class="input-group-addon"><i id="span_gestion"></i></span>
					                <input type="number" step="any" style="text-align: center" class="form-control" name="comision_gestion_monto" id="comision_gestion_monto" min="0">
					            </div>
					            <span class="help-block">
					                <strong id="comision_gestion_monto_error" style="color:red"></strong>
					            </span>
					        </div>
					    </div>
					</div>
					
					<div class="row">
					    <div class="col-3 col-md-3 col-sm-4 col-xs-12">
							<div class="form-group">
								<label for="estatus" class="container">Estatus
									<input type="checkbox" name="estatus" id="estatus">
									<span class="checkmark"></span>
								</label>
							</div>
							<input type="hidden" name="estatus_check" id="estatus_check">
						</div>
					</div>
					<hr>
					<div class="row">
					    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					        <label for="procedimiento">Procedimiento</label>
					        <textarea name="procedimiento" id="editor1" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					    </div>
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="id_servicio" id="id_servicio">
					<input type="hidden" id="accion">
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="button" id="btn-guardar" class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-disk"> </span> Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>