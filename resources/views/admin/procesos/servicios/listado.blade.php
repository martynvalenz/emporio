@if(count($servicios) > 0)
<div class="pagination-servicio">
    {{$servicios->render()}}
</div>

<div class="table-responsive">
    <table class="table headerfix table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr class="centered">
                <th>Fecha</th>
                <th hidden>Control</th>
                <th>Servicio</th>
                <th>Cliente</th>
                <th>Factura</th>
                <th>Recibo</th>
                <th>Precio</th>
                <th>Bitácora</th>
                <th>Resp</th>
                <th title="Estatus de cobranza del servicio" data-tooltip="tooltip">Cobranza</th>
                <th data-tooltip="tooltip" title="Fecha de término en la bitácora o presentación">Trámite</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list-servicio" name="list-servicio">
            @foreach($servicios as $key => $servicio)
            <tr id="listado-servicio-{{ $servicio->id }}">
                <td style="width:7%;"align="center" data-toggle="modal" title="{{ $servicio->id }}" data-tooltip="tooltip">
                    @if($servicio->fecha == '')
                        {{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}
                    @else
                        {{ Carbon\Carbon::parse($servicio->fecha)->format('d-m-Y') }}
                    @endif
                </td>
                <td hidden>{{ $servicio->id_control }}</td>
                <td style="width:13%;" valign="middle" align="left" title="{{ $servicio->clave }} - {{ $servicio->servicio }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->tramite }} {{ $servicio->marca }} {{ $servicio->clase }}</td>
                <td style="width:12%;" valign="middle" title="" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->nombre_comercial }}</td>
                <td style="width:5%;" align="center" valign="middle">
                    @if($servicio->facturado_terminado == 0)<span><a onclick="ServicioFactura({{ $servicio->id_cliente }}, {{ $servicio->id }}, {{ $servicio->facturado }}, {{ $servicio->costo }}, 'Factura', 'Control')" data-toggle="modal" data-target="#modal-pagar-factura" class="btn btn-link btn-xs"><i class="fas fa-plus" style="color:orange"></i></a></span>@endif
                    @foreach($facturas as $fact)
                        @if($fact->id_servicio == $servicio->id)
                           <a onclick="PagarFactura({{ $fact->id_factura }}, {{ $fact->porcentaje_iva }}, {{ $fact->folio_factura }}, {{ $servicio->id_cliente }}, 'Factura', 'Control', {{ $servicio->id }}, {{ $fact->con_iva }}, {{ $fact->pagado_terminado }})" data-target="#modal-pagar-factura" data-toggle="modal" @if($fact->pagado_terminado == 1) style="color: #49adad !important; font-weight: bold" @endif>{{ $fact->folio_factura }}</a>
                        @endif
                    @endforeach
                </td>
                <td style="width:5%;" align="center" valign="middle">
                    @if($servicio->facturado_terminado == 0)<span><a onclick="ServicioFactura({{ $servicio->id_cliente }}, {{ $servicio->id }}, {{ $servicio->facturado }}, {{ $servicio->costo }}, 'Recibo', 'Control')" data-toggle="modal" data-target="#modal-pagar-factura" class="btn btn-link btn-xs"><i class="fas fa-plus" style="color:orange"></i></a></span>@endif
                    @foreach($facturas as $fact)
                        @if($fact->id_servicio == $servicio->id)
                            <a onclick="PagarFactura({{ $fact->id_factura }}, {{ $fact->porcentaje_iva }}, {{ $fact->folio_recibo }}, {{ $servicio->id_cliente }}, 'Recibo', 'Control', {{ $servicio->id }}, {{ $fact->con_iva }}, {{ $fact->pagado_terminado }})" data-target="#modal-pagar-factura" data-toggle="modal" @if($fact->pagado_terminado == 1) style="color: #49adad !important; font-weight: bold" @endif>{{ $fact->folio_recibo }}</a>
                        @endif
                    @endforeach
                </td>
                <td style="width:8%;" valign="middle" align="right" title="Descuento: $ {{ $servicio->descuento }} | % {{ $servicio->porcentaje_descuento }}" data-tooltip="tooltip">{{ number_format($servicio->costo,2) }}</td>
                @if($servicio->mostrar_bitacora == 0)
                <td style="width:5%;" valign="middle" align="center" title="No se puede mostrar en bitácora" data-tooltip="tooltip"></td>
                @else
                <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->bitacora }}" data-tooltip="tooltip">
                    @if($servicio->mostrar_bitacora == 0)
                    
                    @else
                        {{ $servicio->clave_bit }}
                    @endif
                </td>
                @endif
                <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                <td style="width:5%;" align="center" valign="middle" data-tooltip="tooltip">
                    @if($servicio->estatus_registro == 'Cancelado')
                        <label class="label label-danger">{{ $servicio->estatus_registro }}</label>
                    @else
                        @if($servicio->saldo > '0')
                            <label class="label label-warning" title="Facturado: $ {{ number_format($servicio->facturado,2) }} | Cobrado: $ {{ number_format($servicio->cobrado,2) }} | Saldo: $ {{ number_format($servicio->saldo,2) }}" data-tooltip="tooltip">Pendiente</label>
                        @elseif($servicio->saldo == '0')
                            <label class="label label-success" style="font-style: bold" data-tooltip="tooltip" title="Pagado {{ Carbon\Carbon::parse($servicio->fecha_cobranza)->diffForHumans() }}">{{ Carbon\Carbon::parse($servicio->fecha_cobranza)->format('d-m-Y') }}</label>
                        @endif
                    @endif
                </td>
                @if($servicio->mostrar_bitacora == 0 && $servicio->estatus_registro == 'Pendiente')
                    <td align="center" style="width:5%;">
                        <label class="label" style="background-color: #ff6600">Sin Bitácora</label>
                    </td>
                @else
                    <td align="center" style="width:5%;">
                        @if($servicio->estatus_registro == 'Pendiente')
                            <label class="label label-warning">{{ $servicio->estatus_registro }}</label>
                        @elseif($servicio->estatus_registro == 'Terminado')
                            <label class="label label-success" title="Presentado {{ Carbon\Carbon::parse($servicio->fecha_registro)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha_registro)->format('d-m-Y') }}</label>
                        @elseif($servicio->estatus_registro == 'Cancelado')
                            <label class="label label-danger">{{ $servicio->estatus_registro }}</label>
                        @elseif($servicio->estatus_registro == 'No Registro')
                            <label class="label label-danger">{{ $servicio->estatus_registro }}</label>
                        @endif
                    </td>
                @endif
                <td style="width:15%;" align="center">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-grey btn-comentarios-modal" onclick="Comentarios({{ $servicio->id }}, {{ $servicio->id_estatus }})" data-target="#comentarios-modal" data-toggle="modal" data-tooltip="tooltip" data-token="{{ csrf_token() }}">
                            <i class="fas fa-comment"></i>
                        </a>
                        <a class="btn btn-sm btn-green" onclick="Menu({{ $servicio->id }})" data-tooltip="tooltip" data-toggle="modal" data-target="#menu"><i class="far fa-money-bill-alt"></i></a>
                        
                        <a onclick="Edit({{ $servicio->id }})" data-toggle="modal" data-target="#agregar-servicio" class="btn btn-sm btn-warning btn-flat" data-tooltip="tooltip">
                        <i class="fas fa-edit"></i>
                        </a>
                        @if($servicio->estatus_registro == 'Pendiente' || $servicio->estatus_registro == 'Terminado')
                            <a class="btn btn-sm btn-danger btn-flat" onclick="Cancelar({{ $servicio->id }})" data-tooltip="tooltip">
                                <i class="fas fa-times"></i>
                            </a>
                        @elseif($servicio->estatus_registro == 'Cancelado')
                            <a class="btn btn-sm btn-success btn-flat" onclick="Activar({{ $servicio->id }})" data-tooltip="tooltip">
                                <i class="fas fa-check"></i>
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pagination-servicio">
    {{$servicios->render()}}
</div>
@else
<h4>No se encontraron registros con el criterio de búsqueda.</h4>
@endif