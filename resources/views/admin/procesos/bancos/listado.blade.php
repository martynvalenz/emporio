@if(count($estados_cuenta) > 0)
<div class="bancos-pagination">
    {{$estados_cuenta->render()}}
</div>
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th hidden>ID</th>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Proveedor/Cliente</th>
                <th>Cuenta</th>
                <th>Factura?</th>
                <th>Pago</th>
                <th>Depósito</th>
                <th>Retiro</th>
                <th>Usuario</th>
                <th>Estatus?</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list-bancos" name="list-bancos">
            @foreach($estados_cuenta as $key => $estado)
            <tr id="listado-bancos-{{ $estado->id }}">
                <td hidden>{{ $estado->id }}</td>
                <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($estado->created_at)->diffForHumans() }}" data-tooltip="tooltip">
                    <span>{{ Carbon\Carbon::parse($estado->created_at)->format('d/m/Y') }}</span>
                    {{-- <i class="fas fa-arrow-up" style="padding-left: .2em; padding-right: .2em"></i>
                    <i style="padding-left: .2em" class="fas fa-arrow-down"></i> --}}
                </td>
                <td style="width:20%;" data-tooltip="tooltip">
                    @if($estado->tipo == 'COMISION')
                        <label class="label label-dark">Comisión</label>
                    @elseif($estado->tipo == 'Despacho')
                        <label class="label label-warning">Despacho</label>
                    @elseif($estado->tipo == 'Hogar')
                        <label class="label label-green">Hogar</label>
                    @elseif($estado->tipo == 'Personal')
                        <label class="label label-info">Personal</label>
                    @elseif($estado->tipo == 'Traspaso')
                        @if($estado->tipo_movimiento == 'INGRESO')
                            <label class="label label-indigo">Traspaso</label><br>
                            {{ $estado->cuenta_traspaso }}<i style="padding-left: .5em; padding-right: .5em" class="fas fa-arrow-right"></i> {{ $estado->alias }}
                        @elseif($estado->tipo_movimiento == 'EGRESO')
                            <label class="label label-indigo">Traspaso</label><br>
                            {{ $estado->alias }}<i style="padding-left: .5em; padding-right: .5em" class="fas fa-arrow-right"></i> {{ $estado->cuenta_traspaso }}
                        @endif
                        
                    @elseif($estado->tipo == 'Nómina' || $estado->tipo == 'Aguinaldo')
                        <label class="label label-danger">{{ $estado->tipo }}</label> <br>
                         {{ Carbon\Carbon::parse($estado->fecha_ini)->format('d-m-Y') }} - {{ Carbon\Carbon::parse($estado->fecha)->format('d-m-Y') }}
                    @elseif($estado->tipo == 'INGRESO' || $estado->tipo == 'Ingreso')
                        <label class="label label-primary">Ingreso</label>
                    @endif
                    <br>
                    {{ $estado->concepto }}
                </td>
                <td style="width:13%;">
                    @if($estado->tipo_movimiento == 'EGRESO')
                        @if($estado->tipo == 'COMISION' || $estado->tipo == 'Nómina' || $estado->tipo == 'Aguinaldo')
                            {{ $estado->iniciales_comisionado }} - {{ $estado->nombre_comisionado }} {{  $estado->apellido_comisionado }}
                        @else 
                            {{ $estado->proveedor }}
                        @endif
                    @elseif($estado->tipo_movimiento == 'INGRESO')
                        {{ $estado->nombre_comercial }}
                    @endif

                </td>
                <td style="width:8%;">{{ $estado->alias }}</td>
                <td align="center">
                    @if($estado->con_iva == 1)
                        <label for="" class="label label-success">SI</label>
                    @else
                        <labe class="label label-warning">NO</labe>
                    @endif
                </td>
                <td style="width:10%;" data-tooltip="tooltip" title="{{ $estado->codigo }} - {{ $estado->forma_pago }}">
                    @if($estado->id_forma_pago == '1')
                        <label class="label label-green">{{ $estado->forma_pago }}</label>
                    @else
                        {{ $estado->forma_pago }}
                    @endif
                </td>
                @if($estado->tipo_movimiento == 'EGRESO')
                    <td style="width: 8%" align="right"><span style="color: #bfbfbf">0.00</span></td>
                    <td style="width:8%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($estado->subtotal,2) }} | IVA: {{ number_format($estado->iva,2) }}">{{ number_format($estado->retiro,2) }}</td>
                @elseif($estado->tipo_movimiento == 'INGRESO')
                    <td style="width:8%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($estado->subtotal,2) }} | IVA: {{ number_format($estado->iva,2) }}">{{ number_format($estado->deposito,2) }}</td>
                    <td style="width: 8%" align="right"><span style="color: #bfbfbf">0.00</span></td>
                @endif
                <td style="width:5%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ $estado->nombre }} {{ $estado->apellido }}">{{ $estado->iniciales }}</td>
                <td style="width:8%;" align="center" valign="middle" title="Detalles">
                    @if($estado->estatus == 'Pagado')
                        <label class="label label-success">Pagado</label>
                    @elseif($estado->estatus == 'Cancelado')
                        <label class="label label-danger" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($estado->cancelado_at)->diffForHumans() }} | {{ Carbon\Carbon::parse($estado->cancelado_at)->format('d/m/Y') }}">Cancelado</label>
                    @elseif($estado->estatus == 'Pendiente')
                        <label class="label label-warning">Pendiente</label>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="bancos-pagination">
    {{$estados_cuenta->render()}}
</div>
@else
    <h4>No se encontraron registros con el criterio de búsqueda.</h4>
@endif