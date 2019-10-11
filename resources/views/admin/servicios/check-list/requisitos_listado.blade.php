@if(count($requisitos_listado) > 0)
<table id="example1" class="table display no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
    <thead>
        <tr class="centered">
            <th hidden>ID</th>
            <th>Orden</th>
            <th>Proceso</th>
            <th>Área</th>
            <th>Libera Comisiones y Registro</th>
            <th>Actualizado</th>
            <th colspan ="1">&nbsp;</th>
        </tr>
        {{ csrf_field() }}
    </thead>
    <tbody id="list" name="list">
        @foreach($requisitos_listado as $key => $listado)
        <tr id="listado-{{ $listado->id }}">
            <td hidden>{{ $listado->id }}</td>
            <td style="width:10%; font-weight: bold;" align="center"> 
                @if($listado->orden <= '1')
                    <a class="btn btn-success btn-xs disabled" disabled><i class="fas fa-arrow-up"></i></a>
                @else
                    <a class="btn btn-success btn-xs" onclick="SubirOrdenServicio({{ $listado->id }}, {{ $listado->orden }})"><i class="fas fa-arrow-up"></i></a> 
                @endif
                @if($listado->orden >= $ultimo_orden->orden)
                    <a class="btn btn-warning btn-xs disabled" disabled><i class="fas fa-arrow-down"></i></a>
                @else
                    <a class="btn btn-warning btn-xs" onclick="BajarOrdenServicio({{ $listado->id }}, {{ $listado->orden }})"><i class="fas fa-arrow-down"></i></a>
                @endif
            </td>
            <td style="width:23%;">{{ $listado->requisito }}</td>
            <td style="width:12%;" align="center">
                @if($listado->categoria == 'Jurídico')
                    <label class="label label-success">{{ $listado->categoria }}</label> 
                @elseif($listado->categoria == 'Administración') 
                    <label class="label label-warning">{{ $listado->categoria }}</label>
                @elseif($listado->categoria == 'Gestión')
                    <label class="label label-danger">{{ $listado->categoria }}</label>
                @elseif($listado->categoria == 'Operaciones')
                    <label class="label label-primary">{{ $listado->categoria }}</label>
                @endif
            </td>
            <td class="centered" style="width: 21px">
                @if($listado->libera_venta == 1)
                    <label class="label label-warning">Venta</label>
                @endif
                @if($listado->libera_operativa == 1)
                    <label class="label label-pink">Operativa</label>
                @endif
                @if($listado->libera_gestion == 1)
                    <label class="label label-green">Gestión</label>
                @endif
                @if($listado->registro == 1)
                    <label class="label label-primary">Registro</label>
                @endif
            </td>
            <td style="width:15%;" align="center" title="{{ Carbon\Carbon::parse($listado->updated_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($listado->updated_at)->diffForHumans() }}</td>
            <td style="width:19%;" align="center">
                <div class="btn-group">
                    <a class="btn btn-warning btn-xs" title="Libera comisión de Venta" data-tooltip="tooltip" onclick="LiberarComisiones(1, {{ $listado->id }}, {{ $listado->id_servicio }})"><i class="fas fa-money-bill-alt"></i></a>
                    <a class="btn btn-pink btn-xs" title="Libera comisión Operativa" data-tooltip="tooltip" onclick="LiberarComisiones(2, {{ $listado->id }}, {{ $listado->id_servicio }})"><i class="fas fa-money-bill-alt"></i></a>
                    <a class="btn btn-green btn-xs" title="Libera comisión por Gestión" data-tooltip="tooltip" onclick="LiberarComisiones(3, {{ $listado->id }}, {{ $listado->id_servicio }})"><i class="fas fa-money-bill-alt"></i></a>
                    <a class="btn btn-primary btn-xs" title="Registra trámite" data-tooltip="tooltip" onclick="LiberarComisiones(4, {{ $listado->id }}, {{ $listado->id_servicio }})"><i class="far fa-registered"></i></a>
                </div>
                
                <i style="padding-left: 1.2em"></i>
                <a class="btn btn-danger btn-xs" title="Quitar paso: {{ $listado->requisito }}" data-tooltip="tooltip" onclick="QuitarRequisito({{ $listado->id }}, {{ $listado->id_servicio }})"><i class="fas fa-times"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
    <h4>No hay registros encontrados, seleccione procesos del listado superior, o dar click <a class="btn btn-link">aquí</a> para agregar los pasos del catálogo.</h4>
@endif
@if(count($ultimo_orden) > 0)
    <input type="hidden" value="{{ $ultimo_orden->orden }}" id="ultimo_orden">
@else
    <input type="hidden" value="0" id="ultimo_orden">
@endif



