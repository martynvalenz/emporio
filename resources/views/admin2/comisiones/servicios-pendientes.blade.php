@if(count($comisiones) > 0)
<div class="table-responsive">
    <h4>Comisiones pendientes por pagar</h4>
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:orange">
            <tr>
                <th hidden>ID</th>
                <th>ID</th>
                <th>Servicio</th>
                <th data-tooltip="tooltip" title="Tipo de comisión">Tipo</th>
                <th>Agregada</th>
                <th>Liberada</th>
                <th>Pagada</th>
                <th>Estatus</th>
                <th data-tooltip="tooltip" title="Monto de comisión">Comisión</th>
                <th colspan="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($comisiones as $key => $comision)
            <tr id="comision{{ $comision->id }}">
                <td hidden>{{ $comision->id }}</td>
                <td style="width:8%;">{{ $comision->id_servicio }}</td>
                <td style="width:27%;" align="left" title="{{ $comision->clave }} - {{ $comision->servicio }} {{ $comision->tramite }}" data-tooltip="tooltip">{{ $comision->clave }} - {{ $comision->marca }} {{ $comision->clase }}. {{ $comision->nombre_comercial }}</td>
                <td style="width:5%;" align="center" valign="middle">
                    @if($comision->tipo_comision == 'Venta')
                        <label class="label label-success">Venta</label>
                    @elseif($comision->tipo_comision == 'Operativa')
                        <label class="label label-info">Operativa</label>
                    @elseif($comision->tipo_comision == 'Gestión')
                        <label class="label label-primary">Gestión</label>
                    @endif
                </td>
                @if($comision->fecha_comision == null)
                    <td style="width:10%;" align="center" valign="middle"></td>
                @else
                    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_comision)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_comision)->format('d-m-Y') }}</td>
                @endif
                @if($comision->fecha_aplicada == null)
                    <td style="width:10%;" align="center" valign="middle"></td>
                @else
                    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_aplicada)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_aplicada)->format('d-m-Y') }}</td>
                @endif
                @if($comision->fecha_pagado == null)
                    <td style="width:10%;" align="center" valign="middle"></td>
                @else
                    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_pagado)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_pagado)->format('d-m-Y') }}</td>
                @endif
                <td style="width:10%" align="center" valign="middle" title="" data-tooltip="tooltip">
                    @if($comision->estatus == 'Pagada')
                        <label class="label label-success">Pagada</label>
                    @elseif($comision->estatus == 'Pendiente')
                        <label class="label label-warning">Pendiente</label>
                    @elseif($comision->estatus == 'Cancelado')
                        <label class="label label-danger">Cancelado</label>
                    @elseif($comision->estatus == 'Liberada')
                        <label class="label label-primary">Liberada</label>
                    @endif
                </td>
                <td style="width:10%; font-weight: bold" align="right" valign="middle">{{ $comision->monto }}</td>
                <td style="width:10%" align="center" title="Agregar comisión" data-tooltip="tooltip"><a class="btn btn-success btn-xs btn-flat btn-agregar-comision"><i class="fas fa-check"></i></a></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan ="1" hidden>&nbsp;</th>
                <th colspan ="6">&nbsp;</th>
                <th>Total: </th>
                <th style="font-weight: bold; text-align: right; font-size: 15px" align="right">{{ number_format($monto_pendiente,2) }}</th>
                <th colspan ="3">&nbsp;</th>
            </tr>
        </tfoot>
    </table>
</div>
@else
<h4>No hay comisiones pendientes por pagar</h4>
@endif