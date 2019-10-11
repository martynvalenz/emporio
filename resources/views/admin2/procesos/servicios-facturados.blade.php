@if(count($detalles) > 0)
<div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
    <h4>Servicios facturados</h4>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-responsive" style="font-size: 16px">
            <thead style="font-size: 15px; color:white; background-color:#218CBF">
                <tr>
                    <th>Id</th>
                    <th>Clave</th>
                    <th>Servicio</th>
                    <th>Agregado</th>
                    <th>Monto</th>
                    <th colspan="1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalles as $det)
                <tr id="det{{ $det->id }}">
                    <td style="width:10%;" valign="middle" align="left">{{ $det->id_servicio }}</td>
                    <td style="width:10%;" valign="middle" align="left" title="{{ $det->servicio }}" data-tooltip="tooltip">
                        {{ $det->clave }}
                    </td>
                    <td style="width:40%;" valign="middle" align="left">{{ $det->tramite }} {{ $det->marca }} {{ $det->id_clase }}</td>
                    <td style="width:10%;" align="center" valign="middle" title="Agregado {{ Carbon\Carbon::parse($det->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($det->created_at)->format('d/m/Y') }}</td>
                    <td style="width:15%;" valign="middle" align="right" data-tooltip="tooltip">{{ number_format($det->monto,2) }}</td>
                    <td style="width:15%;" valign="middle" align="center">
                        <button class="btn btn-warning btn-xs" data-tooltip="tooltip" title="Editar"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-xs" data-tooltip="tooltip" title="eliminar"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
    <h4>No hay servicios anexados a la factura o recibo</h4>
</div>
@endif