<div class="table-responsive">
    <h4>Listado de comisiones</h4>
    <table id="listado-comisiones-seleccionadas" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:orange">
            <tr>
                <th hidden>ID</th>
                <th>ID</th>
                <th>Servicio</th>
                <th data-tooltip="tooltip" title="Tipo de comisión">Tipo</th>
                <th>Agregada</th>
                <th>Liberada</th>
                <th data-tooltip="tooltip" title="Monto de comisión">Comisión</th>
                <th colspan="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @if($comisiones != '')
            @foreach($comisiones as $comision)
            <tr id="comision-{{ $comision->id }}">
                <td hidden>{{ $comision->id }}</td>
                <td style="width:10%;">{{ $comision->id_servicio }}</td>
                <td style="width:30%;" align="left" title="{{ $comision->clave }} - {{ $comision->servicio }} {{ $comision->tramite }}" data-tooltip="tooltip">{{ $comision->clave }} - {{ $comision->marca }} {{ $comision->clase }}. {{ $comision->nombre_comercial }}</td>
                <td style="width:10%;" align="center" valign="middle">
                    @if($comision->tipo_comision == 'Venta')
                        <label class="label label-success">Venta</label>
                    @elseif($comision->tipo_comision == 'Operativa')
                        <label class="label label-info">Operativa</label>
                    @elseif($comision->tipo_comision == 'Gestión')
                        <label class="label label-primary">Gestión</label>
                    @endif
                </td>
                @if($comision->fecha_comision == null)
                    <td style="width:15%;" align="center" valign="middle"></td>
                @else
                    <td style="width:15%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_comision)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_comision)->format('d-m-Y') }}</td>
                @endif
                @if($comision->fecha_aplicada == null)
                    <td style="width:15%;" align="center" valign="middle"></td>
                @else
                    <td style="width:15%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_aplicada)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_aplicada)->format('d-m-Y') }}</td>
                @endif
                <td style="width:15%; font-weight: bold" align="right" valign="middle" class="comision_monto">{{ $comision->monto }}</td>
                <td style="width:5%" align="center" vertical-align="middle">
                    <a class="btn btn-danger btn-sm" class="btn-quitar-comision" title="Quitar comisión del listado" data-tooltip="tooltip" onclick="QuitarComision({{ $comision->id }})"><i class="fas fa-times"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
            
            @if($comisiones_nuevas != '')
            @foreach($comisiones_nuevas as $comision)
            <tr id="comision-{{ $comision->id }}">
                <td hidden>{{ $comision->id }}</td>
                <td style="width:10%;">{{ $comision->id_servicio }}</td>
                <td style="width:30%;" align="left" title="{{ $comision->clave }} - {{ $comision->servicio }} {{ $comision->tramite }}" data-tooltip="tooltip">{{ $comision->clave }} - {{ $comision->marca }} {{ $comision->clase }}. {{ $comision->nombre_comercial }}</td>
                <td style="width:10%;" align="center" valign="middle">
                    @if($comision->tipo_comision == 'Venta')
                        <label class="label label-success">Venta</label>
                    @elseif($comision->tipo_comision == 'Operativa')
                        <label class="label label-info">Operativa</label>
                    @elseif($comision->tipo_comision == 'Gestión')
                        <label class="label label-primary">Gestión</label>
                    @endif
                </td>
                @if($comision->fecha_comision == null)
                    <td style="width:15%;" align="center" valign="middle"></td>
                @else
                    <td style="width:15%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_comision)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_comision)->format('d-m-Y') }}</td>
                @endif
                @if($comision->fecha_aplicada == null)
                    <td style="width:15%;" align="center" valign="middle"></td>
                @else
                    <td style="width:15%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_aplicada)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_aplicada)->format('d-m-Y') }}</td>
                @endif
                <td style="width:15%; font-weight: bold" align="right" valign="middle" class="comision_monto">{{ $comision->monto }}</td>
                <td style="width:5%" align="center" vertical-align="middle">
                    <a class="btn btn-success btn-sm" class="btn-anexar-comision" title="Anexar comisión" data-tooltip="tooltip" onclick="ConceptoComision({{ $comision->id }}, {{ $comision->monto }}, 1)"><i class="fas fa-plus"></i></a>
                </td>
            </tr>
            @endforeach
            @endif

            @if($comisiones_egreso != '')
            @foreach($comisiones_egreso as $comision)
            <tr id="comision-{{ $comision->id }}">
                <td hidden>{{ $comision->id }}</td>
                <td style="width:10%;">{{ $comision->id_servicio }}</td>
                <td style="width:30%;" align="left" title="{{ $comision->clave }} - {{ $comision->servicio }} {{ $comision->tramite }}" data-tooltip="tooltip">{{ $comision->clave }} - {{ $comision->marca }} {{ $comision->clase }}. {{ $comision->nombre_comercial }}</td>
                <td style="width:10%;" align="center" valign="middle">
                    @if($comision->tipo_comision == 'Venta')
                        <label class="label label-success">Venta</label>
                    @elseif($comision->tipo_comision == 'Operativa')
                        <label class="label label-info">Operativa</label>
                    @elseif($comision->tipo_comision == 'Gestión')
                        <label class="label label-primary">Gestión</label>
                    @endif
                </td>
                @if($comision->fecha_comision == null)
                    <td style="width:15%;" align="center" valign="middle"></td>
                @else
                    <td style="width:15%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_comision)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_comision)->format('d-m-Y') }}</td>
                @endif
                @if($comision->fecha_aplicada == null)
                    <td style="width:15%;" align="center" valign="middle"></td>
                @else
                    <td style="width:15%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha_aplicada)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha_aplicada)->format('d-m-Y') }}</td>
                @endif
                <td style="width:15%; font-weight: bold" align="right" valign="middle" class="comision_monto">{{ $comision->monto }}</td>
                <td style="width:5%" align="center" vertical-align="middle">
                    <a class="btn btn-danger btn-sm" class="btn-eliminar-comision" title="Quitar comisión" data-tooltip="tooltip" onclick="ConceptoComision({{ $comision->id }}, {{ $comision->monto }}, 0)"><i class="fas fa-times"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
            
        </tbody>
        <tfoot>
            <tr>
                <th colspan ="1" hidden>&nbsp;</th>
                <th colspan ="4">&nbsp;</th>
                <th>Total: </th>
                <th style="font-weight: bold; text-align: right; font-size: 15px" align="right" id="comision_total_th"></th>
                <th colspan ="3">&nbsp;</th>
            </tr>
        </tfoot>
    </table>
</div>