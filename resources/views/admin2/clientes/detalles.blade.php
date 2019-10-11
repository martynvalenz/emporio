<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="modal-detalles-{{ $cliente->id }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h3 class="modal-title" style="color: white;">Cliente: #{{ $cliente->id }} | {{ $cliente->nombre_comercial }}</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<img src="{{ asset('images/clients/'.$cliente->logo) }}" alt="Logo de {{ $cliente->nombre_comercial }}" height="100px">
						<hr>
					</div> 

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Creada</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" value="{{ Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}" class="form-control" disabled style="background-color: white; color:black">
							</div>
							
						</div>
					</div>	
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Última actualización</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" value="{{ Carbon\Carbon::parse($cliente->updated_at)->format('d/m/Y') }}" class="form-control" disabled style="background-color: white; color:black">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group">
							<label>Creado por:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
							@if($cliente->id_admin == null)
				        		<input type="text" class="form-control" value="">
				        	@else
								<input type="text" value="{{ $cliente->nombre }} {{ $cliente->apellido }}" class="form-control">
							@endif
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					  <div class="form-group">
					    <label for="id_estrategia">Estrategia</label>
					    <div class="input-group">
					      <span class="input-group-addon btn btn-invertido" title="Agregar estrategia">
					          <i class="fa fa-line-chart"></i>
					      </span>
					      @if($cliente->id_estrategia == null)
					      	<input type="text" value="" class="form-control">
					      @else
					      	<input type="text" value="{{ $cliente->estrategia }}" class="form-control">
					      @endif
					    </div>
					  </div>
					</div>

				</div>
				<hr>

				<div class="row">
				  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				    <div class="form-group {{ $errors->has('carpeta') ? ' has-error' : '' }}">
				      <label for="carpeta" class="control-label">Carpeta</label>
				      <div class="input-group">
				        <span class="input-group-addon btn btn-invertido" style="background-color: #207e94" title="Abrir URL: {{ $cliente->carpeta }}"><i class="glyphicon glyphicon-folder-open" style="color:white"></i></span>
				        @if($cliente->carpeta == null)
				        	<a title="No tiene URL de carpeta guardada" data-tooltip="tooltip" class="form-control"></a>
				        @else
				        	<a href="{{ $cliente->carpeta }}" title="Ir a carpeta: {{ $cliente->carpeta }}" target="_blank" class="form-control minusculas">{{ $cliente->carpeta }}</a>
				        @endif
				      </div>
				    </div>
				  </div>
				  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				    <div class="form-group {{ $errors->has('pagina_web') ? ' has-error' : '' }}">
				      <label for="pagina_web" class="control-label">Página web</label>
				      <div class="input-group">
				        <span type="button" class="input-group-addon btn btn-invertido" style="background-color: #207e94" title="Abrir URL: {{ $cliente->pagina_web }}" href="{{ $cliente->pagina_web }}" target="_blank"><i class="fa fa-globe" style="color:white"></i></span>
				        @if($cliente->pagina_web == null)
				        	<a title="No tiene página web guardada" data-tooltip="tooltip" class="form-control minusculas"></a>
				        @else
				        	<a href="{{ $cliente->pagina_web }}" title="Ir a página: {{ $cliente->pagina_web }}" target="_blank" class="form-control minusculas">{{ $cliente->pagina_web }}</a>
				        @endif
				      </div>
				    </div>
				  </div>
				  

				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				    <div class="form-group">
				      <label for="estatus">Estatus</label>
				      <div class="checkbox">
				        <label>
				          {!! Form::checkbox('estatus', null, $cliente->estatus == 1 ? true : false, array('class'=> 'icheckbox_minimal-blue')) !!} Activo
				        </label>
				      </div>
				    </div>
				  </div>

				</div>

				<div class="row">
				  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				    <label for="comentarios">Comentarios</label>
				    <p>{!! htmlspecialchars_decode($cliente->comentarios) !!}</p>
				  </div>
				</div>

				

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-gris" data-dismiss="modal">
					Cerrar <span class="glyphicon glyphicon-remove"></span>
				</button>
			</div>
		</div>
	</div>
</div>