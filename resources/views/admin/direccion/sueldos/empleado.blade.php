<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-empleado">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #49B6D6;">
				<h4 class="modal-title" style="color: white;"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true"><b>&times;</b></span>
				</button>
			</div>
			<form>
				<div class="modal-body">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12" hidden>
							<div class="form-group">
								<label>Sueldo Diario</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-money-bill-alt"></i></span>
									<input type="number" step="any" name="sueldo_diario" id="sueldo_diario" class="form-control centered">
								</div>
								<span class="help-block">
								    <strong id="sueldo_diario_error" style="color:red"></strong>
								</span>
							</div>
							<br>
						</div>

						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Sueldo Quincenal</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-hand-holding-usd"></i></span>
									<input type="number" step="any" name="sueldo_quincenal" id="sueldo_quincenal" class="form-control centered">
								</div>
								<span class="help-block">
								    <strong id="sueldo_quincenal_error" style="color:red"></strong>
								</span>
							</div>
							<br>
						</div>
						
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" id="id_empleado">
					<input type="hidden" id="name_empleado">
					<button type="button" class="btn btn-grey" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<button type="button" class="btn btn-primary" id="btn-guardar-empleado"><span class="fas fa-save"> </span> Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>