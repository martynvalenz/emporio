@if(count($servicios) > 0)
{{-- {{$servicios->render()}} --}}

<div class="table-responsive">
    <table class="table headerfix table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr class="centered">
                <th>#</th>
                <th>Fecha</th>
                <th>Servicio</th>
                <th>Cliente</th>
                <th>Costo</th>
                <th>Resp</th>
                <th>Avance</th>
                <th>Cobranza</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list-servicio" name="list-servicio">
            @foreach($servicios as $key => $servicio)
            <tr id="listado-servicio-{{ $servicio->id }}">
                <td style="width: 7%">{{ $servicio->id }}</td>
                <td style="width: 10%; "align="center">
                    @if($servicio->fecha == '')
                        {{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}
                    @else
                        {{ Carbon\Carbon::parse($servicio->fecha)->format('d-m-Y') }}
                    @endif
                </td>
                <td style="width: 33%">{{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->clase }} {{ $servicio->tramite }}</td>
                <td style="width: 15%">{{ $servicio->nombre_comercial }}</td>
                <td style="width: 10%" align="right">{{ number_format($servicio->costo,2) }}</td>
                <td style="width: 10%" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                <td style="width: 5%" align="center">
                    @if($servicio->avance_parcial == null)
                        <label for="" class="label label-success">100%</label>
                    @elseif($servicio->avance == 0 && $servicio->avance_total > 0)
                        <label for="" class="label label-danger">0%</label>
                    @elseif($servicio->avance_parcial > 0 && $servicio->avance_parcial <= 60)
                        <label for="" class="label label-danger">{{ number_format($servicio->avance_parcial, 2) }}%</label>
                    @elseif($servicio->avance_parcial > 60 && $servicio->avance_parcial <= 89)
                        <label for="" class="label label-warning">{{ number_format($servicio->avance_parcial, 2) }}%</label>
                    @elseif($servicio->avance_parcial > 89 && $servicio->avance_parcial < 100)
                        <label for="" class="label label-lime">{{ number_format($servicio->avance_parcial, 2) }}%</label>
                    @elseif($servicio->avance_parcial >= 100)
                        <label for="" class="label label-success">{{ number_format($servicio->avance_parcial, 2) }}%</label>
                    @endif
                </td>
                <td style="width: 10%" align="center">
                    @if($servicio->estatus_cobranza == 'Pagado')
                        <label class="label label-success">Pagado</label>
                    @elseif($servicio->estatus_cobranza == 'Pendiente')
                        <label class="label label-warning">Pendiente</label>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- {{$servicios->render()}} --}}
@else
<h4>No se encontraron registros con el criterio de búsqueda.</h4>
@endif