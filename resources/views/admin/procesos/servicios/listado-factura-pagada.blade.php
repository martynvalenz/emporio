<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="listado-total-factura-pagado" class="table m-b-0 table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead style="background-color: #e28c36; color:white; width: 100% !important">
                    <tr>
                        <th>Id</th>
                        <th>Servicio</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Total</th>
                        <th>Pendiente</th>
                        <th>Monto</th>
                        <th hidden>Pediente val</th>
                        <th hidden>Costo</th>
                        <th hidden>Facturado</th>
                        <th hidden>Facturado IDDet</th>
                        <th hidden>IDdet</th>
                        <th hidden>Cobrado</th>
                        <th colspan ="1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($servicios  as $servicio)
                        <tr id="servicio-factura-pagado-{{ $servicio->id_det }}">
                            <td style="width:10%;">{{ $servicio->id }}</td>
                            <td style="width:35%;" data-tooltip="tooltip" title="{{ $servicio->clave }} - {{ $servicio->servicio }} | {{ $servicio->tramite }}">
                                {{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->clase }}
                            </td>
                            <td style="width:10%;" align="center" valign="middle" title="Agregado: {{ Carbon\Carbon::parse($servicio->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha)->format('d/m/Y') }}</td>
                            <td style="width: 5px" align="center" title="{{ $servicio->nombre }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                            <td style="width:10%;" align="right">{{ number_format($servicio->costo,2) }}</td>
                            <td style="width:10%;" align="right">{{ number_format($servicio->costo - $servicio->facturado,2) }}</td>
                            <td style="width:10%; font-weight: bold;" align="right" class="monto_facturado_pagado">{{ $servicio->monto }}</td>
                            <td hidden>{{ $servicio->costo - $servicio->facturado + $servicio->monto }}</td>
                            <td hidden>{{ $servicio->costo }}</td>
                            <td hidden>{{ $servicio->facturado }}</td>
                            <td hidden>@if($servicio->id_det != ''){{ $servicio->monto }}@else 0 @endif</td>
                            <td hidden>{{ $servicio->id_det }}</td>
                            <td hidden>{{ $servicio->cobrado }}</td>
                            <td style="width:10%;" align="center">
                                <a class="btn btn-danger btn-xs" @if($servicios_pendientes != '') onclick="EliminarServicioFactura({{ $servicio->id }}, {{ $servicio->id_det }})" @else onclick="InfoEditarFactura()" @endif><i class="fas fa-times"></i></a>
                                <div class="btn-group">
                                    {{-- <a class="btn btn-warning btn-xs" @if($servicios_pendientes != '') onclick="EditarServicioFactura({{ $servicio->id }}, {{ $servicio->id_det }})" @else onclick="InfoEditarFactura()" @endif><i class="fas fa-save"></i></a> --}}
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @if($servicios_pendientes == '')

                    @else
                        @foreach($servicios_pendientes as $servicio)
                            <tr id="servicio-factura-detalle-{{ $servicio->id }}">
                                <td style="width:10%;">{{ $servicio->id }}</td>
                                <td style="width:35%;" data-tooltip="tooltip" title="{{ $servicio->clave }} - {{ $servicio->servicio }} | {{ $servicio->tramite }}">
                                    {{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->clase }}
                                </td>
                                <td style="width:10%;" align="center" valign="middle" title="Agregado: {{ Carbon\Carbon::parse($servicio->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha)->format('d/m/Y') }}</td>
                                <td style="width: 5px" align="center" title="{{ $servicio->nombre }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                                <td style="width:10%;" align="right">{{ number_format($servicio->costo,2) }}</td>
                                <td style="width:10%;" align="right">{{ number_format($servicio->costo - $servicio->facturado,2) }}</td>
                                <td style="width:10%; font-weight: bold;" align="right" class="monto_facturado_pagado" contenteditable>{{ $servicio->costo - $servicio->facturado }}</td>
                                <td hidden>{{ $servicio->costo }}</td>
                                <td hidden>{{ $servicio->costo - $servicio->facturado }}</td>
                                <td hidden>{{ $servicio->facturado }}</td>
                                <td hidden>0</td>
                                <td hidden></td>
                                <td hidden>{{ $servicio->cobrado }}</td>
                                <td style="width:10%;" align="center">
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-xs" onclick="InsertarDetalle('{{ $servicio->id }}')"><i class="fas fa-plus"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <!--<tfoot>
                    <tr>
                        <th colspan ="5">&nbsp;</th>
                        <th>Subtotal: </th>
                        <th style="font-weight: bold; text-align: right;" align="right" id="factura_pagada_total">
                            </th>
                        <th colspan ="1">&nbsp;</th>
                    </tr>
                </tfoot>-->
            </table>
        </div>
    </div>
</div>