<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="agregar-cliente">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #218CBF">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Agregar Cliente</h4>
			</div>
			<form action="">
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-info"><i class="fa fa-user-plus"></i> Nombre Comercial</label>
									</span>
									<input type="text" name="nombre_comercial" id="nombre_comercial" class="form-control mayusculas" placeholder="Nombre comercial del cliente..." autocomplete="off">
								</div>
								<span class="help-block">
								    <strong id="nombre_comercial_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-warning"><i class="fas fa-chart-line"></i> Estrategia de Captación</label>
									</span>
									<select class="form-control" name="id_estrategia" id="id_estrategia">
										<option value="">-Seleccionar estrategia-</option>
										@foreach($estrategias as $estrategia)
											<option value="{{ $estrategia->id }}">{{ $estrategia->estrategia }}</option>
										@endforeach
									</select>
								</div>
								<span class="help-block">
								    <strong id="id_estrategia_error" style="color:red"></strong>
								</span>
							</div>
						</div>
						
					</div>
					<input type="hidden" value="{{ Auth::user()->id }}" name="id_admin_agregar_cliente">
				</div>

				<div class="modal-footer">
					<input name="_token_cliente" id="token_cliente" value="{{ csrf_token() }}" type="hidden">
					
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="button" id="guardar-cliente" class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-disk"> </span> Agregar</button>
				</div>
			</form>
		</div>
	</div>
</div>