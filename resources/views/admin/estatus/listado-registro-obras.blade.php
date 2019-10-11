@if(count($bitacoras) > 0)
<div class="paginacion-registro-obras">
    {{$bitacoras->render()}} 
</div>

<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr>
                <th hidden>ID</th>
                <th>Categoría</th>
                <th>Cliente</th>
                <th>Marca</th>
                <th>Expediente</th>
                <th>Registro</th>
                <th>Estatus</th>
                <th>Vence</th>
                <th>Vigencia</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list-registro-obras" name="list-registro-obras">
            @foreach($bitacoras as $key => $bitacora)
            <tr id="listado-registro-obras-{{ $bitacora->id }}">
                <td hidden style="width:5%;" valign="middle" align="left">{{ $bitacora->id }}</td>
                <td style="width:10%;">{{ $bitacora->subcategoria }}</td>
                <td style="width:14%;" valign="middle" align="left" title="{{ $bitacora->razon_social }} {{ $bitacora->rfc }}" data-toggle="modal" data-tooltip="tooltip">{{ $bitacora->nombre_comercial }}</td>
                <td style="width:15%;" valign="middle" data-tooltip="tooltip"><i class="fas fa-edit"></i></a> {{ $bitacora->marca }} <b>{{ $bitacora->clase }}</b></td>

                <td style="width:7%;" align="center" valign="middle">{{ $bitacora->numero_expediente }}</td>

                <td style="width:7%;" align="center" valign="middle">{{ $bitacora->numero_registro }}</td>

                <td style="width:7%;" align="center" valign="middle" title="" data-tooltip="tooltip" data-target="#modal-estatus" data-toggle="modal">
                    <label class="label" style="background-color: {{ $bitacora->color }}; color: {{ $bitacora->texto }}">{{ $bitacora->estatus }}</label>
                </td>

                @if($bitacora->fecha_vencimiento == '')
                    <td style="width:7%;" align="center" valign="middle" data-target="#modal-estatus" data-toggle="modal" data-tooltip="tooltip"></td>
                @else
                    <td style="width:7%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffForHumans() }}" data-target="#modal-estatus" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($bitacora->fecha_vencimiento)->format('d-m-Y') }}</td>
                @endif

                <td style="width:7%;" align="center" valign="middle">
                    @if($bitacora->estatus == 'CANCELADA')

                    @elseif($bitacora->fecha_vencimiento == '')

                    @elseif($bitacora->fecha_vencimiento > $today)

                        @if(Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() >= 365)
                            <label class="label label-success" style="font-size: 14px" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() }} días">{{ Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInYears() }} años</label>
                        @elseif(Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() >= 180 && Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() < 365)
                            <label class="label label-success" style="font-size: 14px" title="{{ Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() }} días" data-tooltip="tooltip">{{ Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInMonths() }} meses</label>
                        @elseif(Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() >= 30 && Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() < 180)
                            <label class="label label-warning" style="font-size: 14px" title="{{ Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() }} días" data-tooltip="tooltip">{{ Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInMonths() }} meses</label>
                        @elseif(Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() < 30 && Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() > 0)
                            <label class="label" style="font-size: 14px; background-color: #ff751a">{{ Carbon\Carbon::parse($bitacora->fecha_vencimiento)->diffInDays() }} días</label>
                        @endif

                    @else
                        <label class="label label-danger" style="font-size: 14px">Vencida</label>
                    @endif
                </td>
                <td style="width:12%;" align="center">
                    <div class="btn-group">
                        <a class="btn btn-xs btn-grey btn-comentarios-modal" onclick="Comentarios({{ $bitacora->id }})" data-target="#comentarios-modal" data-toggle="modal" data-token="{{ csrf_token() }}">
                            <i class="fas fa-comment"></i>
                        </a>
                        <a class="btn btn-info btn-xs" title="Contactos" data-toggle="modal" data-target="#modal-contactos" onclick="Contactos({{ $bitacora->id_cliente }})"><i class="fas fa-users"></i></a>
                        <a class="btn btn-warning btn-xs" onclick="EditarEstatus({{ $bitacora->id }})" data-toggle="modal" data-target="#modal-estatus"><i class="fas fa-edit"></i></a>

                        <a class="btn btn-primary btn-xs" title="Renovar"><i class="fas fa-external-link-square-alt"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="paginacion-registro-obras">
    {{$bitacoras->render()}} 
</div>
@else
<h4>No se encontraron registros.</h4>
@endif