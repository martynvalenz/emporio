@if(count($servicios) > 0)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
        <h3>Servicios pendientes de facturar</h3>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-responsive" style="font-size: 16px">
                <thead style="background-color: #cc6600; color:white">
                    <tr>
                        <th>Id</th>
                        <th>Servicio</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Descuento</th>
                        <th>Total</th>
                        <th>Pendiente</th>
                        <th colspan ="1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios  as $servicio)
                        <tr id="servicio-{{ $servicio->id }}">
                            <td style="width:10%;">{{ $servicio->id }}</td>
                            <td style="width:30%;" data-tooltip="tooltip" title="{{ $servicio->clave }} - {{ $servicio->servicio }} | {{ $servicio->tramite }} -">
                                {{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->id_clase }}
                            </td>
                            <td style="width:10%;" align="center" valign="middle" title="Agregado: {{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->format('d/m/Y') }}</td>
                            <td style="width: 5px" align="center" title="{{ $servicio->nombre }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                            <td style="width:10%;" align="right">{{ number_format($servicio->descuento,2) }}</td>
                            <td style="width:10%;" align="right">{{ number_format($servicio->costo,2) }}</td>
                            <td style="width:15%; font-weight: bold;" align="right" contenteditable>{{ ($servicio->costo - $servicio->facturado) }}</td>
                            <td style="width:10%;" align="center">
                                <a class="btn btn-success btn-flat btn-xs"><i class="fas fa-check"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan ="5">&nbsp;</th>
                        <th>Pendiente: </th>
                        <th style="font-weight: bold; text-align: right;" align="right">{{ number_format($monto_pendiente,2) }}</th>
                        <th colspan ="1">&nbsp;</th>
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
