@if(count($categorias) > 0)
<table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
    <thead style="font-size: 15px; color:white; background-color:#218CBF">
        <tr>
            <th>Código</th>
            <th>Categorías</th>
            <th>Descripción</th>
            <th>Estatus?</th>
            <th hidden>Id</th>
            <th colspan ="1">&nbsp;</th>
        </tr>
        {{ csrf_field() }}
    </thead>
    <tbody style="font-size: 15px" id="list" name="list">
        @foreach($categorias as $key => $categoria)
        <tr id="categoria{{ $categoria->id }}">
            <td style="width:10%;" align="center">{{ $categoria->id }}</td>
            <td style="width:25%;" valign="middle">{{ $categoria->categoria }}</td>
            <td style="width:45%;" valign="middle">{{ $categoria->descripcion }}</td>
            <td style="width:10%;" align="center" valign="middle">
                @if($categoria->estatus == 1)
                <label class="label label-success">Activo</label>
                @else
                <label class="label label-danger">Inactivo</label>
                @endif
            </td>
            <td hidden>{{ $categoria->id }}</td>
            <td style="width:10%;" align="center">
                <a class="btn btn-xs btn-warning" data-target="#" data-toggle="modal" title="Editar" data-tooltip="tooltip">
                <i class="glyphicon glyphicon-edit"></i>
                </a>
                @if($categoria->estatus == 1)
                <a class="btn btn-xs btn-danger" data-target="#" data-toggle="modal" title="Inactivar" data-tooltip="tooltip">
                <i class="glyphicon glyphicon-eye-close"></i>
                </a>
                @else
                <a class="btn btn-xs btn-success" data-target="#" data-toggle="modal" title="Activar" data-tooltip="tooltip">
                <i class="glyphicon glyphicon-eye-open"></i>
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