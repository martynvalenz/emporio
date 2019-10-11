<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-cancelar-{{ $bitacora->id }}">
	 <form role="form" action="{{ route('registro-marcas.cancelar', $bitacora->id) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #e30000">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Cancelar Registro</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea cancelar el registro: <span>{{ $bitacora->marca }}</span> ?
					</h4>
					<input type="hidden" value="Cancelado" name="estatus">
					<input type="hidden" value="{{ $bitacora->fecha_inicio }}" name="fecha_inicio">
					<input type="hidden" value="{{ $bitacora->fecha_vencimiento }}" name="fecha_vencimiento">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">
						<span class="glyphicon glyphicon-remove"></span> Cancelar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>