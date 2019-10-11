@if(count($servicios) > 0)
{{$servicios->render()}}

<div class="table-responsive">
    <table class="table headerfix table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr class="centered">
                <th>Fecha</th>
                <th hidden>Control</th>
                <th>Servicio</th>
                <th>Cliente</th>
                <th>Precio</th>
                <th>Bitácora</th>
                <th>Resp</th>
                <th>Creado</th>
                <th>Cobranza</th>
                <th>Trámite</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list-servicio" name="list-servicio">
            @foreach($servicios as $key => $servicio)
            <tr id="listado-servicio-{{ $servicio->id }}">
                <td style="width:7%;" valign="middle" align="left" data-toggle="modal">{{ $servicio->fecha }}</td>
                <td hidden>{{ $servicio->id_control }}</td>
                <td style="width:13%;" valign="middle" align="left" title="{{ $servicio->clave }} - {{ $servicio->servicio }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->tramite }} {{ $servicio->marca }} {{ $servicio->clase }}</td>
                <td style="width:12%;" valign="middle" title="" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->nombre_comercial }}</td>
                <td style="width:8%;" valign="middle" align="right" title="Descuento: $ {{ $servicio->descuento }} | % {{ $servicio->porcentaje_descuento }}" data-tooltip="tooltip">{{ number_format($servicio->costo,2) }}</td>
                <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->bitacora }}" data-tooltip="tooltip">{{ $servicio->clave_bit }}</td>
                <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                <td style="width: 10%" align="center" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}</td>
                <td style="width:5%;" align="center" valign="middle" data-tooltip="tooltip">
                    @if($servicio->estatus_registro == 'Cancelado')
                        <label class="label label-danger">{{ $servicio->estatus_registro }}</label>
                    @else
                        @if($servicio->saldo > '0')
                            <label class="label label-warning" title="Facturado: $ {{ number_format($servicio->facturado,2) }} | Cobrado: $ {{ number_format($servicio->cobrado,2) }} | Saldo: $ {{ number_format($servicio->saldo,2) }}" data-tooltip="tooltip">Pendiente</label>
                        @elseif($servicio->saldo == '0')
                            <label class="label label-success" style="font-style: bold" data-tooltip="tooltip" title="Pagado">{{ Carbon\Carbon::parse($servicio->fecha_cobranza)->format('d-m-Y') }}</label>
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
                <td style="width:10%;" align="center">

                    <div class="btn-group">
                        <a class="btn btn-grey btn-sm" @if($servicio->conteo > 0) onclick="Detalles({{ $servicio->id }})" data-toggle="modal" data-target="#modal-detalles" @endif><span>@if($servicio->conteo == 0)<label for="" class="label label-danger">{{ $servicio->conteo }}</label> @else <label for="" class="label label-green">{{ $servicio->conteo }}</label> @endif</span> <i class="fas fa-list"></i></a>
                    </div>
                    <div class="btn-group">
                        @if($servicio->conteo > 0)
                            <a href="{{ route('check-list.edit', $servicio->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        @else
                            <a href="{{ route('check-list.vacio', $servicio->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$servicios->render()}}
@else
<h4>No se encontraron registros con el criterio de búsqueda.</h4>
@endif