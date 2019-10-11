@if(count($servicios) > 0)
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Monto Pendiente $: <span id="monto_total_pendiente">{{ number_format($monto_total, 2) }}</span></h3>
        <input type="hidden" id="monto_total_pendiente_val" value="{{ $monto_total }}">
    </div>
</div>
<br>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{$servicios->render()}}
        <div class="table-responsive">
            <table class="table headerfix table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%" id="listado-honorarios-pendientes">
                <thead style="font-size: 15px; color:white; background-color:#218CBF">
                    <tr class="centered">
                        <th>Fecha</th>
                        <th hidden>ID</th>
                        <th>Servicio</th>
                        <th>Cliente</th>
                        <th>Resp</th>
                        <th title="Estatus de cobranza del servicio" data-tooltip="tooltip">Estatus</th>
                        <th>Monto a pagar</th>
                        <th colspan ="1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px" id="list-servicio" name="list-servicio">
                    @foreach($servicios as $key => $servicio)
                    <tr id="listado-pendiente-{{ $servicio->id }}">
                        <td style="width:10%;"align="center" title="{{ $servicio->id }}" data-tooltip="tooltip">
                            @if($servicio->fecha == '')
                                {{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}
                            @else
                                {{ Carbon\Carbon::parse($servicio->fecha)->format('d-m-Y') }}
                            @endif
                        </td>
                        <td hidden>{{ $servicio->id }}</td>
                        <td style="width:40%;" valign="middle" align="left" title="{{ $servicio->clave }} - {{ $servicio->servicio }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->tramite }} {{ $servicio->marca }} {{ $servicio->clase }}</td>
                        <td style="width:20%;">{{ $servicio->nombre_comercial }}</td>
                        <td style="width:10%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                        <td style="width:8%;" align="center" valign="middle" data-tooltip="tooltip" title="Cobrado: {{ number_format($servicio->cobrado, 2) }} | Saldo: {{ number_format($servicio->saldo, 2) }}">
                            @if($servicio->estatus_cobranza == 'Pendiente')
                                <label class="label label-warning">{{ $servicio->estatus_cobranza }}</label>
                            @elseif($servicio->estatus_cobranza =='Pagado')
                                <label class="label label-success">{{ $servicio->estatus_cobranza }}</label>
                            @endif
                        </td>
                        <td style="width:10%;" align="right"><b>{{ number_format($servicio->costo_servicio, 2) }}</b></td>
                        <td style="width:7%;" align="center">
                            @if($servicio->costo_servicio <= $servicio->cobrado)
                                <a class="btn btn-success btn-sm" onclick="AgregarServicio({{ $servicio->id }}, {{ $servicio->costo_servicio }})"><i class="fas fa-plus"></i></a>
                            @elseif($servicio->costo_servicio > $servicio->cobrado)
                                <a class="btn btn-grey btn-sm" disabled title="No se puede seleccionar el servicio debido a que el cobro no es mayor al costo de honorarios." data-tooltip="tooltip"><i class="fas fa-plus"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$servicios->render()}}
    </div>
</div>

@else
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4>No hay servicios pendientes para el pago de honorarios.</h4>
    </div>
</div>
@endif