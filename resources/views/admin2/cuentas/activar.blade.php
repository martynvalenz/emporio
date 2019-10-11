<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-activar-{{ $cuenta->id }}">
	{{ Form::Open(array('action'=>array('CuentasController@destroy', $cuenta->id), 'method'=>'delete')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #00b05b">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Activar Cuenta</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea activar la cuenta: <span> ({{ $cuenta->alias }}) - {{ $cuenta->banco }}</span> ?
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