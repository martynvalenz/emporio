<div class="row">
     @if(count($egresos) > 0)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h4><b>Egresos de tarjeta Pagados</b></h4>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       
        <div class="table-responsive">
            <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px; color:white; background-color:#218CBF">
                    <tr>
                        <th hidden>ID</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th>Factura?</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Pagado</th>
                        <th hidden>Subtotal</th>
                        <th hidden>IVA</th>
                        <th hidden>Total</th>
                        <th hidden>Saldo</th>
                        <th hidden>Pagado Boolean</th>
                        <th colspan ="1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px">
                    @foreach($egresos as $key => $egreso)
                    <tr id="egreso-{{ $egreso->id }}">
                        <td hidden>{{ $egreso->id }}</td>
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
                        <td style="width:10%;" valign="middle" align="center">
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
                        <td style="width:13%;" align="right" valign="middle" data-tooltip="tooltip" title="Pagado">{{ $egreso->total }}</td>
                        <td hidden>{{ $egreso->subtotal }}</td>
                        <td hidden>{{ $egreso->iva }}</td>
                        <td hidden>{{ $egreso->total }}</td>
                        <td hidden>{{ $egreso->saldo }}</td>
                        <td hidden>{{ $egreso->pagado }}</td>
                        <td style="width:10%;" align="center">
                            <a class="btn btn-danger btn-xs btn-flat btn-quitar-tarjeta" title="Quitar egreso: {{ $egreso->id }}" data-tooltip="tooltip"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="font-size: 16px">
                        <th colspan="4">&nbsp;</th>
                        <th style="text-align: right">Pagado: </th>
                        <th style="font-weight: bold; text-align: right;" align="right">{{ number_format($monto_pagado,2) }}</th>
                        <th colspan="1">&nbsp;</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @else
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h4>No hay registros pagados con este egreso.</h4>
            <br>
            <a class="btn btn-danger btn-lg" title="Cancelar egreso de tarjeta de crédito" onclick="CancelarEgreso({{ $id_egreso }})" data-tooltip="tooltip">Cancelar Egreso <i class="fas fa-times"></i></a>
        </div>
    @endif
</div>




