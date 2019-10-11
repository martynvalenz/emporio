<div class="row">
    @if(count($egresos) > 0)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4><b>Egresos de tarjetas Pendientes</b></h4>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        
        <div class="table-responsive">
            <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px; color:white; background-color:#cc6600">
                    <tr>
                        <th hidden>ID</th>
                        <th hidden>Idcuenta</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th hidden>Factura?</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Saldo</th>
                        <th hidden>SaldoHidden</th>
                        <th>Disponible</th>
                        <th hidden>Total</th>
                        <th hidden>Subtotal</th>
                        <th hidden>IVA</th>
                        <th hidden>Pagado Ant</th>
                        <th colspan ="1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px">
                    @foreach($egresos as $key => $egreso)
                    <tr id="egreso-{{ $egreso->id }}">
                        <td hidden>{{ $egreso->id }}</td>
                        <td hidden>{{ $egreso->id_cuenta }}</td>
                        <td style="width:25%;" valign="middle" align="left" title="{{ $egreso->concepto }}" data-tooltip="tooltip">
                            @if($egreso->tipo == 'Despacho')
                                <label class="label label-info">Despacho</label> {{ $egreso->categoria }}
                            @elseif($egreso->tipo == 'Hogar')
                                <label class="label label-success">Hogar</label> {{ $egreso->categoria }}
                            @elseif($egreso->tipo == 'Personal')
                                <label class="label label-warning">Personal</label> {{ $egreso->categoria }}
                            @endif
                        </td>
                        <td style="width:20%;" valign="middle" align="left" data-tooltip="tooltip" title="{{ $egreso->razon_social }} | {{ $egreso->rfc }}">{{ $egreso->nombre_comercial }}</td>
                        <td hidden valign="middle" align="center">
                            @if($egreso->con_iva == 1)
                                <label for="con_iva" class="label label-success">SI</label>
                            @else
                                <label for="con_iva" class="label label-warning">NO</label>
                            @endif
                        </td>
                        <td style="width:10%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ $egreso->nombre }} {{ $egreso->apellido }}">{{ $egreso->iniciales }}</td>
                        @if($egreso->fecha == null)
                            <td style="width:12%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->created_at)->format('d/m/Y') }}</td>
                        @else
                            <td style="width:12%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->fecha)->format('d/m/Y') }}</td>
                        @endif
                        <td style="width: 10%" align="right">{{ number_format($egreso->saldo, 2) }}</td>
                        <td hidden>{{ $egreso->saldo }}</td>
                        <td style="width:13%; font-weight: bold;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($egreso->subtotal,2) }} | IVA: {{ number_format($egreso->iva,2) }}" contenteditable>
                            @if($restante == 0)
                                0
                            @elseif($egreso->saldo > $restante)
                                {{ $restante }}
                            @elseif($egreso->saldo <= $restante)
                                {{ $egreso->saldo }}
                            @endif
                        </td>
                        <td hidden>{{ $egreso->total }}</td>
                        <td hidden>{{ $egreso->subtotal }}</td>
                        <td hidden>{{ $egreso->iva }}</td>
                        <td hidden>{{ $egreso->pagado }}</td>
                        <td style="width:10%;" align="center">
                            <a class="btn btn-success btn-xs btn-flat btn-agregar-tarjeta" title="Agregar egreso: {{ $egreso->id }}" data-tooltip="tooltip"><i class="fas fa-check"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="font-size: 16px">
                        <th colspan="3">&nbsp;</th>
                        <th style="text-align: right">Pendiente: </th>
                        <th style="font-weight: bold; text-align: right;" align="right">{{ number_format($monto_pendiente,2) }}</th>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @else
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4>No hay registros pendientes por saldar.</h4>
        </div>
    @endif
</div>




