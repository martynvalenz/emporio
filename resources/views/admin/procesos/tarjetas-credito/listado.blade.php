@if(count($egresos) > 0)
<div>
    <h3 id="saldo_total">Saldo: <b>$ {{ number_format($saldo, 2) }}</b></h3>
</div>
<br>
{{$egresos->render()}}
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr>
                <th hidden>ID</th>
                <th>Categoría</th>
                <th>Proveedor</th>
                <th>Cuenta</th>
                <th>Factura?</th>
                <th>Total</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Estatus?</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($egresos as $key => $egreso)
            <tr id="egreso-{{ $egreso->id }}">
                <td hidden>{{ $egreso->id }}</td>
                <td style="width:20%;" valign="middle" align="left" title="{{ $egreso->concepto }}" data-tooltip="tooltip">
                    @if($egreso->tipo == 'Despacho')
                        <label class="label label-info">Despacho</label> {{ $egreso->categoria }}
                    @elseif($egreso->tipo == 'Hogar')
                        <label class="label label-success">Hogar</label> {{ $egreso->categoria }}
                    @elseif($egreso->tipo == 'Personal')
                        <label class="label label-warning">Personal</label> {{ $egreso->categoria }}
                    @endif
                </td>
                <td style="width:15%;" valign="middle" align="left" data-tooltip="tooltip" title="{{ $egreso->razon_social }} | {{ $egreso->rfc }}">{{ $egreso->nombre_comercial }}</td>
                <td style="width:10%;" align="left" valign="middle" title="{{ $egreso->banco }}" data-tooltip="tooltip">{{ $egreso->alias }}</td>
                <td style="width:5%;" valign="middle" align="center">
                    @if($egreso->con_iva == 1)
                        <label for="con_iva" class="label label-success">SI</label>
                    @else
                        <label for="con_iva" class="label label-warning">NO</label>
                    @endif
                </td>
                <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($egreso->subtotal,2) }} | IVA: {{ number_format($egreso->iva,2) }}">{{ number_format($egreso->total,2) }}</td>
                <td style="width:5%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ $egreso->nombre }} {{ $egreso->apellido }}">{{ $egreso->iniciales }}</td>
                @if($egreso->fecha == null)
                    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->created_at)->format('d/m/Y') }}</td>
                @else
                    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->fecha)->format('d/m/Y') }}</td>
                @endif
                <td style="width:10%;" align="center" valign="middle" title="Detalles">
                    @if($egreso->estatus == 'Pagado')
                        <label class="label label-success">Pagado</label>
                    @elseif($egreso->estatus == 'Cancelado')
                        <label class="label label-danger">Cancelado</label>
                    @elseif($egreso->estatus == 'Pendiente')
                        <label class="label label-warning">Pendiente</label>
                    @endif
                </td>
                <td style="width:15%;" align="center">
                   

                    <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="Ver detalles">
                        <i class="fas fa-list"></i>
                    </a>

                    

                    @if($egreso->estatus == 'Pagado')
                        <a class="btn btn-xs btn-warning" disabled data-tooltip="tooltip" title="No se puede editar un egreso saldado">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" disabled title="El egreso no se puede cancelar porque ya está saldado" data-tooltip="tooltip">
                            <i class="fas fa-times"></i>
                        </a> 
                    @elseif($egreso->estatus == 'Pendiente')
                        <a class="btn btn-xs btn-warning" data-tooltip="tooltip" title="Editar egreso: {{ $egreso->id }}" onclick="Edit({{ $egreso->id }})" data-target="#modal-tarjeta-credito" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" title="Cancelar egreso" data-tooltip="tooltip" onclick="Cancelar({{ $egreso->id }})">
                            <i class="fas fa-times"></i>
                        </a> 
                    @elseif($egreso->estatus == 'Cancelado')
                        <a class="btn btn-xs btn-warning" data-tooltip="tooltip" title="Editar egreso: {{ $egreso->id }}" onclick="Edit({{ $egreso->id }})" data-target="#modal-tarjeta-credito" data-toggle="modal">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-xs btn-success" title="Activar egreso" data-tooltip="tooltip" onclick="Activar({{ $egreso->id }})">
                            <i class="fas fa-check"></i>
                        </a> 
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$egresos->render()}}
@else
    <h4>No hay registros encontrados, inicie por crear un registro nuevo.</h4>
@endif