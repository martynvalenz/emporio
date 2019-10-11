@if(count($estados_cuenta) > 0)
<div>
    <h3>Abonos: <b>$ {{ number_format($depositos, 2) }}</b> | Retiros: <b>$ {{ number_format($retiros, 2) }}</b></h3>
    <h3>Saldo Total: <b @if($saldo_final >= 0) style="color:black" @else style="color:red" @endif>$ {{ number_format($saldo_final, 2) }}</b></h3>
</div>
<br>
{{$estados_cuenta->render()}} 
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr>
                <th hidden>ID</th>
                <th>Categoría</th>
                <th>Proveedor/Cliente</th>
                <th>Cuenta</th>
                <th>Factura?</th>
                <th>Pago</th>
                <th>Abono</th>
                <th>Retiro</th>
                <th>Fecha</th>
                <th>Estatus?</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($estados_cuenta as $key => $egreso)
            <tr id="egreso-{{ $egreso->id }}">
                <td hidden>{{ $egreso->id }}</td>
                <td style="width:15%;" valign="middle" align="left" title="{{ $egreso->concepto }}" data-tooltip="tooltip" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
                    @if($egreso->tipo == 'Despacho')
                        <label class="label label-info">Despacho</label> {{ $egreso->categoria }}
                    @elseif($egreso->tipo == 'Hogar')
                        <label class="label label-success">Hogar</label> {{ $egreso->categoria }}
                    @elseif($egreso->tipo == 'Personal')
                        <label class="label label-warning">Personal</label> {{ $egreso->categoria }}
                    @elseif($egreso->tipo == 'Comision')
                        <label class="label label-default">Comisión</label> {{ $egreso->categoria }}
                    @elseif($egreso->tipo == 'Ingreso')
                        <label class="label label-primary">Ingreso</label> {{ $egreso->categoria }}
                    @endif
                </td>
                @if($egreso->tipo == 'Comision')
                    <td style="width:15%;" valign="middle" align="left" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="">{{ $egreso->nombre }} {{ $egreso->apellido }}</td>
                @elseif($egreso->tipo == 'Ingreso')
                    <td style="width:15%;" valign="middle" align="left" data-tooltip="tooltip" title="">{{ $egreso->cliente }}</td>
                @else
                    <td style="width:15%;" valign="middle" align="left" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $egreso->razon_social }} | {{ $egreso->rfc }}">{{ $egreso->nombre_comercial }}</td>
                @endif
                <td style="width:8%;" align="left" valign="middle" title="{{ $egreso->banco }}" data-tooltip="tooltip" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ $egreso->alias }}</td>
                <td style="width:5%;" valign="middle" align="center" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
                    @if($egreso->con_iva == 1)
                        <label for="con_iva" class="label label-success">SI</label>
                    @else
                        <label for="con_iva" class="label label-warning">NO</label>
                    @endif
                </td>
                <td style="width:10%;" align="center" valign="middle"  data-tooltip="tooltip" title="{{ $egreso->codigo }} - {{ $egreso->forma_pago }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ $egreso->forma_pago }}</td>
                @if($egreso->deposito == 0)
                    <td style="width:10%; color: #d9d9d9" align="right" valign="middle" data-tooltip="tooltip">{{ number_format($egreso->deposito,2) }}</td>
                @else
                    <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($egreso->subtotal,2) }} | IVA: {{ number_format($egreso->iva,2) }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ number_format($egreso->deposito,2) }}</td>
                @endif
                @if($egreso->retiro == 0)
                    <td style="width:10%; color: #d9d9d9" align="right" valign="middle" data-tooltip="tooltip">{{ number_format($egreso->retiro,2) }}</td>
                @else
                    <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($egreso->subtotal,2) }} | IVA: {{ number_format($egreso->iva,2) }}">{{ number_format($egreso->retiro,2) }}</td>
                @endif
                <td style="width:8%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->fecha)->diffForHumans() }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->fecha)->format('d/m/Y') }}</td>
                <td style="width:8%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
                    @if($egreso->estatus == 'Pagado' || $egreso->estatus == 'Cerrado' || $egreso->estatus == 'Abierto')
                        <label class="label label-success">Pagado</label>
                    @elseif($egreso->estatus == 'Cancelado')
                        <label class="label label-danger" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($egreso->cancelado_at)->diffForHumans() }} | {{ Carbon\Carbon::parse($egreso->cancelado_at)->format('d/m/Y') }}">Cancelado</label>
                    @elseif($egreso->estatus == 'Pendiente')
                        <label class="label label-warning">Pendiente</label>
                    @endif
                </td>
                <td style="width:10%;" align="center">
                    @if($egreso->tipo == 'Comision' || $egreso->tipo == 'Ingreso' || $egreso->tipo == 'Nomina')

                    @else
                        <a class="btn btn-xs btn-info"  data-tooltip="tooltip" title="Editar egreso: {{ $egreso->concepto }}" onclick="Edit({{ $egreso->id }})" data-toggle="modal" data-target="#egresos">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                    @endif
                    <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-pendiente-{{ $egreso->id }}" data-tooltip="tooltip" title="Pasar egreso a estatus de 'Pendiente' de pago">
                        <i class="glyphicon glyphicon-minus"></i>
                    </a>
                    @if($egreso->estatus == 'Pagado' || $egreso->estatus == 'Pendiente')
                        <a class="btn btn-xs btn-danger" data-target="#modal-cancelar-{{ $egreso->id }}" data-toggle="modal" title="Cancelar egreso {{ $egreso->concepto }}" data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>  
                    @else
                        <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $egreso->id }}" data-toggle="modal" title="Activar egreso" data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-ok"></i>
                        </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$estados_cuenta->render()}}
@else
<h4>No hay registros encontrados, inicie por crear un registro nuevo.</h4>
@endif