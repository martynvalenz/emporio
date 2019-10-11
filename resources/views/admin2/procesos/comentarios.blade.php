<div class="modal fade modal-slide-in-right" aria-text="true" role="dialog" tabindex="-1" id="comentarios-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="color: white; background-color: #008CC2">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-text="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" id="title-comentarios"></h4>
			</div>
			<form action="">
				<div class="modal-body">
					<div id="comentarios_vista"></div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<img src="{{ asset('images/users/'.Auth::user()->imagen) }}" style="border-radius: 50%;width: 35px; height: 35px;" alt="{{ Auth::user()->iniciales }}">
							<span>{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<textarea name="comentarios_text" id="comentarios_text" rows="3" class="form-control"></textarea>
							<br>
							<a id="btn-agregar-comentario" class="btn btn-primary btn-flat">Agregar <i class="fas fa-save"></i></a>
						</div>
					</div>
					
				</div>
				@include('admin.procesos.editar-comentario')
				

				<div class="modal-footer">
					<input name="_token_comentarios" value="{{ csrf_token() }}" type="hidden">
					<input name="id_admin_comentarios" id="id_admin_comentarios" value="{{ Auth::user()->id }}" type="hidden">
					<input name="id_servicio_comentarios" id="id_servicio_comentarios" type="hidden">
					<input name="id_estatus_comentarios" id="id_estatus_comentarios" type="hidden">
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>