<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="cancelar-modal">
	<form>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #e30000">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Inactivar Servivio</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea inactivar el Servicio: <span id="span_cancelar"></span> ?
					</h4>
					<input type="hidden" value="0" name="estatus_cancelar" id="estatus_cancelar">
					<input type="hidden" name="id_cancelar" id="id_cancelar">
				</div>
				<div class="modal-footer">
					
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="button" id="btn-cancelar" class="btn btn-danger btn-flat">
						<span class="glyphicon glyphicon-eye-close"></span> Inactivar
					</button>
				</div>
			</div>
		</div>
	</form>
</div>