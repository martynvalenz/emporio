{{$clientes->render()}}
@if(count($clientes) > 0)
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr>
                <th>Folio</th>
                <th>Cliente</th>
                <th>Estrategia</th>
                <th>Saldo</th>
                <th>Agregó</th>
                <th>Agregado</th>
                <th>Estatus?</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($clientes as $key => $cliente)
            <tr id="cliente-{{ $cliente->id }}">
                <td style="width:10%;" valign="left">CLI-{{ $cliente->id }}</td>
                <td style="width:30%;" valign="middle">{{ $cliente->nombre_comercial }}</td>
                <td style="width:10%;" valign="middle">{{ $cliente->estrategia }}</td>
                <td style="width:10%;" align="right">$ {{ number_format($cliente->saldo,2) }}</td>
                <td style="width:5%;" align="center" valign="middle" title="{{ $cliente->nombre }} {{ $cliente->apellido }}">{{ $cliente->iniciales }}</td>
                <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($cliente->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}</td>
                <td style="width:5%;" align="center" valign="middle" title="Detalles de {{ $cliente->nombre_comercial }}">
                    @if($cliente->estatus == 1)
                    <label class="label label-success">Activo</label>
                    @elseif($cliente->estatus == 0)
                    <label class="label label-danger">Inactivo</label>
                    @endif
                </td>
                <td style="width:20%;" align="center">
                    <div class="btn-group">
                        <a title="Razones sociales" class="btn btn-success btn-xs" onclick="Razones({{ $cliente->id }}, '{{ $cliente->nombre_comercial }}')" data-toggle="modal" data-target="#modal-razones">
                            <i class="fas fa-list"></i>
                        </a>

                        <a title="Marcas, obras, slogan, etc." class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-marcas" onclick="Marcas({{ $cliente->id }}, '{{ $cliente->nombre_comercial }}')">
                            <i class="far fa-copyright"></i>
                        </a>

                        <a title="Contactos" class="btn btn-primary btn-xs">
                            <i class="fas fa-user"></i>
                        </a>

                        @if($cliente->carpeta == null)
                            <a  title="Agregar Carpeta d  el cliente" class="btn btn-grey btn-xs" data-target="#modal-carpeta" data-toggle="modal" onclick="Carpeta({{ $cliente->id }}, '{{ $cliente->nombre_comercial }}')">
                                <i class="fas fa-folder"></i>
                            </a>
                        @else
                            <a href="{{ $cliente->carpeta }}" target="_blank" title="Carpeta del cliente: {{ $cliente->carpeta }}" class="btn btn-info btn-xs">
                                <i class="fas fa-folder-open"></i>
                            </a>
                        @endif

                        <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-cliente-edit" title="Editar cliente: {{ $cliente->nombre_comercial }}" onclick="Edit({{ $cliente->id }})">
                            <i class="fas fa-edit"></i>
                        </a>

                        @if($cliente->estatus == 1)
                            <a class="btn btn-xs btn-danger" title="Inactivar {{ $cliente->nombre_comercial }}" onclick="Inactivar({{ $cliente->id }})">
                                <i class="fas fa-eye-slash"></i>
                            </a>
                        @else
                            <a class="btn btn-xs btn-success" title="Activar {{ $cliente->nombre_comercial }}" onclick="Activar({{ $cliente->id }})">
                                <i class="fas fa-eye"></i>
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$clientes->render()}}
@else
<h4>No hay registros encontrados, inicie por crear uno nuevo.</h4>
@endif