<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-editar-{{ $porcentaje->id }}">
	{{ Form::Open(array('action'=>array('PorcentajeIVAController@update', $porcentaje->id), 'method'=>'put')) }}
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">Editar porcentaje de IVA</h4>
				</div>
				<div class="modal-body">
					<h4>
						¿Desea actualizar el porcentaje de IVA?
					</h4>
					<hr>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="form-group {{ $errors->has('porcentaje_iva') ? ' has-error' : '' }}">
								<label for="porcentaje_iva">Porcentaje Actual</label>
								<div class="input-group">
									<span class="input-group-addon"><i>%</i></span>
									<input type="number" value="{{ $porcentaje->porcentaje_iva }}" name="porcentaje_iva" id="porcentaje_iva" class="form-control" autofocus>
								</div>
								
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="form-group">
								<label>Última actualización</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="date" value="{{ $porcentaje->updated_at->toDateString() }}" class="form-control" disabled>
								</div>
								
							</div>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-azul">
						<span class="glyphicon glyphicon-edit"></span> Actualizar
					</button>
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
				</div>
			</div>
		</div>
	{{ Form::Close() }}
</div>