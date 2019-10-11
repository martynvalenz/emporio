@if(count($catalogos) > 0)
<table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
    <thead style="font-size: 15px; color:white; background-color:#218CBF">
        <tr>
            <th>Clave</th>
            <th>Servicio</th>
            <th>Categoría</th>
            <th>Bitácora</th>
            <th>Moneda</th>
            <th>Precio</th>
            <th>Estatus?</th>
            <th hidden>Id</th>
            <th colspan ="1">&nbsp;</th>
        </tr>
        {{ csrf_field() }}
    </thead>
    <tbody style="font-size: 15px" id="list" name="list">
        @foreach($catalogos as $key => $catalogo)
        <tr id="catalogo{{ $catalogo->id }}">
            <td style="width:10%;" valign="left" title="Detalles" data-tooltip="tooltip" onclick="Detalles({{ $catalogo->id }})" data-toggle="modal" data-target="#detalles-modal">{{ $catalogo->clave }}</td>
            <td style="width:27%;" valign="middle" title="{{ $catalogo->comentarios }}" data-tooltip="tooltip" onclick="Detalles({{ $catalogo->id }})" data-toggle="modal" data-target="#detalles-modal">{{ $catalogo->servicio }}</td>
            <td style="width:17%;" valign="middle">@if($catalogo->id_categoria_servicios == null)@else{{ $catalogo->categoria }}@endif
            </td>
            <td style="width:17%;" valign="middle">@if($catalogo->id_categoria_bitacora == null)@else{{ $catalogo->bitacora }}@endif
            </td>
            <td style="width:5%;" valign="middle" align="center">{{ $catalogo->moneda }}</td>
            <td style="width:9%;" align="right" valign="middle">
                @if($catalogo->concepto == 'Neto')
                    $ {{ number_format($catalogo->costo,2) }}
                @elseif($catalogo->concepto == 'Porcentaje')
                    % {{ number_format($catalogo->costo,2) }}
                @elseif($catalogo->concepto == 'por Proyecto')
                    <label class="label label-default">{{ $catalogo->concepto }}</label>
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
            <td style="width:10%;" align="center">
                <a class="btn btn-warning btn-xs btn-flat" onclick="Edit({{ $catalogo->id }})" data-toggle="modal" data-target="#servicio-modal" title="Editar" data-tooltip="tooltip"><i class="fas fa-edit"></i></a>
                @if($catalogo->estatus == 1)
                    <a class="btn btn-danger btn-xs btn-flat" onclick="Cancelar({{ $catalogo->id }})" data-toggle="modal" data-target="#cancelar-modal" title="Inactivar" data-tooltip="tooltip"><i class="fas fa-times"></i></a>
                @elseif($catalogo->estatus == 0)
                    <a class="btn btn-success btn-xs btn-flat" onclick="Activar({{ $catalogo->id }})" data-toggle="modal" data-target="#activar-modal" title="Activar" data-tooltip="tooltip"><i class="fas fa-check"></i></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <h4>No hay registros encontrados, inicie por crear uno <a data-toggle="modal" id="add" value="add">registro nuevo</a>.</h4>
@endif