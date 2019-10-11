<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-activar">
	<form>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #00B05B;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Activar Servicio</h4>
				</div>
				<div class="modal-body">
					<h3>
						¿Desea activar el servicio: <span id="texto-activar"></span> ?
					</h3>
						<input type="hidden" name="estatus_cobranza_activar" id="estatus_cobranza_activar">
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_activar" name="id_activar">
					<input type="hidden" id="mostrar_bitacora_activar" name="mostrar_bitacora_activar">
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="button" id="btn-activar" class="btn btn-success btn-flat">
						<span class="glyphicon glyphicon-ok"></span> Activar
					</button>
				</div>
			</div>
		</div>
	</form>
</div>