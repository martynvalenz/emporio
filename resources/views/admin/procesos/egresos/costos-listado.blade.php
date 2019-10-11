@if(count($servicios) > 0)
<h4>Servicios para asignar al egreso</h4>
<div class="table-responsive">
	<div class="table-responsive">
	    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
	        <thead style="font-size: 15px; color:white; background-color:#218CBF">
	            <tr>
	                <th>ID</th>
	                <th hidden>IDCliente</th>
	                <th hidden>Control</th>
	                <th hidden>IDPago</th>
	                <th>Servicio</th>
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
	            <tr id="servicio-pagar-list-{{ $servicio->id }}">
	                <td style="width:10%;" valign="middle" align="left">{{ $servicio->id }}</td>
	                <td hidden>{{ $servicio->id_cliente }}</td>
	                <td hidden>{{ $servicio->id_control }}</td>
	                <td hidden>{{ $servicio->id_pago }}</td>
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
	                @if($servicio->mostrar_bitacora == 0 && $servicio->estatus_registro == 'Pendiente')
	                    <td align="center" style="width:10%;">
	                        <label class="label" style="background-color: #ff6600">Sin Bitácora</label>
	                    </td>
	                @else
	                    <td align="center" style="width:10%;">
	                        @if($servicio->estatus_registro == 'Pendiente')
	                            <label class="label label-warning">{{ $servicio->estatus_registro }}</label>
	                        @elseif($servicio->estatus_registro == 'Terminado')
	                            <label class="label label-success" title="Presentado {{ Carbon\Carbon::parse($servicio->fecha_registro)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha_registro)->format('d-m-Y') }}</label>
	                        @elseif($servicio->estatus_registro == 'Cancelado')
	                            <label class="label label-danger">{{ $servicio->estatus_registro }}</label>
	                        @elseif($servicio->estatus_registro == 'No Registro')
	                            <label class="label label-danger">{{ $servicio->estatus_registro }}</label>
	                        @endif
	                    </td>
	                @endif
	                <td style="width:6%;" align="center">
	                	<div class="checkbox checkbox-css">
	                	    <input type="checkbox" class="checkbox_servicio_pagar" id="servicio-pagar-{{ $servicio->id }}" onclick="CheckPagoServicio({{ $servicio->id }})" @if($servicio->costo_pagado == 1) checked value="1" @else unchecked value="0" @endif />
	                	    <label for="servicio-pagar-{{ $servicio->id }}"></label>
	                	</div>
	                	<input type="hidden"  @if($servicio->costo_pagado == 1) value="1" @else value="0" @endif id="servicio-pagar-val-{{ $servicio->id }}">
	                </td>
	            </tr>
	            @endforeach
	        </tbody>
	        <tfoot>
	            <tr>
	                <th colspan ="1">&nbsp;</th>
	                <th>Pendiente: </th>
	                <th style="font-weight: bold; text-align: right;" align="right" id="costo_pendiente">
	                    {{ number_format($monto_pendiente,2) }}</th>
	            </tr>
	            <input type="hidden" id="costo_pendiente_val" @if($monto_pendiente == '') value="0" @else value="{{ $monto_pendiente }}" @endif>
	        </tfoot>
	    </table>
	</div>
</div>
@else
	<h4>No hay servicios asignados ni servicios pendientes por pagar.</h4>
@endif