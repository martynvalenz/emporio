@if(count($servicios) > 0)
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Monto Total: <span id="monto_total"></span></h3>
        <input type="hidden" id="monto_total_val">
    </div>
</div>
<br>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table headerfix table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%" id="listado-honorarios">
                <thead style="font-size: 15px; color:white; background-color:#218CBF">
                    <tr class="centered">
                        <th>Fecha</th>
                        <th hidden>ID</th>
                        <th>Servicio</th>
                        <th>Cliente</th>
                        <th>Resp</th>
                        <th title="Estatus de cobranza del servicio" data-tooltip="tooltip">Estatus</th>
                        <th>Monto a pagar</th>
                        <th hidden>Monto</th>
                        <th colspan ="1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px" id="list-servicio" name="list-servicio">
                    @foreach($servicios as $key => $servicio)
                    <tr id="listado-{{ $servicio->id }}">
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
                        <td style="width:8%;" align="center" valign="middle" data-tooltip="tooltip">
                            @if($servicio->estatus_cobranza == 'Pendiente')
                                <label class="label label-warning">{{ $servicio->estatus_cobranza }}</label>
                            @elseif($servicio->estatus_cobranza =='Pagado')
                                <label class="label label-success">{{ $servicio->estatus_cobranza }}</label>
                            @endif
                        </td>
                        <td style="width:10%;" align="right"><b>{{ number_format($servicio->costo_servicio, 2) }}</b></td>
                        <td hidden class="honorarios_monto">{{ $servicio->costo_servicio }}</td>
                        <td style="width:7%;" align="center">
                            <a class="btn btn-danger btn-sm" onclick="QuitarServicio({{ $servicio->id }}, {{ $servicio->costo_servicio }})"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@else
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4>No hay servicios seleccionados para el pago de honorarios.</h4>
    </div>
</div>
@endif