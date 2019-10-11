<tr id="empleado-{{ $empleado->id }}">
    <td hidden>{{ $empleado->id }}</td>
    <td style="width: 10%"><img src="{{ asset('images/users/'.$empleado->imagen) }}" alt="Imagen" style="height: 50px; width: 50px; border-radius: 100%"></td>
    <td style="width:21%;" align="left">{{ $empleado->iniciales }} - {{ $empleado->nombre }} {{ $empleado->apellido }}</td>
    <td style="width:12%;" align="left">{{ $empleado->puesto }}</td>
    <td style="width:13%;" align="right" valign="middle">$ {{ $empleado->sueldo_diario }}</td>
    <td style="width:13%;" align="right" valign="middle">$ {{ $empleado->sueldo_quincenal }}</td>
    <td style="width:15%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($empleado->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($empleado->created_at)->diffForHumans() }}</td>
    <td style="width:6%" align="center" valign="middle" title="" data-tooltip="tooltip">
        @if($empleado->estatus == '1')
            <label class="label label-success">Activo</label>
        @elseif($empleado->estatus == '0')
            <label class="label label-danger">Inactivo</label>
        @endif
    </td>
    <td style="width:10%" align="center">
        <div class="btn-group">
            <a class="btn btn-warning btn-sm" onclick="EditarEmpleado({{ $empleado->id }}, '{{ $empleado->nombre_completo }}', {{ $empleado->sueldo_quincenal }})" data-toggle="modal" data-target="#modal-empleado"><i class="fas fa-edit"></i></a>
            @if($empleado->estatus == '1')
                <a class="btn btn-danger btn-sm" onclick="Inactivar({{ $empleado->id }})"><i class="fas fa-eye-slash"></i></a>
            @elseif($empleado->estatus == '0')
                <a class="btn btn-success btn-sm" onclick="Activar({{ $empleado->id }})"><i class="fas fa-eye"></i></a>
            @endif
        </div>
    </td>
</tr>