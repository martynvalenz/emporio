<div class="table-responsive">
    @if(count($estrategias) > 0)
    <table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border sticky-header" cellspacing="0" width="100%">
        <thead style="font-size: 14px;">
            <tr>
                <th>Id</th>
                <th>Estrategia</th>
                <th>Clientes</th>
                <th>Creada</th>
                <th>Estatus?</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px;" id="list" name="list">
            @foreach($estrategias as $key => $estrategia)
            <tr id="estrategia{{ $estrategia->id }}">
                <td style="width:10%;" align="center">{{ $estrategia->id }}</td>
                <td style="width:40%;" valign="middle">{{ $estrategia->estrategia }}</td>
                <td style="width:5%;" align="center">{{ $estrategia->clientes }}</td>
                <td style="width:20%;" align="center">{{ Carbon\Carbon::parse($estrategia->created_at)->diffForHumans() }}</td>
                <td style="width:10%;" align="center" valign="middle">
                    @if($estrategia->estatus == 1)
                        <label class="label label-green">Activa</label>
                    @elseif($estrategia->estatus ==0)
                        <label class="label label-danger">Inactiva</label>
                    @endif
                </td>
                <td style="width:15%;" align="center">
                    <a class="btn btn-xs btn-warning" data-target="#modal-estrategia" data-toggle="modal" title="Editar {{ $estrategia->estrategia }}" data-tooltip="tooltip" onclick="Edit({{ $estrategia->id }})">
                    <i class="fas fa-edit"></i>
                    </a>
                    @if($estrategia->estatus == 1)
                        <a class="btn btn-xs btn-danger" title="Inactivar {{ $estrategia->estrategia }}" data-tooltip="tooltip" onclick="Inactivar({{ $estrategia->id }})">
                            <i class="fas fa-eye-slash"></i>
                        </a>
                    @else
                    <a class="btn btn-xs btn-success" title="Activar {{ $estrategia->estrategia }}" data-tooltip="tooltip" onclick="Activar({{ $estrategia->id }})">
                    <i class="fas fa-eye"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <h4>No hay registros encontrados, inicie por crear uno nuevo.</h4>
    @endif
</div>