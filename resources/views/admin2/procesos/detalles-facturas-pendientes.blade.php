<div class="row">
    @if(count($facturas_pendientes) > 0)
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
                            <th colspan ="1">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($facturas_pendientes  as $key => $factura)
                            <tr id="factura-{{ $factura->id }}">
                                <td hidden>{{ $factura->id }}</td>
                                <td style="width:10%;" valign="middle" align="center" data-tooltip="tooltip">
                                    {{ $factura->folio_factura }}
                                </td>
                                <td style="width:10%;" valign="middle" align="center" data-tooltip="tooltip">
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
                                <td style="width:10%;" valign="middle" align="right">{{ number_format($factura->saldo,2) }}</td>
                                <td style="width:8%;" align="center">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan ="1" hidden>&nbsp;</th>
                            <th colspan ="3">&nbsp;</th>
                            <th>Total: </th>
                            <th style="font-weight: bold; text-align: right;" align="right">{{ number_format($monto_pendiente,2) }}</th>
                            <th colspan ="3">&nbsp;</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @else
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
            <h3>No hay Facturas o Recibos pendientes por cobrar</h3>
        </div>
    @endif
</div>