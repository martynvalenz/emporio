<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-cancelar-bitacora">
	<form action="">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #e30000">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Cancelar Servicio</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea activar el servicio: <span id="modal-title-estatus-cancelar"></span> ?
					</h4>
					<input type="hidden" name="estatus_tramite_cancelar" id="estatus_tramite_cancelar">
					<input type="hidden" name="id_servicio_cancelar" id="id_servicio_cancelar">
					<input type="hidden" id="_token_bitacoras_cancelar" value="{{ csrf_token() }}">
				</div>
				<div class="modal-footer">
					
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar 
					</button>
					<button type="button" class="btn btn-danger btn-flat" id="btn-cancelar-bitacora">
						<span class="glyphicon glyphicon-remove"></span> Cancelar
					</button>
				</div>
			</div>
		</div>
	</form>
</div>