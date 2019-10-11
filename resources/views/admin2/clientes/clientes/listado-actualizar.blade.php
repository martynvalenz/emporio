<tr id="cliente-{{ $cliente->id }}">
    <td style="width:10%;" valign="left">CLI-{{ $cliente->id }}</td>
    <td style="width:30%;" valign="middle">{{ $cliente->nombre_comercial }}</td>
    <td style="width:15%;" valign="middle">{{ $cliente->estrategia }}</td>
    <td style="width:5%;" align="center" valign="middle" title="{{ $cliente->nombre }} {{ $cliente->apellido }}">{{ $cliente->iniciales }}</td>
    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($cliente->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}</td>
    <td style="width:5%;" align="center" valign="middle" title="Detalles de {{ $cliente->nombre_comercial }}">
        @if($cliente->estatus == 1)
        <label class="label label-success">Activo</label>
        @elseif($cliente->estatus == 0)
        <label class="label label-danger">Inactivo</label>
        @endif
    </td>
    <td style="width:25%;" align="center">
        <a title="Razones sociales" class="btn btn-success btn-xs" onclick="Razones({{ $cliente->id }}, '{{ $cliente->nombre_comercial }}')" data-tooltip="tooltip" data-toggle="modal" data-target="#modal-razones">
            <i class="glyphicon glyphicon-th-list"></i>
        </a>

        <a title="Marcas, obras, slogan, etc." class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-marcas" data-tooltip="tooltip" onclick="Marcas({{ $cliente->id }}, '{{ $cliente->nombre_comercial }}')">
            <i class="far fa-copyright"></i>
        </a>

        <a title="Contactos" class="btn btn-primary btn-xs" data-tooltip="tooltip">
            <i class="fas fa-user"></i>
        </a>

        @if($cliente->carpeta == null)
            <a  title="Agregar Carpeta d  el cliente" class="btn btn-gris btn-xs" data-target="#modal-carpeta" data-toggle="modal" data-tooltip="tooltip" onclick="Carpeta({{ $cliente->id }}, '{{ $cliente->nombre_comercial }}')">
                <i class="glyphicon glyphicon-folder-close"></i>
            </a>
        @else
            <a href="{{ $cliente->carpeta }}" target="_blank" title="Carpeta del cliente: {{ $cliente->carpeta }}" data-tooltip="tooltip" class="btn btn-info btn-xs">
                <i class="glyphicon glyphicon-folder-open"></i>
            </a>
        @endif

        <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-cliente-edit" data-tooltip="tooltip" title="Editar cliente: {{ $cliente->nombre_comercial }}" onclick="Edit({{ $cliente->id }})">
            <i class="glyphicon glyphicon-edit"></i>
        </a>

        @if($cliente->estatus == 1)
            <a class="btn btn-xs btn-danger" title="Inactivar {{ $cliente->nombre_comercial }}" data-tooltip="tooltip" onclick="Inactivar({{ $cliente->id }})">
                <i class="glyphicon glyphicon-eye-close"></i>
            </a>
        @else
            <a class="btn btn-xs btn-success" title="Activar {{ $cliente->nombre_comercial }}" data-tooltip="tooltip" onclick="Activar({{ $cliente->id }})">
                <i class="glyphicon glyphicon-eye-open"></i>
            </a>
        @endif
    </td>
</tr>