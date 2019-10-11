<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-enviar-estatus">
	<form>
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #008CC2;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" id="title-enviar-estatus" style="color: white;"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h4><i class="fas fa-book"></i> Asignar servicio a una de las Bitácoras de Estatus</h4>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-primary"><i class="fa fa-hourglass-half"></i> Bitácora Estatus</label>
									</span>
									<select class="form-control" name="id_bitacoras_estatus" id="id_bitacoras_estatus" style="width: 100%;">
										<option value="">-Seleccionar-</option>
				                        @foreach($bitacoras_estatus as $estatus)
											<option value="{{ $estatus->id }}">{{ $estatus->clave }} - {{ $estatus->bitacora }}</option>
				                        @endforeach
		                     		</select>
								</div>
							</div>
						</div>
					</div>
					

				</div>
				<div class="modal-footer">
					<input type="hidden" id="formato_boolean" value="1">
					<input type="hidden" id="id_servicio">
					<input type="hidden" id="id_control">
					<input type="hidden" id="id_admin" value="{{ Auth::user()->id }}">
					<input type="hidden" id="id_cliente">
					<input type="hidden" id="fecha"">
					<input name="_token_enviar_estatus" value="{{ csrf_token() }}" type="hidden">
					<button type="button" class="btn btn-gris btn-flat" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button class="btn btn-primary btn-flat" id="btn-enviar-estatus">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar
					</button>
				</div>
			</div>
		</div>
	</form>
</div>