<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-cancelar">
	<form>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #e30000;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Cancelar Servicio</h4>
				</div>
				<div class="modal-body">
					<h3>
						¿Desea cancelar el servicio: <span id="texto-cancelar"></span> ?
					</h3>
					<input type="hidden" value="Cancelado" name="estatus_cobranza_cancelar" id="estatus_cobranza_cancelar">
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_cancelar" name="id_cancelar">
					<input type="hidden" id="mostrar_bitacora_cancelar" name="mostrar_bitacora_cancelar">
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button id="btn-cancelar" type="button" class="btn btn-danger btn-flat">
						<span class="glyphicon glyphicon-eye-close"></span> Cancelar
					</button>
				</div>
			</div>
		</div>
	</form>
</div>