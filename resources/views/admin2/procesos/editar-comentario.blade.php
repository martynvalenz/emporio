<div class="modal fade modal-slide-in-right" aria-text="true" role="dialog" tabindex="-1" id="editar-comentarios-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="color: white; background-color: #ff9900">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-text="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h3 class="modal-title">Editar Comentario</h3>
			</div>
			<form action="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<img src="{{ asset('images/users/'.Auth::user()->imagen) }}" height="35" width="auto" alt="{{ Auth::user()->iniciales }}">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<textarea name="comentarios_text" id="comentarios_text" rows="3" class="form-control"></textarea>
						</div>
					</div>
					
				</div>

				<div class="modal-footer">
					<input name="id_admin_comentarios" id="id_admin_comentarios" value="{{ Auth::user()->id }}" type="hidden">
					<input name="id_servicio_comentarios" id="id_servicio_comentarios" type="hidden">
					<input name="id_control_comentarios" id="id_control_comentarios" type="hidden">
					<a class="btn btn-gris" data-dismiss="modal">Cancelar</a>
					<a id="btn-editar-comentario" class="btn btn-success btn-flat">Guardar <i class="fas fa-save"></i></a>
				</div>
			</form>
		</div>
	</div>
</div>