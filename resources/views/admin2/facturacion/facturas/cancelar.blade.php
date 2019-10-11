<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-cancelar-factura-{{ $factura->id }}">
	{{ Form::Open(array('action'=>array('FacturasController@destroy', $factura->id), 'method'=>'delete')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #e30000">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Cancelar Factura</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea cancelar la factura: <span>{{ $factura->folio_factura }}</span> ?
					</h4>
					<input type="hidden" value="Cancelado" name="estatus">
					<input type="hidden" value="{{ $factura->id }}" name="id_factura">
					<input type="hidden" value="{{ $factura->total }}" name="cancelado">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="submit" class="btn btn-danger">
						<span class="glyphicon glyphicon-remove"></span> Cancelar
					</button>
				</div>
			</div>
		</div>
	{{ Form::Close() }}
</div>