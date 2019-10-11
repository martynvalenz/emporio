@if(count($servicios) > 0)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
        <h3>Servicios facturados</h3>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-responsive" style="font-size: 16px">
                <thead style="background-color: #218CBF; color:white">
                    <tr>
                        <th>Id</th>
                        <th>Clave</th>
                        <th>Servicio</th>
                        <th>Agregado</th>
                        <th>Usuario</th>
                        <th>Monto</th>
                        <th hidden>Monto</th>
                        <th colspan ="1">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios  as $servicio)
                        <tr id="servicio-{{ $servicio->id }}">
                            <td style="width:10%;">{{ $servicio->id }}</td>
                            <td style="width:10%;" title="{{ $servicio->servicio }}" data-tooltip="tooltip">{{ $servicio->clave }}</td>
                            <td style="width:40%;" data-tooltip="tooltip" title="{{ $servicio->tramite }}">{{ $servicio->marca }} {{ $servicio->clase }}
                            </td>
                            <td style="width:10%;" align="center" valign="middle" title="Agregado: {{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->format('d/m/Y') }}</td>
                            <td style="width: 5px" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                            <td style="width:15%;;" align="right" data-tooltip="tooltip">{{ number_format($servicio->monto, 2) }}</td>
                            <td hidden>{{ $servicio->monto }}</td>
                            <td style="width:10%;" align="center">
                                <a class="btn btn-danger btn-flat btn-xs btn-quitar-factura" title="Quitar servicio" data-tooltip="tooltip"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
        <h3>No hay servicios agregados a la factura/recibo</h3>
    </div>
@endif
