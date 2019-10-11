<tr id="sub-{{ $sub->id }}">
    <td style="width:20%;" valign="left">{{ $sub->subcategoria }}</td>
    <td style="width:15%;" valign="middle">{{ $sub->bitacora }}</td>
    <td style="width:8%;" align="middle">
        @if($sub->renovacion == 1)
            <label for="" class="label label-success">SI</label>
        @else
            <label for="" class="label label-danger">NO</label>
        @endif
    </td>
    <td style="width: 10%" align="middle">
        @if($sub->comprobacion_uso == 0)
            <b style="font-weight: bold">N/A</b>
        @else
            {{ number_format($sub->comprobacion_uso / 364, 0) }} Año/s
        @endif
    </td>
    <td style="width: 10%" align="middle">
        @if($sub->recordatorio == 0)
            <b style="font-weight: bold">N/A</b>
        @else
            {{ number_format(($sub->vencimiento / 30.4) - ($sub->recordatorio / 30.4), 0) }} Mes/es
        @endif
    </td>
    <td style="width: 10%" align="middle">
        @if($sub->vencimiento == 0)
            <b style="font-weight: bold">N/A</b>
        @else
            {{ number_format($sub->vencimiento / 364, 0) }} Año/s
        @endif
    </td>
    <td style="width: 8%" align="middle">
        {{ number_format($sub->conteo, 0) }}
    </td>
    <td style="width:7%;" align="center" valign="middle">
        @if($sub->estatus == 1)
            <label class="label label-success">Activo</label>
        @elseif($sub->estatus == 0)
            <label class="label label-danger">Inactivo</label>
        @endif
    </td>
    <td hidden>{{ $sub->id }}</td>
    <td style="width:12%;" align="center">
        <div class="btn-group">
            <a class="btn btn-warning btn-sm" title="Editar subcategoría: {{ $sub->subcategoria }}" data-tooltip="tooltip" data-toggle="modal" data-target="#modal-subcategoria" onclick="Edit({{ $sub->id }})"><i class="fas fa-edit"></i></a>
            @if($sub->estatus == 1)
                <a class="btn btn-danger btn-sm" onclick="Inactivar({{ $sub->id }})" title="Inactivar" data-tooltip="tooltip"><i class="fas fa-times"></i></a>
            @elseif($sub->estatus == 0)
                <a class="btn btn-success btn-sm" onclick="Activar({{ $sub->id }})" title="Activar" data-tooltip="tooltip"><i class="fas fa-check"></i></a>
            @endif
        </div>
    </td>
</tr>