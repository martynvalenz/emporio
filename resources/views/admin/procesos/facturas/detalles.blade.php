@if(count($servicios) > 0)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios  as $servicio)
                        <tr id="servicio-{{ $servicio->id }}">
                            <td style="width:10%;">{{ $servicio->id_servicio }}</td>
                            <td style="width:10%;" title="{{ $servicio->servicio }}" data-tooltip="tooltip">{{ $servicio->clave }}</td>
                            <td style="width:40%;" data-tooltip="tooltip" title="{{ $servicio->clave }} - {{ $servicio->servicio }} | {{ $servicio->tramite }} -">
                                {{ $servicio->clave }} - {{ $servicio->marca }} {{ $servicio->clase }}
                            </td>
                            <td style="width:10%;" align="center" valign="middle" title="Agregado: {{ Carbon\Carbon::parse($servicio->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($servicio->created_at)->format('d/m/Y') }}</td>
                            <td style="width: 5px" align="center" title="{{ $servicio->nombre }} {{ $servicio->apellido }}" data-tooltip="tooltip">{{ $servicio->iniciales }}</td>
                            <td style="width:15%;;" align="right" data-tooltip="tooltip">{{ number_format($servicio->monto, 2) }}</td>
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