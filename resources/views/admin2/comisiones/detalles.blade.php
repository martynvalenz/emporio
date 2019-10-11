<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-detalles-comision">
	<form>
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: gray">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 id="encabezado-title" style="color: white;">Detalles de egreso</h4>
					<input type="hidden" id="id_egreso" name="id_egreso">
				</div>
				<div class="modal-body">
					<div id="comisiones-detalles"></div>
				</div>
				<div class="modal-footer">
					<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin_egreso" id="id_admin_egreso">
					<input type="hidden" id="accion">
					<input type="hidden" id="_token_egresos" name="_token_egresos" value="{{ csrf_token() }}">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button type="button" class="btn btn-gris btn-flat btn-cerrar-actualizar" data-dismiss="modal">
							Cerrar <span class="glyphicon glyphicon-remove"></span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>