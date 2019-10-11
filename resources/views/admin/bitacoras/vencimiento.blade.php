<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-vencimiento">
	<form action="">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="">Recepción</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="far fa-calendar-check"></i></span>
									<input type="text" id="fecha_recepcion_vencimiento" class="form-control datepicker-autoClose centered" disabled>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="">Fecha de Vencimiento</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-calendar-times"></i></span>
									<input type="text" id="fecha_vencimiento_vencimiento" class="form-control datepicker-autoClose centered">
									<input type="hidden" id="created_at_vencimiento">
								</div>
								<span class="help-block">
								    <strong id="fecha_vencimiento_vencimiento_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_servicio_vencimiento">
					<button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<a id="btn-guardar-vencimiento" class="btn btn-primary">Guardar <i class="fas fa-save"></i></a>
				</div>
			</div>
		</div>
	</form>
</div>