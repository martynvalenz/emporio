@if(count($users) > 0)
<table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
    <thead style="font-size: 15px">
        <tr>
            <th>Imagen</th>
            <th>Iniciales</th>
            <th>Nombre</th>
            <th>Puesto</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Agregado</th>
            <th>Estatus?</th>
            <th hidden>Id</th>
            <th colspan ="1">&nbsp;</th>
        </tr>
    </thead>
    <tbody style="font-size: 15px" id="list" name="list">
        @foreach($users as $key => $user)
        <tr id="user-{{ $user->id }}">
            <td style="width:10%;" valign="left" align="left" title="Detalles"><img style="max-height: 50px; width: auto" src="{{ asset('images/users/'.$user->imagen) }}" alt="Imagen"></td>
            <td style="width:5%;" align="center">{{ $user->iniciales }}</td>
            <td style="width:15%;" valign="middle">{{ $user->nombre }} {{ $user->apellido }}</td>
            <td style="width:15%;" valign="middle">{{ $user->puesto }}</td>
            <td style="width:10%;" valign="middle">{{ $user->usuario }}</td>
            <td style="width:10%;" valign="middle">{{ $user->contra }}</td>
            <td style="width:10%;" valign="middle" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" title="{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
            <td style="width:10%;" align="center" valign="middle">
                @if($user->estatus == 1)
                <label class="label label-success">Activo</label>
                @elseif($user->estatus ==0)
                <label class="label label-danger">Inactivo</label>
                @endif
            </td>
            <td hidden>{{ $user->id }}</td>
            <td style="width:15%;" align="center">
                <div class="btn-group">
                    @if($user->contra == null)
                        <a data-target="#modal-contra" data-toggle="modal" onclick="Contra({{ $user->id }}, '{{ $user->iniciales }}', '{{ $user->nombre }}', '{{ $user->apellido }}', '')" class="btn btn-sm btn-danger" title="Agregar Contraseña" data-tooltip="tooltip">
                            <i class="fa fa-key"></i>
                        </a>
                    @else
                        <a data-target="#modal-contra" data-toggle="modal" onclick="Contra({{ $user->id }}, '{{ $user->iniciales }}', '{{ $user->nombre }}', '{{ $user->apellido }}', '{{ $user->contra }}')" class="btn btn-sm btn-default" title="Cambiar Contraseña" data-tooltip="tooltip">
                            <i class="fa fa-key"></i>
                        </a>
                    @endif
                    <!--<a href="" class="btn btn-sm btn-info" title="Gestión de accesos y permisos para {{ $user->nombre }} {{ $user->apellido }}" data-tooltip="tooltip">
                        <i class="fa fa-unlock-alt"></i>
                    </a>-->
                    <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-user" onclick="EditUser({{ $user->id }})">
                        <i class="fas fa-edit"></i>
                    </a>
                    @if($user->estatus == 1)
                        <a class="btn btn-sm btn-danger" onclick="Inactivar({{ $user->id }})" title="Inactivar" data-tooltip="tooltip">
                            <i class="fas fa-eye-slash"></i>
                        </a>
                    @else
                        <a class="btn btn-sm btn-success" onclick="Activar({{ $user->id }})" title="Activar" data-tooltip="tooltip">
                            <i class="fas fa-eye"></i>
                        </a>
                    @endif
                </div>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
@else
    <h4>No hay registros encontrados, inicie por crear uno <a data-toggle="modal" id="add" value="add">registro nuevo</a>.</h4>
@endif