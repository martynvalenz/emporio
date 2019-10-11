<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar-marca-servicio">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #218CBF;">
				<button type="button" class="close cerrar-marca-servicio" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Agregar Trámite, Marca, Obra o Patente</h4>
			</div>
			<form>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<button class="btn btn-info"><i class="fa fa-plus"></i> Marca</button>
									</span>
									<input type="text" name="nombre_marca" id="nombre_marca" class="form-control mayusculas" placeholder="Nombre de marca o título...">
								</div>
								<span class="help-block">
								    <strong id="nombre_marca_error" style="color:red"></strong>
								</span>
							</div>
							<br>
						</div>
						
					</div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="id_admin_marca_servicio" id="id_admin_marca_servicio" value="{{ Auth::user()->id }}">
					<input type="hidden" name="id_cliente_marca_servicio" id="id_cliente_marca_servicio">
					<input type="hidden" name="estatus_marca_servicio" id="estatus_marca_servicio" value="1">
					<input name="_token_marca_servicio" value="{{ csrf_token() }}" type="hidden">
					
					<button type="button" class="btn btn-gris btn-flat cerrar-marca-servicio">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="button" class="btn btn-azul btn-flat" id="btn-agregar-marca-servicio"><span class="glyphicon glyphicon-floppy-disk"> </span> Agregar</button>
				</div>
			</form>
		</div>
	</div>
</div>