<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-registro-{{ $bitacora->id }}">
	<form action="{{ route('registro-marcas-registro', $bitacora->id) }}" method="post">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
					</button>
					<h4 class="modal-title" style="color: white;">{{ $bitacora->marca }} - {{ $bitacora->nombre_comercial }}</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<label style="text-align: center">Número de Registro</label>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<label class="btn btn-info"><i>#</i></label>
									</span>
									<input type="text" name="numero_registro" class="form-control" value="@if(old('numero_registro')){{ old('numero_registro') }}@else{{ $bitacora->numero_registro }}@endif">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<button type="button" class="btn btn-gris" data-dismiss="modal">
						Cerrar <span class="glyphicon glyphicon-remove"></span>
					</button>
					<button type="submit" class="btn btn-primary">
						<span class="glyphicon glyphicon-floppy-disk"></span> Guardar
					</button>
				</div>
			</div>
		</div>
	</form>
</div>