<table id="example" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
    <thead style="font-size: 15px">
        <tr>
            <th>Alias</th>
            <th>Tipo</th>
            <th>Banco</th>
            <th>Saldo Inicial</th>
            <th>Ingresos</th>
            <th>Egresos</th>
            <th>Saldo</th>
            <th>Estatus?</th>
            <th hidden>Id</th>
            <th colspan ="1">&nbsp;</th>
        </tr>
    </thead>
    <tbody style="font-size: 15px" id="list" name="list">
        @foreach($cuentas as $cuenta)
        <tr id="cuenta-{{ $cuenta->id }}">
            <td style="width:15%;" align="left" title="Ver datos de cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">{{ $cuenta->alias }}</td>
            <td style="width:10%;" valign="middle" title="Ver datos de cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">{{ $cuenta->tipo }}</td>
            <td style="width:15%;" valign="middle" title="Ver datos de cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">{{ $cuenta->banco }}</td>
            <td style="width:10%;" align="right" title="Ver datos de cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">{{ number_format($cuenta->saldo_inicial,2) }}</td>
            <td style="width:10%;" align="right" title="Ver datos de cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">{{ number_format($cuenta->ingreso, 2) }}</td>
            <td style="width:10%;" align="right" title="Ver datos de cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">{{ number_format($cuenta->egreso, 2) }}</td>
            <td @if($cuenta->saldo_inicial - $cuenta->egreso + $cuenta->ingreso >= 0) style="width:10%" @else style="width:10%; color: red" @endif align="right" title="Ver datos de cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">{{ number_format($cuenta->saldo_inicial - $cuenta->egreso + $cuenta->ingreso, 2) }}</td>
            <td style="width:10%;" align="center" valign="middle" title="Ver datos de cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">
                @if($cuenta->estatus == 1)
                    <label class="label label-success">Activa</label>
                @elseif($cuenta->estatus ==0)
                    <label class="label label-danger">Inactiva</label>
                @endif
            </td>
            <td hidden>{{ $cuenta->id }}</td>
            <td style="width:10%;" align="center">
                <a class="btn btn-xs btn-warning" href="{{ route('cuentas.edit', $cuenta->id) }}" title="Editar cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                @if($cuenta->estatus == 1)
                    <a class="btn btn-xs btn-danger" title="Inactivar cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">
                        <i class="glyphicon glyphicon-eye-close"></i>
                    </a>
                @else
                    <a class="btn btn-xs btn-success" title="Activar cuenta {{ $cuenta->alias }}" data-tooltip="tooltip">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="font-size: 15px">
            <th colspan ="2">&nbsp;</th>
            <th>Totales: </th>
            <th style="text-align: right">$ {{ number_format($saldo_inicial, 2) }}</th>
            <th style="text-align: right">$ {{ number_format($ingresos, 2) }}</th>
            <th style="text-align: right">$ {{ number_format($egresos, 2) }}</th>
            <th @if($saldo_inicial - $egresos + $ingresos >= 0) style="text-align: right; color:black" @else style="text-align: right; color:red" @endif>$ {{ number_format($saldo_inicial + $ingresos - $egresos, 2) }}</th>
            <th colspan ="3">&nbsp;</th>
        </tr>
    </tfoot>
</table>











