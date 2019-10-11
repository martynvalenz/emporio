<div class="table-responsive">
    <table class="table headerfix table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr class="centered">
                <th>Orden</th>
                <th>Categoría</th>
                <th>Concepto</th>
                <th>Estatus</th>
                <th>Usuario</th>
                <th>Actualización</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list-detalle" name="list-detalle">
            @foreach($detalles as $key => $detalle)
            <tr id="listado-detalles-{{ $detalle->id }}">
                <td style="width:10%;" align="center">{{ $loop->index + 1 }}</td>
                <td style="width:15%;">
                    <span @if($detalle->categoria == 'Jurídico') style="color: #49ADAD" 
                    @elseif($detalle->categoria == 'Administración') style="color: #F49C31"
                    @elseif($detalle->categoria == 'Gestión') style="color: #EE5755" 
                    @elseif($detalle->categoria == 'Operaciones') style="color: #2d5986" 
                    @endif>{{ $detalle->categoria }}</span>
                </td>
                <td style="width:20%;">{{ $detalle->requisito }}</td>
                <td style="width:10%;" align="center">
                    <div class="checkbox checkbox-css">
                        @if($detalle->id_requisitos == '14' || $detalle->id_requisitos == '38')
                            <input type="checkbox" class="checkbox_proceso" disabled>
                        @else
                            <input type="checkbox" class="checkbox_proceso" id="paso-{{ $detalle->id }}" @if($detalle->estatus == 1) value="1" checked @else value="0" unchecked @endif onclick="Check({{ $detalle->id }}, {{ $detalle->id_servicio }}, {{ $detalle->libera_venta }}, {{ $detalle->libera_operativa }}, {{ $detalle->libera_gestion }}, {{ $detalle->registro }}, {{ $detalle->id_control }}, '{{ $detalle->categoria }}', '{{ Auth::user()->area }}', '{{ Auth::user()->iniciales }}', '{{ Auth::user()->nombre }}', '{{ Auth::user()->apellido }}')"/>
                        @endif
                        <label for="paso-{{ $detalle->id }}"></label>
                    </div>
                    <input type="hidden" value="{{ $detalle->estatus }}" id="estatus_val-{{ $detalle->id }}">
                </td>
                <td style="width:25%;" align="center">@if($detalle->estatus == 0) - @else {{ $detalle->iniciales }} - {{ $detalle->nombre }} {{ $detalle->apellido }} @endif</td>
                <td style="width:20%;" align="center" title="{{ Carbon\Carbon::parse($detalle->updated_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($detalle->updated_at)->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" id="avance_parcial_bitacora" value="{{ $servicium->avance }}">
    <input type="hidden" id="avance_total_bitacora" value="{{ $servicium->avance_total }}">
</div>