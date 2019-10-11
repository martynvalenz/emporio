@if(count($comisiones) > 0)
<table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
    <thead style="font-size: 15px; color:white; background-color:#218CBF">
        <tr>
            <th>Clave</th>
            <th>Servicio</th>
            <th>Moneda</th>
            <th>Precio</th>
            <th>Venta</th>
            <th>Gestión</th>
            <th>Operativa</th>
            <th>Estatus?</th>
            <th hidden>Id</th>
            <th colspan ="1">&nbsp;</th>
        </tr>
    </thead>
    <tbody style="font-size: 15px" id="list" name="list">
        @foreach($comisiones as $key => $catalogo)
        <tr id="catalogo{{ $catalogo->id }}">
            <td style="width:10%;" valign="left" onclick="Detalles({{ $catalogo->id }})" data-toggle="modal" data-target="#detalles-modal">{{ $catalogo->clave }}</td>
            <td style="width:38%;" valign="middle" onclick="Detalles({{ $catalogo->id }})" data-toggle="modal" data-target="#detalles-modal" title="{{ $catalogo->comentarios }}" data-tooltip="tooltip">{{ $catalogo->servicio }}</td>
            <td style="width:5%;" valign="middle" align="center">{{ $catalogo->moneda }}</td>
            <td style="width:8%;" align="right" valign="middle">
                @if($catalogo->concepto == 'Neto')
                    $ {{ number_format($catalogo->costo,2) }}
                @elseif($catalogo->concepto == 'Porcentaje')
                    % {{ number_format($catalogo->costo,2) }}
                @elseif($catalogo->concepto == 'por Proyecto')
                    <label class="label label-default">{{ $catalogo->concepto }}</label>
                @endif
            </td>
            <td style="width:8%;" align="right" valign="middle">
                @if($catalogo->comision_venta == 'Monto Fijo' || $catalogo->comision_venta == 'Monto fijo')
                    $ {{ number_format($catalogo->comision_venta_monto,2) }}
                @elseif($catalogo->comision_venta == 'Porcentaje' && $catalogo->comision_venta_monto > 0)
                    % {{ number_format($catalogo->comision_venta_monto,2) }}
                @elseif($catalogo->comision_venta == 'Porcentaje Utilidad'  && $catalogo->comision_venta_monto > 0)
                    % {{ number_format($catalogo->comision_venta_monto,2) }}
                @elseif($catalogo->comision_venta == 'Dolares')
                    $ {{ number_format($catalogo->comision_venta_monto,2) }}
                @else
                    <label style="color: #cccccc; background-color: white opacity: 0; filter: alpha(opacity=0);">0.00</label>
                @endif
            </td>
            <td style="width:8%;" align="right" valign="middle">
                @if($catalogo->comision_gestion == 'Monto Fijo' || $catalogo->comision_gestion == 'Monto fijo')
                    $ {{ number_format($catalogo->comision_gestion_monto,2) }}
                @elseif($catalogo->comision_gestion == 'Porcentaje' && $catalogo->comision_gestion_monto > 0)
                    % {{ number_format($catalogo->comision_gestion_monto,2) }}
                @elseif($catalogo->comision_gestion == 'Porcentaje Utilidad' && $catalogo->comision_gestion_monto > 0)
                    % {{ number_format($catalogo->comision_gestion_monto,2) }}
                @elseif($catalogo->comision_gestion == 'Dolares')
                    $ {{ number_format($catalogo->comision_gestion_monto,2) }}
                @else
                    <label style="color: #cccccc; background-color: white opacity: 0; filter: alpha(opacity=0);">0.00</label>
                @endif
            </td>
            <td style="width:8%;" align="right" valign="middle">
                @if($catalogo->comision_operativa == 'Monto Fijo' || $catalogo->comision_operativa == 'Monto fijo')
                    $ {{ number_format($catalogo->comision_operativa_monto,2) }}
                @elseif($catalogo->comision_operativa == 'Porcentaje' && $catalogo->comision_operativa_monto > 0)
                    % {{ number_format($catalogo->comision_operativa_monto,2) }}
                @elseif($catalogo->comision_operativa == 'Porcentaje Utilidad' && $catalogo->comision_operativa_monto > 0)
                    % {{ number_format($catalogo->comision_operativa_monto,2) }}
                @elseif($catalogo->comision_operativa == 'Dolares')
                    $ {{ number_format($catalogo->comision_operativa_monto,2) }}
                @else
                    <label style="color: #cccccc; background-color: white opacity: 0; filter: alpha(opacity=0);">0.00</label>
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
<h4>No hay registros encontrados, inicie por crear uno nuevo.</h4>
@endif