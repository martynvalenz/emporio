<tr id="catalogo-{{ $catalogo->id }}">
    <td style="width:10%;" valign="left" title="Detalles" data-tooltip="tooltip" onclick="Detalles({{ $catalogo->id }})" data-toggle="modal" data-target="#detalles-modal">{{ $catalogo->clave }}</td>
    <td style="width:25%;" valign="middle" title="{{ $catalogo->comentarios }}" data-tooltip="tooltip" onclick="Detalles({{ $catalogo->id }})" data-toggle="modal" data-target="#detalles-modal">{{ $catalogo->servicio }}</td>
    <td style="width:14%;" valign="middle">@if($catalogo->id_categoria_servicios == null)@else{{ $catalogo->categoria }}@endif
    </td>
    <td style="width:15%;" valign="middle">@if($catalogo->id_categoria_bitacora == null)@else{{ $catalogo->bitacora }}@endif
    </td>
    <td style="width:5%;" valign="middle" align="center">{{ $catalogo->moneda }}</td>
    <td style="width:11%;" align="right" valign="middle" title="{{ $catalogo->costo_servicio }}" data-tooltip="tooltip">
        @if($catalogo->concepto == 'Neto')
            $ {{ number_format($catalogo->costo,2) }}
        @elseif($catalogo->concepto == 'Porcentaje')
            % {{ number_format($catalogo->costo,2) }}
        @elseif($catalogo->concepto == 'por Proyecto')
            <label class="label label-purple">{{ $catalogo->concepto }}</label>
        @endif
    </td>
    <td style="width:5%;" align="center" valign="middle">
        @if($catalogo->estatus == 1)
            <label class="label label-success">Activo</label>
        @elseif($catalogo->estatus == 0)
            <label class="label label-danger">Inactivo</label>
        @endif
    </td>
    <td hidden>{{ $catalogo->id }}</td>
    <td style="width:15%;" align="center">
        <div class="btn-group">
            <a href="{{ route('servicios.edit', $catalogo->id) }}" class="btn btn-warning btn-sm" title="Editar servicio: {{ $catalogo->clave }}" data-tooltip="tooltip"><i class="fas fa-edit"></i></a>
            <a href="{{ route('servicios.requisitos',$catalogo->id) }}" title="Editar proceso de: {{ $catalogo->clave }}" class="btn btn-grey btn-sm"><span>@if($catalogo->requisitos == 0)<label for="" class="label label-danger">{{ $catalogo->requisitos }}</label> @else <label for="" class="label label-green">{{ $catalogo->requisitos }}</label> @endif</span> <i class="fas fa-list"></i></a>
            @if($catalogo->estatus == 1)
                <a class="btn btn-danger btn-sm" onclick="Inactivar({{ $catalogo->id }})" title="Inactivar"><i class="fas fa-times"></i></a>
            @elseif($catalogo->estatus == 0)
                <a class="btn btn-success btn-sm" onclick="Activar({{ $catalogo->id }})" title="Activar"><i class="fas fa-check"></i></a>
            @endif
        </div>
    </td>
</tr>