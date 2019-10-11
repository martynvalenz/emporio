<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-activar-bitacora">
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
						¿Desea activar el servicio: <span id="modal-title-estatus-activar"></span> ?
					</h4>
					<input type="hidden" name="estatus_tramite_activar" id="estatus_tramite_activar">
					<input type="hidden" name="id_servicio_activar" id="id_servicio_activar">
					<input type="hidden" name="registro_activar" id="registro_activar">
					<input type="hidden" id="_token_bitacoras_activar" value="{{ csrf_token() }}">
				</div>
				<div class="modal-footer">
					
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="button" class="btn btn-success btn-flat" id="btn-activar-bitacora">
						<span class="glyphicon glyphicon-ok"></span> Activar
					</button>
				</div>
			</div>
		</div>
	</form>
</div>