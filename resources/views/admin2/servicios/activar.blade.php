<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="activar-modal">
	<form action="">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #00b05b">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Activar Servicio</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea activar el servicio: <span id="span_activar"> </span> ?
					</h4>
					<input type="hidden" value="1" name="estatus_activar" id="estatus_activar">
					<input type="hidden" name="id_activar" id="id_activar">
				</div>
				<div class="modal-footer">
					
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="button" id="btn-activar" class="btn btn-success btn-flat">
						<span class="glyphicon glyphicon-eye-open"></span> Activar
					</button>
				</div>
			</div>
		</div>
	</form>
</div>