<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Monto Total: <span class="monto-total">{{ number_format($monto_total_seleccionado, 2) }}</span></h3>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px; color:white; background-color:#218CBF">
                    <tr>
                        <th hidden>ID</th>
                        <th>Fecha</th>
                        <th>Servicio</th>
                        <th>Cliente</th>
                        <th>Tipo</th>
                        <th>Porcentaje</th>
                        <th>Comisión</th>
                        <th colspan="1">
                            <a class="btn btn-white btn-xs" onclick="Seleccionar()" title="Seleccionar todos" data-tooltip="tooltip"><i style="color: black" class="fas fa-check"></i></a>
                        </th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                    @foreach($comisiones as $key => $comision)
                    <tr id="comisioner-pendiente-{{ $comision->id }}">
                        <td hidden>{{ $comision->id }}</td>
                        <td style="width:12%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($comision->fecha)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($comision->fecha)->format('d-m-Y') }}</td>
                        <td style="width:25%;" align="left" title="{{ $comision->id_servicio }} - {{ $comision->servicio }} {{ $comision->tramite }}" data-tooltip="tooltip">{{ $comision->clave }} - {{ $comision->marca }} {{ $comision->clase }}</td>
                        <td style="width:15%;">{{ $comision->nombre_comercial }}</td>
                        <td style="width:10%;" align="center" valign="middle">
                            @if($comision->tipo_comision == 'Venta')
                                <label class="label label-success">Venta</label>
                            @elseif($comision->tipo_comision == 'Operativa')
                                <label class="label label-info">Operativa</label>
                            @elseif($comision->tipo_comision == 'Gestión')
                                <label class="label label-primary">Gestión</label>
                            @endif
                        </td>
                        <td style="width:10%;" align="center">% {{ number_format($comision->porcentaje_comision, 2) }}</td>
                        <td style="width:13%;" align="right" valign="middle">{{ number_format($comision->monto, 2) }}</td>
                        <td style="width:5%" align="center" valign="middle">
                            <div class="checkbox checkbox-css" style="text-align: center">
                                <input type="checkbox" class="checkbox_comisiones" id="comision-servicio-{{ $comision->id }}" onclick="PreseleccionarComision({{ $comision->id }}, {{ $comision->monto }})" @if($comision->preseleccionar_comision == 1) checked @else unchecked  @endif />
                                <label for="comision-servicio-{{ $comision->id }}"></label>
                            </div>
                            <input type="hidden" id="comision-servicio-id-{{ $comision->id }}" @if($comision->preseleccionar_comision == 1)  value="1" @else  value="0" @endif>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan ="4">&nbsp;</th>
                        <th>Total: </th>
                        <th style="font-weight: bold; text-align: right; font-size: 15px" align="right" class="monto-total">{{ number_format($monto_total_seleccionado, 2) }}</th>
                        <input type="hidden" id="monto_total_val" value="{{ $monto_total_seleccionado }}">
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
