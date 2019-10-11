<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-cargar-logo">
	<form action="">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="logo-header"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="">Cargar Logo</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-image"></i></span>
									<input type="file" id="logo_url" class="form-control">
								</div>
								<span class="help-block">
								    <strong id="logo_url_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_servicio_logo_modal">
					<button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>