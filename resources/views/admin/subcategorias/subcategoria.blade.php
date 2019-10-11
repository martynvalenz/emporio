<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-subcategoria">
	<form action="">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true"><b>&times;</b></span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="">Subcategoría</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-bookmark"></i></span>
									<input type="text" id="subcategoria" class="form-control">
								</div>
								<span class="help-block">
								    <strong id="subcategoria_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label for="">Bitácora de Estatus</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-book"></i></span>
									<select name="id_categoria" id="id_categoria" class="form-control">
										<option value="">-Seleccionar-</option>
										@foreach($categorias as $categoria)
											<option value="{{ $categoria->id }}">{{ $categoria->clave }} {{ $categoria->bitacora }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_categoria_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4>Declaración de uso</h4>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-book"></i></span>
									<select name="comprobacion_uso_plazo" id="comprobacion_uso_plazo" class="form-control">
										<option value="">-Seleccionar-</option>
										<option value="Dias">Días</option>
										<option value="Meses">Meses</option>
										<option value="Anios">Años</option>
									</select>
								</div>
								<span class="help-block">
								    <strong id="comprobacion_uso_plazo_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-sort-numeric-down"></i></span>
									<input type="number" step="any" id="comprobacion_uso" class="form-control centered">
								</div>
								<span class="help-block">
								    <strong id="comprobacion_uso_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4>Recordatorio</h4>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-book"></i></span>
									<select name="recordatorio_plazo" id="recordatorio_plazo" class="form-control">
										<option value="">-Seleccionar-</option>
										<option value="Dias">Días</option>
										<option value="Meses">Meses</option>
										<option value="Anios">Años</option>
									</select>
								</div>
								<span class="help-block">
								    <strong id="recordatorio_plazo_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-sort-numeric-down"></i></span>
									<input type="number" step="any" id="recordatorio" class="form-control centered">
								</div>
								<span class="help-block">
								    <strong id="recordatorio_error" style="color:red"></strong>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4>Vencimiento</h4>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-book"></i></span>
									<select name="vencimiento_plazo" id="vencimiento_plazo" class="form-control">
										<option value="">-Seleccionar-</option>
										<option value="Dias">Días</option>
										<option value="Meses">Meses</option>
										<option value="Anios">Años</option>
									</select>
								</div>
								<span class="help-block">
								    <strong id="vencimiento_plazo_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-sort-numeric-down"></i></span>
									<input type="number" step="any" id="vencimiento" class="form-control centered">
								</div>
								<span class="help-block">
								    <strong id="vencimiento_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="renovacion" class="container">
									<input type="checkbox" name="renovacion" id="renovacion">
									<span class="checkmark"></span> Renovación
								</label>
							</div>
							<input type="hidden" name="renovacion_check" id="renovacion_check">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_subcategoria">
					<button type="button" class="btn btn-grey btn-flat" data-dismiss="modal">
						Cerrar <span class="fas fa-times"></span>
					</button>
					<a id="btn-guardar-subcategoria" class="btn btn-primary">Guardar <i class="fas fa-save"></i></a>
				</div>
			</div>
		</div>
	</form>
</div>