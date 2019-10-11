<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    @if(count($comisiones) > 0)
    <div class="table-responsive">
        <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
            <thead style="font-size: 15px">
                <tr>
                    <th hidden>Id</th>
                    <th>Usuario</th>
                    <th>Tipo</th>
                    <th>Agregada</th>
                    <th>Monto</th>
                    <th data-tooltip="tooltip" title="Fecha en que se libera la comisión por terminar su participación en la bitácora">Liberada</th>
                    <th>Pagada</th>
                    <th>Estatus?</th>
                    <th colspan ="1">&nbsp;</th>
                </tr>
            </thead>
            <tbody style="font-size: 15px" id="list" name="list">
                @foreach($comisiones as $key => $comision)
                <tr id="comision{{ $comision->id }}">
                    <th hidden>{{ $comision->id }}</th>
                    <td style="width:25%;" valign="left" title="{{ $comision->comentarios }}" data-tooltip="tooltip">{{ $comision->nombre }} {{ $comision->apellido }}</td>
                    <td style="width:15%;" valign="middle" title="{{ $comision->comentarios }}" data-tooltip="tooltip">{{ $comision->tipo_comision }}</td>
                    <td style="width:10%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($comision->created_at)->diffForHumans() }}">{{ Carbon\Carbon::parse($comision->created_at)->format('d/m/Y') }}</td>
                    <td style="width:10%;" valign="middle" align="right">{{ number_format($comision->monto,2) }}</td>
                    @if($comision->fecha_aplicada == null)
                    <td style="width:10%;" align="center" valign="middle"></td>
                    @else
                    <td style="width:10%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($comision->fecha_aplicada)->diffForHumans() }}">{{ Carbon\Carbon::parse($comision->fecha_aplicada)->format('d/m/Y') }}</td>
                    @endif
                    @if($comision->fecha_pagado == null)
                    <td style="width:10%;" align="center" valign="middle"></td>
                    @else
                    <td style="width:10%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($comision->fecha_pagado)->diffForHumans() }}">{{ Carbon\Carbon::parse($comision->fecha_pagado)->format('d/m/Y') }}</td>
                    @endif
                    <td style="width:10%;" align="center" valign="middle">
                        @if($comision->estatus == 'Pagado')
                        <label class="label label-success">Pagado</label>
                        @elseif($comision->estatus == 'Pendiente')
                        <label class="label label-warning">Pendiente</label>
                        @elseif($comision->estatus == 'Cancelado')
                        <label class="label label-danger">Cancelado</label>
                        @elseif($comision->estatus == 'Liberada')
                        <label class="label label-primary">Liberada</label>
                        @else
                        <label></label>
                        @endif
                    </td>
                    <td style="width:10%;" align="center">
                        @if($comision->estatus == 'Pagado')
                            <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede Editar una comisión ya Pagada, primero debe Cancelar el pago en el módulo de Egresos" disabled>
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede cancelar una comisión Pagada, debe cancelar primero el pago en el módulo de Egresos ." disabled>
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        @elseif($comision->estatus == 'Cancelado')
                            <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="No se puede Editar una comisión ya Cancelada, primero debe Cancelar el pago en el módulo de Egresos" disabled>
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-default" data-tooltip="tooltip" title="La comisión ya está Cancelada" disabled>
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        @else
                            <a class="btn btn-xs btn-warning" onclick="EditarComision({{ $comision->id }})" data-tooltip="tooltip" title="Editar comision: {{ $comision->tipo_comision }} de {{ $comision->nombre }} {{ $comision->apellido }}. #{{ $comision->id }}">
                            <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a class="btn btn-xs btn-danger" onclick="CancelarComision({{ $comision->id }}, {{ $comision->id_servicio }}, {{ $comision->monto }}, '{{ $comision->tipo_comision }}', '{{ $comision->comision_venta_restante }}', '{{ $comision->comision_gestion_restante }}', '{{ $comision->comision_operativa_restante }}')" data-tooltip="tooltip" title="{{ $comision->id }}, {{ $comision->id_servicio }}, {{ $comision->monto }}, '{{ $comision->tipo_comision }}', '{{ $comision->comision_venta_restante }}', '{{ $comision->comision_gestion_restante }}', '{{ $comision->comision_operativa_restante }}'" >
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <h4>No hay comisiones agregadas al servicio.</h4>
    @endif
</div>