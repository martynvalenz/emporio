<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Monto Total: {{ number_format($total_filtrado, 2) }}</h3>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if(count($comisiones) > 0)
        {{$comisiones->render()}}
        <div class="table-responsive">
            <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px; color:white; background-color:#218CBF">
                    <tr>
                        <th hidden>ID</th>
                        <th>Usuario</th>
                        <th>Servicio</th>
                        <th data-tooltip="tooltip" title="Estatus de cobranza del servicio">Cobranza</th>
                        <th data-tooltip="tooltip" title="Tipo de comisión">Tipo</th>
                        <th>Porcentaje</th>
                        <th data-tooltip="tooltip" title="Monto de comisión">Comisión</th>
                        <th>Agregada</th>
                        <th>Liberada</th>
                        <th>Pagada</th>
                        <th>Estatus</th>
                        <th colspan="1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                    @foreach($comisiones as $key => $comision)
                    <tr id="comision-{{ $comision->id }}">
                        <td hidden>{{ $comision->id }}</td>
                        <td style="width:14%;" align="left">{{ $comision->iniciales }} - {{ $comision->nombre }} {{ $comision->apellido }}</td>
                        <td style="width:20%;" align="left" title="#{{ $comision->id_servicio }} - {{ $comision->clave }} - {{ $comision->servicio }} {{ $comision->tramite }}" data-tooltip="tooltip">{{ $comision->clave }} - {{ $comision->marca }} {{ $comision->clase }} | Cliente: {{ $comision->nombre_comercial }}</td>
                        <td style="width:5%;" align="center" valign="middle">
                            @if($comision->estatus_cobranza != 'Cancelado' && $comision->saldo > '0')
                                <label class="label label-warning">Pendiente</label>
                            @elseif($comision->estatus_cobranza != 'Cancelado' && $comision->saldo == '0')
                                <label class="label label-success">Pagado</label>
                            @elseif($comision->estatus_cobranza == 'Cancelado')
                                <label class="label label-danger">{{ $comision->estatus_cobranza }}</label>
                            @endif
                        </td>
                        <td style="width:5%;" align="center" valign="middle">
                            @if($comision->tipo_comision == 'Venta')
                                <label class="label label-success">Venta</label>
                            @elseif($comision->tipo_comision == 'Operativa')
                                <label class="label label-info">Operativa</label>
                            @elseif($comision->tipo_comision == 'Gestión')
                                <label class="label label-primary">Gestión</label>
                            @endif
                        </td>
                        <td style="width:7%;" align="center">% {{ number_format($comision->porcentaje_comision, 2) }}</td>
                        <td style="width:8%;" align="right" valign="middle">{{ number_format($comision->monto, 2) }}</td>
                        @if($comision->fecha_comision == null)
                            <td style="width:10%;" align="center" valign="middle"></td>
                        @else
                            <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_comision)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_comision)->format('d-m-Y') }}</td>
                        @endif
                        @if($comision->fecha_aplicada == null)
                            <td style="width:9%;" align="center" valign="middle"></td>
                        @else
                            <td style="width:9%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_aplicada)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_aplicada)->format('d-m-Y') }}</td>
                        @endif
                        @if($comision->fecha_pagado == null)
                            <td style="width:9%;" align="center" valign="middle"></td>
                        @else
                            <td style="width:9%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_pagado)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_pagado)->format('d-m-Y') }}</td>
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
                        <td style="width:5%">
                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-comision" onclick="Menu({{ $comision->id_servicio }}, {{ $comision->id }})"><i class="fas fa-money-bill-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan ="4">&nbsp;</th>
                        <th>Total: </th>
                        <th style="font-weight: bold; text-align: right; font-size: 15px" align="right">{{ number_format($total_filtrado, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        {{$comisiones->render()}}
        @else
        <h4>No se encontraron registros.</h4>
        @endif
    </div>
</div>