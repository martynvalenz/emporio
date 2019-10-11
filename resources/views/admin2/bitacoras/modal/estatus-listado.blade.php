@if(count($estatus) > 0)
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; background-color: #218CBF; color:white">
            <tr>
                <th>ID</th>
                <th>Bitácora</th>
                <th>Expediente</th>
                <th>Registro</th>
                <th>Estatus</th>
                <th>Inicio</th>
                <th>Comprobación</th>
                <th>Vencimiento</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($estatus as $estatus)
                <tr>
                    <td align="center">{{ $estatus->id }}</td>
                    <td align="center">{{ $estatus->clave }}</td>
                    <td>{{ $estatus->numero_expediente }}</td>
                    <td>{{ $estatus->numero_registro }}</td>
                    <td align="center"><label class="label" style="background-color: {{ $estatus->color }}; color: {{ $estatus->texto }}">{{ $estatus->estatus }}</label></td>
                    <td align="center">{{ $estatus->fecha_inicio }}</td>
                    <td align="center">
                        @if($estatus->comprobacion_uso == 1)
                            <i class="fas fa-check" style="color: green"></i>
                        @else
                            {{ $estatus->fecha_comprobacion_uso }}
                        @endif
                    </td>
                    <td align="center">
                        @if($estatus->fecha_vencimiento < $fecha_hoy)
                            <label class="label label-danger">VENCIDA</label>
                        @else
                            {{ $estatus->fecha_vencimiento }}
                        @endif
                    </td>
                    <td align="center">
                        <a class="btn btn-success btn-flat btn-xs" onclick="EnviarDatosEstatus({{ $estatus->id }}, {{ $estatus->id_bitacoras_estatus }}, '{{ $estatus->numero_expediente }}', '{{ $estatus->numero_registro }}', {{ $estatus->id_estatus }}, '{{ $estatus->fecha_inicio }}', '{{ $estatus->fecha_comprobacion_uso }}', '{{ $estatus->fecha_vencimiento }}')" title="Actualizar estatus" data-tooltip="tooltip">
                            <i class="fas fa-check"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <h4>No se encontraron registros.</h4>
@endif