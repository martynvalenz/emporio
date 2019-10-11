<div class="row">
    @if(count($facturas_disponibles) > 0)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
            <h3>Facturas y recibos pendientes</h3>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-responsive" style="font-size: 16px">
                    <thead style="background-color: #cc6600; color:white">
                        <tr>
                            <th hidden>Id</th>
                            <th>Factura</th>
                            <th>Recibo</th>
                            <th>Razón Social | RFC</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Pagado</th>
                            <th>Pendiente</th>
                            <th hidden>Max</th>
                            <th hidden>Porcentaje IVA</th>
                            <th hidden>Saldo</th>
                            <th hidden>Pagado fact</th>
                            <th hidden>Total fact</th>
                            <th colspan ="1">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($facturas_disponibles  as $key => $factura)
                            <tr id="factura-{{ $factura->id }}">
                                <td hidden>{{ $factura->id }}</td>
                                <td style="width:8%;" valign="middle" align="center" data-tooltip="tooltip">
                                    {{ $factura->folio_factura }}
                                </td>
                                <td style="width:8%;" valign="middle" align="center" data-tooltip="tooltip">
                                    {{ $factura->folio_recibo }}
                                </td>
                                <td style="width:30%;" valign="middle" align="left">
                                    @if($factura->id_razon_social == null)
                                    @else
                                        {{ $factura->razon_social }} - {{ $factura->rfc }}
                                    @endif
                                </td>
                                <td style="width:10%;" align="center" valign="middle" title="Agregado {{ Carbon\Carbon::parse($factura->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                                <td style="width:12%;" valign="middle" align="right" data-tooltip="tooltip" title="Subtotal: {{ number_format($factura->subtotal,2) }} | IVA: {{ number_format($factura->iva,2) }}">{{ number_format($factura->total,2) }}</td>
                                <td style="width:10%;" valign="middle" align="right">{{ number_format($factura->pagado,2) }}</td>
                                <td style="width:14%; font-weight: bold" contenteditable valign="middle" align="right">
                                    @if($factura->total <= $cobro->restante)
                                        {{ $factura->saldo }}
                                    @elseif($factura->total > $cobro->restante)
                                        {{ $cobro->restante }}
                                    @endif
                                </td>
                                <td hidden>
                                    @if($factura->total <= $cobro->restante)
                                        {{ $factura->saldo }}
                                    @elseif($factura->total > $cobro->restante)
                                        {{ $cobro->restante }}
                                    @endif
                                </td>
                                <td hidden>{{ $factura->porcentaje_iva }}</td>
                                <td hidden>{{ $factura->saldo }}</td>
                                <td hidden>{{ $factura->pagado }}</td>
                                <td hidden>{{ $factura->total }}</td>
                                <td style="width:8%;" align="center">
                                    <a 
                                        class="btn btn-success btn-xs btn-insertar-factura-recibo" 
                                        title="Agregar factura o recibo al cobro" 
                                        data-tooltip="tooltip"
                                        id="{{ $factura->id }}"
                                        data-token="{{ csrf_token() }}">
                                    <i class="glyphicon glyphicon-ok"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan ="1" hidden>&nbsp;</th>
                            <th colspan ="3">&nbsp;</th>
                            <th>Total: </th>
                            <th style="font-weight: bold; text-align: right;" align="right">{{ number_format($monto_disponible,2) }}</th>
                            <th colspan ="3">&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @else
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
            <h3>No hay facturas ni recibos pendientes</h3>
        </div>
    @endif
</div>
<div class="row">
    @if(count($detalles_cobranza) > 0)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Facturas y Recibos agregados al cobro</h3>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-responsive" style="font-size: 16px">
                    <thead style="background-color: #008CC2; color:white">
                        <tr>
                            <th hidden>Id</th>
                            <th>Factura</th>
                            <th>Recibo</th>
                            <th>Razón Social | RFC</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Pagado</th>
                            <th>Saldo</th>
                            <th colspan ="1">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detalles_cobranza  as $key => $detalle)
                        <tr id="detalle{{ $detalle->id }}">
                            <td hidden>{{ $detalle->id }}</td>
                            <td style="width:8%;" valign="middle" align="center" data-tooltip="tooltip">
                                {{ $detalle->folio_factura }}
                            </td>
                            <td style="width:8%;" valign="middle" align="center" data-tooltip="tooltip">
                                {{ $detalle->folio_recibo }}
                            </td>
                            <td style="width:32%;" valign="middle" align="left">
                                @if($detalle->id_razon_social == null)
                                @else
                                    {{ $detalle->razon_social }} - {{ $detalle->rfc }}
                                @endif
                            </td> 
                            <td style="width:10%;" align="center" valign="middle" title="Agregado {{ Carbon\Carbon::parse($detalle->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($detalle->fecha)->format('d/m/Y') }}</td>
                            <td style="width:10%;" valign="middle" align="right">{{ number_format($detalle->total,2) }}</td>
                            <td style="width:10%;" valign="middle" align="right">{{ number_format($detalle->monto,2) }}</td>
                            <td style="width:10%;" valign="middle" align="right">{{ number_format($detalle->saldo,2) }}</td>
                            <td style="width:12%;" align="center">
                                <a 
                                    class="btn btn-info btn-xs btn-detalle" 
                                    title="Ver detalles de detalle {{ $detalle->id }}" 
                                    data-tooltip="tooltip" 
                                    data-toggle="modal" 
                                    data-target="#modal-detalles" 
                                    data-id="{{ $detalle->id }}"
                                    data-path="{{ route('facturas.detalles') }}"
                                    data-token="{{ csrf_token() }}">
                                <i class="glyphicon glyphicon-th-list"></i>
                                </a>
                                <a 
                                    class="btn btn-warning btn-xs" 
                                    title="Editar factura o recibo" 
                                    data-tooltip="tooltip">
                                <i class="glyphicon glyphicon-edit"></i>
                                </a>
                                <a class="btn btn-xs btn-danger" title="Eliminar detalle/recibo" data-tooltip="tooltip"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>No hay Facturas o Recibos agregados al cobro</h3>
        </div>
    @endif
</div>




























