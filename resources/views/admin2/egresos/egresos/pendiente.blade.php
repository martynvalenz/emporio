<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-pendiente-{{ $egreso->id }}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #fe9800">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Cambiar estatus de egreso</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea cambiar el estatus del egreso a Pendiente. Egreso: <span>{{ $egreso->categoria }} {{ $egreso->concepto }}</span> ?
					</h4>
					<input type="hidden" value="Pendiente" name="estatus" id="estatus">
					
					<input type="hidden" value="0" name="pagado" id="pagado">
					<input type="hidden" value="0" name="retiro" id="retiro">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning">
						<span class="glyphicon glyphicon-minus"></span> Cambiar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
</div>