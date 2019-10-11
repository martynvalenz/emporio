<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-comision-monto">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Editar Monto de comisión</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="color: black;"><b>&times;</b></span>
				</button>
				<input type="hidden" id="id_comision_monto" name="id_comision_monto">
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label >Monto</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fas fa-money-bill-alt"></i></span>
								<input type="number" step="any" class="form-control centered" id="monto_direccion">
							</div>
							<span class="help-block">
							    <strong id="monto_direccion_error" style="color:red"></strong>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a data-dismiss="modal" class="btn btn-grey">Cerrar <i class="fas fa-times"></i></a>
				<a class="btn btn-primary" id="btn-editar-monto-comision">Guardar <i class="fas fa-save"></i></a>
			</div>
		</div>
	</div>
</div>