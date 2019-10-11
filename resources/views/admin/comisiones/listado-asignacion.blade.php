<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if(count($servicios) > 0)
        <div class="pagination-asignacion">
            {{$servicios->render()}}
        </div>
        
        <div class="table-responsive">
            <table id="example2" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px; color:white; background-color:#218CBF">
                    <tr>
                        <th hidden>ID</th>
                        <th>Fecha</th>
                        <th>Clave</th>
                        <th>Servicio</th>
                        <th>Cliente</th>
                        <th data-tooltip="tooltip" title="Estatus de cobranza del servicio">Cobranza</th>
                        <th title="Comisión restante de venta" data-tooltip="tooltip">Venta</th>
                        <th title="Comisión restante Operativa" data-tooltip="tooltip">Operativa</th>
                        <th title="Comisión restante de Gestión" data-tooltip="tooltip">Gestión</th>
                        <th colspan="1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                    @foreach($servicios as $key => $servicio)
                    <tr id="listado-asignacion-{{ $servicio->id }}">
                        <td hidden>{{ $servicio->id }}</td>
                        <td style="width:10%;" align="center" title="{{ $servicio->id }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha)->format('d-m-Y') }}</td>
                        <td style="width:10%;" align="left">{{ $servicio->clave }}</td>
                        <td style="width:28%;">{{ $servicio->tramite }} @if($servicio->tramite != '')-@endif {{ $servicio->marca }} {{ $servicio->clase }}</td>
                        <td style="width:15%;">{{ $servicio->nombre_comercial }}</td>
                        <td style="width:10%;" align="center" valign="middle">
                            @if($servicio->estatus_cobranza == 'Pendiente')
                                <label class="label label-warning">Pendiente</label>
                            @elseif($servicio->estatus_cobranza == 'Pagado')
                                <label class="label label-success">Pagado</label>
                            @endif
                        </td>
                        <td style="width: 7%" align="right">
                            @if($servicio->comision_venta_restante > 0 && $servicio->aplica_comision_venta == 1)
                                {{ number_format($servicio->comision_venta_restante, 0) }}
                            @else
                                <span style="color: #b2bfcd">0.00</span>
                            @endif
                        </td>
                        <td style="width: 7%" align="right">
                            @if($servicio->comision_operativa_restante > 0 && $servicio->aplica_comision_operativa == 1)
                                {{ number_format($servicio->comision_operativa_restante, 0) }}
                            @else
                                <span style="color: #b2bfcd">0.00</span>
                            @endif
                        </td>
                        <td style="width: 7%" align="right">
                            @if($servicio->comision_gestion_restante > 0 && $servicio->aplica_comision_gestion == 1)
                                {{ number_format($servicio->comision_gestion_restante, 0) }}
                            @else
                                <span style="color: #b2bfcd">0.00</span>
                            @endif
                        </td>
                        <td style="width: 5%" align="center">
                            <a class="btn btn-success" data-toggle="modal" data-target="#modal-comision" onclick="Menu({{ $servicio->id }}, 0)"><i class="fas fa-money-bill-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </tfoot>
            </table>
        </div>
        <div class="pagination-asignacion">
            {{$servicios->render()}}
        </div>
        @else
            <h4>No se encontraron registros.</h4>
        @endif
    </div>
</div>
