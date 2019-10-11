@if(count($comisiones) > 0)
{{$comisiones->render()}}
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr>
                <th hidden>ID</th>
                <th>Tipo</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Cuenta</th>
                <th>Pago</th>
                <th>Monto</th>
                <th>Estatus</th>
                <th colspan="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($comisiones as $key => $comision)
            <tr id="comision-{{ $comision->id }}">
                <td hidden>{{ $comision->id }}</td>
                <td style="width: 10%">
                    @if($comision->tipo == 'Nomina')
                        <label class="label label-primary">Nómina</label>
                    @elseif($comision->tipo == 'Comision')
                        <label class="label label-success">Comisión</label>
                    @endif
                </td>
                <td style="width:20%;" align="left">
                    @if($comision->tipo == 'Comision')
                        {{ $comision->iniciales }} - {{ $comision->nombre }} {{ $comision->apellido }}
                    @else
                        Quincena #
                    @endif
                </td>
                <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha)->format('d-m-Y') }}</td>
                <td style="width:10%;" align="center" valign="middle">{{ $comision->alias }}</td>
                <td style="width:15%;" align="center" valign="middle">{{ $comision->forma_pago }}</td>
                <td style="width:10%;" align="right" valign="middle">{{ number_format($comision->retiro, 2) }}</td>
                <td style="width:10%" align="center" valign="middle" title="" data-tooltip="tooltip">
                    @if($comision->estatus == 'Pagado')
                        <label class="label label-success">Pagado</label>
                    @elseif($comision->estatus == 'Pendiente')
                        <label class="label label-warning">Pendiente</label>
                    @elseif($comision->estatus == 'Cancelado')
                        <label class="label label-danger">Cancelado</label>
                    @endif
                </td>
                <td style="width:15%;" align="center">
                    <a class="btn btn-default btn-flat btn-xs" title="Ver detalles" data-tooltip="tooltip" onclick="DetallesComision({{ $comision->id }}, {{ $comision->id_admin }})" data-toggle="modal" data-target="#modal-detalles-comision"><i class="fas fa-list"></i></a>
                    <a class="btn btn-warning btn-flat btn-xs" title="Editar egreso" data-tooltip="tooltip" onclick="EditComision({{ $comision->id }})" data-toggle="modal" data-target="#modal-comisiones"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-flat btn-xs" title="Cancelar egreso" data-tooltip="tooltip" onclick="EliminarComision({{ $comision->id }})"><i class="fas fa-times"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$comisiones->render()}}
@else
    <h4>No se encontraron registros.</h4>
@endif