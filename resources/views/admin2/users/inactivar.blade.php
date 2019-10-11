<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-inactivar-{{ $user->id }}">
	{{ Form::Open(array('action'=>array('UserController@destroy', $user->id), 'method'=>'delete')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #e30000">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Inactivar Usuario</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea inactivar el usuario: <span> {{ $user->iniciales }} - {{ $user->nombre }} {{ $user->apellido }}</span> ?
					</h4>
					<input type="hidden" value="0" name="estatus" id="estatus">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">
						<span class="glyphicon glyphicon-eye-close"></span> Inactivar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	{{ Form::Close() }}
</div>