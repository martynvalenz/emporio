<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar-marca">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #218CBF;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
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
									<input type="text" name="marca" id="marca" class="form-control mayusculas" autocomplete="off" placeholder="Nombre de marca o título...">
								</div>
								<span class="help-block">
								    <strong style="color:red" id="marca_error"></strong>
								</span>
							</div>
							<br>
						</div>

					
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-success"><i class="fa fa-user"></i> Cliente</button>
								</span>
								<select class="form-control selectpicker" name="id_cliente_marca" id="id_cliente_marca" data-live-search="true">
									<option value="">-Seleccionar cliente-</option>
								</select>
							</div>
							<span class="help-block">
							    <strong style="color:red" id="id_cliente_marca_error"></strong>
							</span>
						</div>
						
					</div>
					<div class="row">
						<br>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="estatus_marca">Estatus</label>
								<label for="estatus_marca" class="container">Activo
									<input type="checkbox" value="1" checked="true" name="estatus_marca" id="estatus_marca">
									<span class="checkmark"></span>
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label for="descripcion_marca">Descripción</label>
							<textarea name="descripcion_marca" id="descripcion_marca" rows="3" class="form-control"></textarea>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<input name="_token" id="token_marca" value="{{ csrf_token() }}" type="hidden">
					<input name="id_admin_marca" id="id_admin_marca" value="{{ Auth::user()->id }}" type="hidden">
					
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="button" id="guardar-marca" class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-disk"> </span> Agregar</button>
				</div>
			</form>
		</div>
	</div>
</div>