<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-activar-{{ $cliente->id }}">
	{{ Form::Open(array('action'=>array('ClientesController@destroy', $cliente->id), 'method'=>'delete')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #00b05b">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Activar Cliente</h4>
				</div>
				<div class="modal-body">
					@if ($cliente->logo == null)
						Logo
					@else
						<img src="{{ asset('images/clients/'.$cliente->logo) }}" alt="{{ $cliente->nombre_comercial }}" height="100">
					@endif
					<hr>
					<h4>
						¿Desea activar al cliente: <span> {{ $cliente->nombre_comercial }}</span> ?
					</h4>
					<input type="hidden" value="1" name="estatus" id="estatus">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">
						<span class="glyphicon glyphicon-eye-open"></span> Activar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	{{ Form::Close() }}
</div>