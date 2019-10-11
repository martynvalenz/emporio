@if(count($facturas) > 0)
{{$facturas->render()}}
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Saldo</th>
                <th>Creado</th>
                <th>Estatus?</th>
                <th hidden>Id</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($facturas as $key => $factura)
            <tr id="factura-{{ $factura->id }}">
                <td style="width:8%;" valign="middle" align="left" title="{{ $factura->comentarios }}" data-tooltip="tooltip" data-target="#modal-detalles-factura-{{ $factura->id }}" data-toggle="modal">
                    @if($factura->estatus == 'Pagado')
                    <label class="label label-success" style="font-size: 15px">{{ $factura->folio_factura }}</label>
                    @elseif($factura->estatus == 'Cancelado')
                    <label class="label label-danger" style="font-size: 15px">{{ $factura->folio_factura }}</label>
                    @elseif($factura->estatus == 'Pendiente')
                    <label class="label label-warning" style="font-size: 15px">{{ $factura->folio_factura }}</label>
                    @endif
                </td>
                <td style="width:15%;" valign="middle" align="left" data-target="#modal-detalles-factura-{{ $factura->id }}" data-toggle="modal" title="{{ $factura->razon }} {{ $factura->rfc_cliente }}" data-tooltip="tooltip">{{ $factura->nombre_comercial }}</td>
                <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($factura->fecha)->diffForHumans() }}" data-target="#modal-detalles-factura-{{ $factura->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                <td style="width:10%;" valign="middle" align="right" data-target="#modal-detalles-factura-{{ $factura->id }}" data-toggle="modal">{{ number_format($factura->subtotal,2) }}</td>
                <td style="width:10%;" valign="middle" align="right" data-target="#modal-detalles-factura-{{ $factura->id }}" data-toggle="modal">{{ number_format($factura->iva,2) }}</td>
                <td style="width:10%;" valign="middle" align="right" data-target="#modal-detalles-factura-{{ $factura->id }}" data-toggle="modal">{{ number_format($factura->total,2) }}</td>
                <td style="width:10%;" valign="middle" align="right" data-target="#modal-detalles-factura-{{ $factura->id }}" data-toggle="modal" title="Pagado: {{ number_format($factura->pagado,2) }}" data-tooltip="tooltip">{{ number_format($factura->saldo,2) }}</td>
                <td style="width:7%;" align="center" valign="middle" data-target="#modal-detalles-factura-{{ $factura->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $factura->nombre }} {{ $factura->apellido }}">{{ $factura->iniciales }}</td>
                <td style="width:8%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-factura-{{ $factura->id }}" data-toggle="modal">
                    @if($factura->estatus == 'Pagado')
                        <label class="label label-success">Pagado</label>
                    @elseif($factura->estatus == 'Cancelado')
                        <label class="label label-danger">Cancelado</label>
                    @elseif($factura->estatus == 'Pendiente')
                        <label class="label label-warning">Pendiente</label>
                    @endif
                </td>
                <td hidden>{{ $factura->id }}</td>
                <td style="width:12%;" align="center">
                    @if($factura->detalles == 0)
                        <a disabled class="btn btn-default btn-xs btn-detalle" title="La factura no tiene servicios." data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-th-list"></i>
                            <span class="label label-danger">0</span>
                        </a>
                    @elseif($factura->detalles > 0)
                        <a class="btn btn-default btn-xs btn-detalle" 
                        title="Ver servicios: {{ $factura->detalles }}"
                        data-tooltip="tooltip" 
                        data-toggle="modal" 
                        data-target="#modal-detalles"
                        onclick="Detalles({{ $factura->id }})"
                        >
                            <i class="glyphicon glyphicon-th-list"></i>
                            <span class="label label-success">{{ $factura->detalles }}</span> 
                        </a>
                    @endif
                    </a>
                    @if($factura->estatus == 'Pagado' || $factura->pagado > 0)
                        <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede editar una factura pagada." disabled>
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a class="btn btn-xs btn-default" title="No se puede cancelar una factura que tiene pagos asociados" data-tooltip="tooltip" disabled>
                            <i class="glyphicon glyphicon-remove"></i>
                        </a> 
                    @elseif($factura->estatus == 'Pendiente')
                        <a class="btn btn-xs btn-warning" onclick="Edit({{ $factura->id }})" data-toggle="modal" data-target="#factura-modal"  data-tooltip="tooltip" title="Editar factura: # {{ $factura->folio_factura }}">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" data-target="#modal-cancelar-factura-{{ $factura->id }}" data-toggle="modal" title="Cancelar factura: # {{ $factura->folio_factura }}" data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>  
                    @elseif($factura->estatus == 'Cancelado')
                        <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede editar una factura que ya está cancelada, tiene que activarla primero." disabled>
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a class="btn btn-xs btn-success" data-target="#modal-activar-factura-{{ $factura->id }}" data-toggle="modal" title="Activar factura: # {{ $factura->folio_factura }}" data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-ok"></i>
                        </a>  
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$facturas->render()}}
@else
<h4>No hay registros encontrados, inicie por crear uno nuevo.</h4>
@endif