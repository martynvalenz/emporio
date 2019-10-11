@if(count($servicios) == 0)
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <h4>No hay servicios pendientes para este cliente</h4>
</div>
@else
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <h4>Listado de servicios</h4>
</div>
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="table-responsive">
        <table class="table m-b-0 table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead style="background-color: #e28c36; color:white; width: 100% !important">
                <tr>
                    <th>Id</th>
                    <th>Servicio</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Total</th>
                    <th>Facturado</th>
                    <th>Pendiente</th>
                    <th hidden>Pediente val</th>
                    <th hidden>Costo</th>
                    <th hidden>Facturado</th>
                    <th hidden>Facturado IDDet</th>
                    <th hidden>IDdet</th>
                    <th colspan ="1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                
                    @foreach($servicios  as $servicio)
                        <tr id="servicio-facturar-{{ $servicio->id }}">
                            <td style="width:10%;">{{ $servicio->id }}</td>
                            <td style="width:30%;" data-tooltip="tooltip" title="{{ $servicio->clave }} - {{ $servicio->servicio }} | {{ $servicio->tramite }}">
                                {{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->clase }}
                            </td>
                            <td style="width:10%;" align="center" valign="middle" title="Agregado: {{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->format('d/m/Y') }}</td>
                            <td style="width: 5px" align="center" title="{{ $servicio->nombre }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                            <td style="width:10%;" align="right">{{ number_format($servicio->costo,2) }}</td>
                            <td style="width:10%;" align="right">{{ number_format($servicio->monto,2) }}</td>
                            <td style="width:15%; font-weight: bold;" align="right" contenteditable title="Monto máximo: {{ number_format($servicio->costo - $servicio->facturado, 2) }}" data-tooltip="tooltip">{{ $servicio->costo - $servicio->facturado }}</td>
                            <td hidden>{{ $servicio->costo - $servicio->facturado }}</td>
                            <td hidden>{{ $servicio->costo }}</td>
                            <td hidden>{{ $servicio->facturado }}</td>
                            <td hidden>@if($servicio->id_det != ''){{ $servicio->monto }}@else 0 @endif</td>
                            <td hidden>{{ $servicio->id_det }}</td>
                            <td style="width:10%;" align="center">
                                <div class="checkbox checkbox-css checkbox_servicio_div">
                                    <input type="checkbox" class="checkbox_servicio" id="servicio-pendiente-{{ $servicio->id }}" onclick="FacturarServicio({{ $servicio->id }})" @if($servicio->id_det != '') checked value="1" @else unchecked value="0" @endif />
                                    <label for="servicio-pendiente-{{ $servicio->id }}"></label>
                                </div>
                                <input type="hidden"  @if($servicio->id_det != '') checked value="1" @else unchecked value="0" @endif id="servicio-pendiente-val-{{ $servicio->id }}">
                                <div class="checkbox checkbox-css checkbox_servicio_pagado">
                                    <input type="checkbox" checked />
                                    <label></label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                
            </tbody>
            <tfoot>
                <tr>
                    <th colspan ="5">&nbsp;</th>
                    <th>Pendiente: </th>
                    <th style="font-weight: bold; text-align: right;" align="right" id="facturado_pendiente">
                        @if($monto_pendiente == '') 0 @else {{ number_format($monto_pendiente->suma_total,2) }} @endif</th>
                    <th colspan ="1">&nbsp;</th>
                </tr>
                <input type="hidden" id="facturado_pendiente_val" @if($monto_pendiente == '') value="0" @else value="{{ $monto_pendiente->suma_total }}" @endif>
            </tfoot>
        </table>
    </div>
</div>
@endif
