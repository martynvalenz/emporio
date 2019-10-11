<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" role="dialog" id="menu-{{ $servicio->id }}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header modal-md" style="background-color: rgba(33,146,173,0.9);">
				<button type="button" class="close actualizar" aria-label="Cerrar">
					<span aria-hidden="true" style="font-size: 35px; color: black;"><b>&times;</b></span>
				</button>
				<h4 class="modal-title" style="color: white;">Servicio: {{ $servicio->clave }} - {{ $servicio->servicio }} {{ $servicio->marca }}</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-azul btn-flat btn-block" title="Crear una factura y asignar el servicio" data-tooltip="tooltip" data-toggle="modal" data-target="#factura-agregar" data-dismiss="modal">Crear Factura</button>
						<a class="btn btn-azul btn-flat btn-block" data-tooltip="tooltip" title="Agregar servicio a una factura existente" href="{{ route('facturas.listado', $servicio->id_cliente) }}" target="_blank">Factura Existente</a>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-info btn-flat btn-block" title="Crear un recibo y asignar el servicio" data-tooltip="tooltip" data-dismiss="modal">Crear Recibo</button>
						<button class="btn btn-info btn-flat btn-block" data-tooltip="tooltip" title="Agregar servicio a un recibo existente" data-dismiss="modal">Recibo Existente</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						@if($servicio->saldo > 0 && $servicio->facturado > 0)
							<button class="btn btn-success btn-flat btn-block" title="Cobrar facturas o recibos del cliente" data-tooltip="tooltip" data-toggle="modal" data-target="#agregar-cobranza" data-dismiss="modal">Cobrar servicio</button>
						@else
							<button class="btn btn-default btn-flat btn-block" disabled title="El servicio ya está saldado o no tiene facturas pendientes por cobrar." data-tooltip="tooltip">Cobrar</button>
						@endif
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<a class="btn btn-success btn-flat btn-block" data-tooltip="tooltip" title="Agregar/Modificar comisiones" href="{{ route('procesos.edit-creado', $servicio->id) }}" target="_blank">Comisiones</a>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat actualizar" data-dismiss="modal" data-tooltip="tooltip" title="Actualizar cambios">
					Cerrar y Actualizar <span class="fas fa-sync"></span>
				</button>
			</div>
		</div>
	</div>
</div>