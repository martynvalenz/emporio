<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar-marca-servicio">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" style="color: white;"></h4>
				<button type="button" class="close cerrar-marca-servicio" aria-label="Cerrar" style="color:white">
					<span aria-hidden="true"><b>&times;</b></span>
				</button>
			</div>
			<form>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<a class="btn btn-info"><i class="fa fa-plus"></i> Marca</a>
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
					
					<button type="button" class="btn btn-grey btn-flat cerrar-marca-servicio">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<button type="button" class="btn btn-info btn-flat" id="btn-agregar-marca-servicio"><span class="fas fa-save"> </span> Agregar</button>
				</div>
			</form>
		</div>
	</div>
</div>