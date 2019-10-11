<div class="modal fade" id="detalles-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<br>
				<div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				        <label for="comentarios">Comentarios</label>
				        <p id="det_comentarios"></p>
				    </div>
				</div>
				<hr>
				<div class="row">
				    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				        <div class="form-group">
				            <label for="id_puesto" class="control-label">Categoría</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
				                <select id="det_categoria" class="form-control">
				                    <option value="">-</option>
				                    @foreach ($categoria_servicios as $servicio)
				                        <option value="{{ $servicio->id }}">{{ $servicio->categoria }}</option>
				                    @endforeach
				                </select>
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				        <div class="form-group">
				            <label for="id_puesto" class="control-label">Bitácora</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
				                <select id="det_bitacora" class="form-control">
				                    <option value="">-</option>
				                    @foreach ($categoria_bitacoras as $bitacora)
				                        <option value="{{ $bitacora->id }}">{{ $bitacora->bitacora }} - {{ $bitacora->clave }}</option>
				                    @endforeach
				                </select>
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				        <div class="form-group">
				            <label for="id_puesto" class="control-label">Estatus</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
				                <select id="det_bit_estatus" class="form-control">
				                    <option value="">-</option>
				                    @foreach ($categoria_estatus as $estatus)
				                        <option value="{{ $estatus->id }}">{{ $estatus->bitacora }} - {{ $estatus->clave }}</option>
				                    @endforeach
				                </select>
				            </div>
				        </div>
				    </div>
				</div>
				<hr>
				<div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				        <h4>Costos</h4>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				        <div class="form-group">
				            <label for="concepto" class="control-label">Concepto de Costo</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
				                <select id="det_concepto" class="form-control">
				                    <option value="Neto">Neto</option>
				                    <option value="Porcentaje">Porcentaje</option>
				                    <option value="por Proyecto">por Proyecto</option>
				                </select>
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				        <div class="form-group">
				            <label for="concepto" class="control-label">Moneda</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
				                <select id="det_moneda" class="form-control">
				                    @foreach ($monedas as $moneda)
				                        <option value="{{ $moneda->clave }}">{{ $moneda->clave }} - {{ $moneda->moneda }}</option>
				                    @endforeach
				                </select>
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				        <div class="form-group">
				            <label for="costo_servicio" class="control-label">Costo Emporio</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
				                <input type="number" step="any" style="text-align: center" class="form-control" id="det_costo_servicio">
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				        <div class="form-group">
				            <label for="costo" class="control-label">Precio</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="far fa-money-bill-alt"></i></span>
				                <input type="number" step="any" style="text-align: center" class="form-control" id="det_costo">
				            </div>
				        </div>
				    </div>

				</div>
				<hr>
				<div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				        <h4>Comisiones</h4>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
				        <div class="form-group">
				            <label for="comision_venta" class="control-label">Comisión de Venta</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
				                <select id="det_comision_venta" class="form-control">
				                    <option value="">-</option>
				                    <option value="Monto Fijo">Monto Fijo</option>
				                    <option value="Porcentaje">Porcentaje</option>
				                    <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
				                </select>
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
				        <div class="form-group">
				            <label for="comision_venta_monto" class="control-label">Monto por venta</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i id="det_span_venta"></i></span>
				                <input type="number" step="any" style="text-align: center" class="form-control" id="det_comision_venta_monto">
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
				        <div class="form-group">
				            <label for="comision_operativa" class="control-label">Comisión Operativa</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
				                <select id="det_comision_operativa" class="form-control">
				                    <option value="">-</option>
				                    <option value="Monto Fijo">Monto Fijo</option>
				                    <option value="Porcentaje">Porcentaje</option>
				                    <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
				                </select>
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
				        <div class="form-group">
				            <label for="comision_operativa_monto" class="control-label">Monto operativo</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i id="det_span_operativo"></i></span>
				                <input type="number" step="any" style="text-align: center" class="form-control" id="det_comision_operativa_monto">
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
				        <div class="form-group">
				            <label for="comision_gestion" class="control-label">Comisión por Gestión</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fas fa-exclamation-circle"></i></span>
				                <select id="det_comision_gestion" class="form-control">
				                    <option value="">-</option>
				                    <option value="Monto Fijo">Monto Fijo</option>
				                    <option value="Porcentaje">Porcentaje</option>
				                    <option value="Porcentaje Utilidad">Porcentaje Utilidad</option>
				                </select>
				            </div>
				        </div>
				    </div>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
				        <div class="form-group">
				            <label for="comision_gestion_monto" class="control-label">Monto Gestión</label>
				            <div class="input-group">
				                <span class="input-group-addon"><i id="det_span_gestion"></i></span>
				                <input type="number" step="any" style="text-align: center" class="form-control" id="det_comision_gestion_monto">
				            </div>
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<a class="btn btn-grey" data-dismiss="modal">Cerrar <i class="fas fa-times"></i></a>
			</div>
		</div>
	</div>
</div>