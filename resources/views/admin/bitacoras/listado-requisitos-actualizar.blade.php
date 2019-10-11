<tr id="listado-requisitos-{{ $servicio->id }}">
    <td style="width:7%;"align="center" class="bitacora-class" id="bitacora-id-{{ $servicio->id }}">
        @if($servicio->fecha == '')
            {{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}
        @else
            {{ Carbon\Carbon::parse($servicio->fecha)->format('d-m-Y') }}
        @endif
    </td>
    <td hidden>{{ $servicio->id_control }}</td>
    <td style="width:16%;" valign="middle" align="left" title="{{ $servicio->clave }} - {{ $servicio->servicio }} - {{ $servicio->tramite }} - {{ $servicio->nombre_comercial }} {{ $servicio->clase }}" data-toggle="modal" data-tooltip="tooltip">{{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->clase }} {{ $servicio->tramite }}</td>
    <td style="width:5%;" valign="middle" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>

    <td style="width: 30%" data-click="theme-panel-expand" onclick="CargarProceso({{ $servicio->id }}, {{ $servicio->id_catalogo_servicio }}, '{{ $servicio->id_estatus }}', {{ $servicio->avance_total }}, {{ $servicio->avance }}, '{{ $servicio->nombre_comercial }}')">
        <div class="progress rounded-corner m-b-15">
            @if($servicio->avance_parcial == null)
                <div class="progress-bar bg-green progress-bar-striped progress-bar-animated" style="width: 100%"><b>100%</b></div>
            @elseif($servicio->avance == 0 && $servicio->avance_total > 0)
                <div class="progress-bar bg-red progress-bar-striped progress-bar-animated" style="width: 0%"><b style="color: red">0%</b></div>
            @elseif($servicio->avance_parcial > 0 && $servicio->avance_parcial <= 60)
                <div class="progress-bar bg-red progress-bar-striped progress-bar-animated" style="width: {{ $servicio->avance_parcial }}%"><b>{{ number_format($servicio->avance_parcial, 2) }}%</b></div>
            @elseif($servicio->avance_parcial > 60 && $servicio->avance_parcial <= 89)
                <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" style="width: {{ $servicio->avance_parcial }}%"><b>{{ number_format($servicio->avance_parcial, 2) }}%</b></div>
            @elseif($servicio->avance_parcial > 89 && $servicio->avance_parcial < 100)
                <div class="progress-bar bg-lime progress-bar-striped progress-bar-animated" style="width: {{ $servicio->avance_parcial }}%"><b>{{ number_format($servicio->avance_parcial, 2) }}%</b></div>
            @elseif($servicio->avance_parcial >= 100)
                <div class="progress-bar bg-green progress-bar-striped progress-bar-animated" style="width: {{ $servicio->avance_parcial }}%"><b>{{ number_format($servicio->avance_parcial, 2) }}%</b></div>
            @endif
        </div>
    </td>

    <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($servicio->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}</td>

    <td style="width: 10px;" align="center" onclick="FechaVencimiento({{ $servicio->id }}, '{{ $servicio->created_at }}', '{{ $servicio->fecha_vencimiento }}')" data-toggle="modal" data-target="#modal-vencimiento">
        @if($servicio->estatus_registro == 'Pendiente')
            
            @if($servicio->fecha_vencimiento != null)
                @if(Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() >= 28 && $servicio->fecha_vencimiento > $today)
                    <label class="label label-success" style="font-size: 14px" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->format('d-m-Y') }}">{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() >= 20 && Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() < 28 && $servicio->fecha_vencimiento > $today)
                    <label class="label label-success" style="font-size: 14px" title="{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() >= 10 && Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() < 20 && $servicio->fecha_vencimiento > $today)
                    <label class="label label-warning" style="font-size: 14px" title="{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() >= 1 && Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() < 10 && $servicio->fecha_vencimiento > $today)
                    <label class="label" style="font-size: 14px; background-color: #ff751a" title="{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() == 0)
                    <label class="label label-danger" style="font-size: 14px;" title="{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() }} días</label>
                @elseif(Carbon\Carbon::parse($servicio->fecha_vencimiento)->diffInDays() < 0 && $servicio->fecha_vencimiento <= $today)
                    <label class="label label-danger" style="font-size: 14px;" title="{{ Carbon\Carbon::parse($servicio->fecha_vencimiento)->format('d-m-Y') }}" data-tooltip="tooltip">0 días</label>
                @else
                    <label class="label label-danger" style="font-size: 14px">0 días</label>
                @endif
            @else
                <i style="color: #cccccc" class="fas fa-minus"></i>
            @endif
            
        @elseif($servicio->estatus_registro == 'Cancelado')
            <label class="label label-danger" style="font-size: 12px">{{ $servicio->estatus_registro }}</label>
        @elseif($servicio->estatus_registro == 'Terminado')
            <label class="label label-success" style="font-size: 12px">{{ $servicio->estatus_registro }}</label>
        @elseif($servicio->estatus_registro == 'No Registro')
            <label class="label" style="font-size: 12px; background-color: #ff751a">{{ $servicio->estatus_registro }}</label>
        @else
            <i style="color: #cccccc" class="fas fa-minus"></i>
        @endif
    </td>

    @if($servicio->mostrar_bitacora == 0 && $servicio->estatus_registro == 'Pendiente')
        <td align="center" style="width:5%;">
            <label class="label" style="background-color: #ff6600">Sin Bitácora</label>
        </td>
    @else
        <td align="center" style="width:5%;">
            @if($servicio->estatus_registro == 'Pendiente')
                <label class="label label-warning">{{ $servicio->estatus_registro }}</label>
            @elseif($servicio->estatus_registro == 'Terminado')
                <label class="label label-success" title="Presentado {{ Carbon\Carbon::parse($servicio->fecha_registro)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->fecha_registro)->format('d-m-Y') }}</label>
            @elseif($servicio->estatus_registro == 'Cancelado')
                <label class="label label-danger">{{ $servicio->estatus_registro }}</label>
            @elseif($servicio->estatus_registro == 'No Registro')
                <label class="label label-danger">{{ $servicio->estatus_registro }}</label>
            @endif
        </td>
    @endif
    <td style="width:17%;" align="center">
        <div class="btn-group">
            <a class="btn btn-sm btn-green btn-flat" onclick="Menu({{ $servicio->id }})" data-tooltip="tooltip" title="Menú de Comisiones" data-toggle="modal" data-target="#menu"><i class="far fa-money-bill-alt"></i></a>

            <a onclick="Edit({{ $servicio->id }})" data-toggle="modal" data-target="#agregar-servicio" class="btn btn-sm btn-warning btn-flat" data-tooltip="tooltip" title="Editar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
              <i class="fas fa-edit"></i>
            </a>

            @if($servicio->estatus_registro == 'Pendiente' || $servicio->estatus_registro == 'Terminado')
                <a class="btn btn-sm btn-danger btn-flat" onclick="Cancelar({{ $servicio->id }})" data-tooltip="tooltip" title="Cancelar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
                    <i class="fas fa-times"></i>
                </a>
            @elseif($servicio->estatus_registro == 'Cancelado')
                <a class="btn btn-sm btn-success btn-flat" onclick="Activar({{ $servicio->id }})" data-tooltip="tooltip" title="Activar servicio: {{ $servicio->tramite }} - {{ $servicio->clave }}">
                    <i class="fas fa-check"></i>
                </a>
            @endif

            @if($servicio->id_control == '' || $servicio->fecha_registro == '')    
                <a class="btn btn-grey btn-sm btn-flat" disabled title="No se puede enviar el servicio a estatus debido a que no tiene marca o fecha de registro" data-tooltip="tooltip"><i class="fas fa-external-link-square-alt"></i></a>
            @else
                <a class="btn btn-primary btn-sm btn-flat" title="Pasar servicio a Estatus" data-tooltip="tooltip" data-toggle="modal" data-target="#modal-estatus"
                    @if($servicio->id_estatus == '') 
                        onclick="Estatus({{ $servicio->id }}, 0, {{ $servicio->id_control }}, '{{ $servicio->marca }}', {{ $servicio->id_cliente }}, {{ $servicio->id_catalogo_servicio }}, {{ $servicio->id_clase }})"
                    @else onclick="Estatus({{ $servicio->id }}, {{ $servicio->id_estatus }}, {{ $servicio->id_control }}, '{{ $servicio->marca }}', {{ $servicio->id_cliente }}, {{ $servicio->id_catalogo_servicio }}, {{ $servicio->id_clase }})" 
                    @endif><i class="fas fa-external-link-square-alt"></i></a>
            @endif
        </div>
    </td>
</tr>