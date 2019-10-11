@if(count($facturas) > 0)

<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display no-wrap cell-border" cellspacing="0" width="100%">
        <thead class="centered">
            <tr>
                <th hidden>Id</th>
                <th>Factura</th>
                <th>Recibo</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Saldo</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list-factura-ingreso" name="list-factura-ingreso">
            @foreach($facturas as $key => $factura)
            <tr id="factura-listado-ingreso-{{ $factura->id }}">
                <td hidden>{{ $factura->id }}</td>
                <td style="width: 10%" align="center">{{ $factura->folio_factura }}</td>
                <td style="width: 10%" align="center">{{ $factura->folio_recibo }}</td>
                <td style="width: 15%" align="center" title="{{ Carbon\Carbon::parse($factura->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                <td style="width:10%;" align="center" data-tooltip="tooltip" title="{{ $factura->nombre }} {{ $factura->apellido }}">{{ $factura->iniciales }}</td>
                <td style="width:10%;" valign="middle" align="right">{{ number_format($factura->subtotal,2) }}</td>
                <td style="width:10%;" valign="middle" align="right">{{ number_format($factura->iva,2) }}</td>
                <td style="width:15%;" valign="middle" align="right">{{ number_format($factura->total,2) }}</td>
                <td style="width:15%; font-weight: bold" valign="middle" align="right" contenteditable>{{ $factura->saldo }}</td>
                <td style="width:5%;" align="center">
                    <div class="checkbox checkbox-css checkbox_ingreso_div">
                        <input type="checkbox" class="checkbox_ingreso" id="facturas-ingreso-{{ $factura->id }}" onclick="PagarReciboFactura({{ $factura->id }})" @if($factura->id_det != '') checked value="1" @else unchecked value="0" @endif />
                        <label for="acturas-ingreso-{{ $factura->id }}"></label>
                    </div>
                    <input type="hidden"  @if($factura->id_det != '') checked value="1" @else unchecked value="0" @endif id="factura-ingrso-val-{{ $factura->id }}">
                    <!--<div class="checkbox checkbox-css checkbox_ingreso_checked">
                        <input type="checkbox" checked />
                        <label></label>
                    </div>-->
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan ="6">&nbsp;</th>
                <th>Pendiente: </th>
                <th style="font-weight: bold; text-align: right;" align="right" id="facturas_pendiente_ingresos">
                    @if($monto_pendiente == '') 0 @else {{ number_format($monto_pendiente,2) }} @endif</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
            <input type="hidden" id="facturas_pendiente_ingresos_val" @if($monto_pendiente == '') value="0" @else value="{{ $monto_pendiente }}" @endif>
        </tfoot>
    </table>
</div>
@else
<h4>No hay Facturas o Recibos pendientes</h4>
@endif