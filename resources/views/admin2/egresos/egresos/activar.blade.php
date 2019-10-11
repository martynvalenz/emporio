<div class="modal modal-success fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-activar-{{ $egreso->id }}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #00b05b">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Activar egreso</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea reactivar el egreso: <span>{{ $egreso->categoria }} {{ $egreso->concepto }}</span> ?
					</h4>
					<input type="hidden" value="Pagado" name="estatus" id="estatus">
					<input type="hidden" value="1" name="pagado" id="pagado">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">
						<span class="glyphicon glyphicon-ok"></span> Activar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
</div>