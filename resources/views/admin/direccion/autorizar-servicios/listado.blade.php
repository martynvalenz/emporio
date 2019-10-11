@if(count($servicios) > 0)
    {{$servicios->render()}}

<div class="table-responsive">
    <table class="table headerfix table-striped table-bordered table-condensed table-hover display no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr class="centered">
                <th>#</th>
                <th hidden>Control</th>
                <th>Servicio</th>
                <th>Cliente</th>
                <th>Precio</th>
                <th>Bitácora</th>
                <th>Resp</th>
                <th>Agregado</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($servicios as $key => $servicio)
            <tr id="servicio-{{ $servicio->id }}">
                <td style="width:10%;" valign="middle" align="left" data-toggle="modal">{{ $servicio->id }}</td>
                <td hidden>{{ $servicio->id_control }}</td>
                <td style="width:20%;" valign="middle" align="left" title="{{ $servicio->clave }} - {{ $servicio->servicio }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->tramite }} {{ $servicio->marca }} {{ $servicio->clase }}</td>
                <td style="width:15%;" valign="middle" title="" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->nombre_comercial }}</td>
                <td style="width:10%;" valign="middle" align="right" title="Descuento: $ {{ $servicio->descuento }} | % {{ $servicio->porcentaje_descuento }}" data-tooltip="tooltip">{{ number_format($servicio->costo,2) }}</td>
                <td style="width:10%;" valign="middle" align="center" title="{{ $servicio->bitacora }}" data-tooltip="tooltip">{{ $servicio->clave_bit }}</td>
                <td style="width:10%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                <td style="width: 15%" align="center" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">
                    {{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}
                </td>
                <td style="width:10%;" align="center">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-success" onclick="MostrarBitacora({{ $servicio->id }})" data-tooltip="tooltip" title="Mostrar en Bitácora">
                            <i class="fas fa-check"></i>
                        </a>
                        <a class="btn btn-sm btn-danger" onclick="Cancelar({{ $servicio->id }})" data-tooltip="tooltip" title="Cancelar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
                            <i class="fas fa-times"></i>
                        </a>
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