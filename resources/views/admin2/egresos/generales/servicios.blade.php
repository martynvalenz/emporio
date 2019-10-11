<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@if(count($servicios) > 0)
		<h4>Servicios pendientes por pagar</h4>
		<div class="table-responsive">
			<div class="table-responsive">
			    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
			        <thead style="font-size: 15px; color:white; background-color:#ff6600">
			            <tr>
			                <th>ID</th>
			                <th hidden>Control</th>
			                <th>Servicio - Cliente</th>
			                <th>Costo</th>
			                <th>Precio</th>
			                <th>Creado</th>
			                <th>Estatus</th>
			                <th title="Estatus de cobranza del servicio" data-tooltip="tooltip">Bitácora</th>
			                <th colspan ="1">&nbsp;</th>
			            </tr>
			        </thead>
			        <tbody style="font-size: 15px" id="list" name="list">
			            @foreach($servicios as $key => $servicio)
			            <tr id="servicio{{ $servicio->id }}">
			                <td style="width:10%;" valign="middle" align="left">{{ $servicio->id }}</td>
			                <td hidden>{{ $servicio->id_control }}</td>
			                <td style="width:24%;" valign="middle" align="left" title="{{ $servicio->clave }} - {{ $servicio->servicio }}" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->tramite }} {{ $servicio->marca }} {{ $servicio->clase }} - {{ $servicio->nombre_comercial }}</td>
			                <td style="width:10%; font-weight: bold" align="right">{{ $servicio->costo_servicio }}</td>
			                <td style="width:10%;" valign="middle" align="right" title="Descuento: $ {{ $servicio->descuento }} | % {{ $servicio->porcentaje_descuento }}" data-tooltip="tooltip">{{ number_format($servicio->costo,2) }}</td>
			                <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}</td>
			                <td style="width:10%;" align="center" valign="middle" title="Facturado: $ {{ number_format($servicio->facturado,2) }} | Cobrado: $ {{ number_format($servicio->cobrado,2) }} | Saldo: $ {{ number_format($servicio->saldo,2) }}" data-tooltip="tooltip">
			                    @if($servicio->estatus_cobranza != 'Cancelado' && $servicio->saldo > '0')
			                        <label class="label label-warning">Pendiente</label>
			                    @elseif($servicio->estatus_cobranza != 'Cancelado' && $servicio->saldo == '0')
			                        <label class="label label-success">Pagado</label>
			                    @elseif($servicio->estatus_cobranza == 'Cancelado')
			                        <label class="label label-danger">{{ $servicio->estatus_cobranza }}</label>
			                    @endif
			                </td>
			                @if($servicio->mostrar_bitacora == 0 && $servicio->estatus_tramite == 'Pendiente')
			                    <td align="center" style="width:10%;">
			                        <label class="label" style="background-color: #ff6600">Sin Bitácora</label>
			                    </td>
			                @else
			                    <td align="center" style="width:10%;">
			                        @if($servicio->estatus_tramite == 'Pendiente')
			                            <label class="label label-warning">{{ $servicio->estatus_tramite }}</label>
			                        @elseif($servicio->estatus_tramite == 'Terminado')
			                            <label class="label label-success" title="Presentado {{ Carbon\Carbon::parse($servicio->presentacion_fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->presentacion_fecha)->format('d-m-Y') }}</label>
			                        @elseif($servicio->estatus_tramite == 'Cancelado')
			                            <label class="label label-danger">{{ $servicio->estatus_tramite }}</label>
			                        @elseif($servicio->estatus_tramite == 'No Registro')
			                            <label class="label label-danger">{{ $servicio->estatus_tramite }}</label>
			                        @endif
			                    </td>
			                @endif
			                <td style="width:6%;" align="center">
			                	<a id="btn-pagar-{{ $servicio->id }}" class="btn btn-success btn-xs btn-flat btn-pagar-servicio" title="Agregar el costo del servicio al egreso" data-tooltip="tooltip"><i class="fas fa-check"></i></a>
			                </td>
			            </tr>
			            @endforeach
			        </tbody>
			        <tfoot>
			        	<th colspan="2" style="text-decoration: bold; text-align: right">Total</th>
			        	<th style="text-decoration: bold; text-align: right">{{ number_format($total, 2) }}</th>
			        	<th colspan ="5">&nbsp;</th>
			        </tfoot>
			    </table>
			</div>
		</div>
		@else
		<h4>No hay servicios pendientes por pagar</h4>
		@endif
	</div>
</div>
