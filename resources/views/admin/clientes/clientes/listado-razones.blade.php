@if(count($razones_sociales) > 0)
<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; background-color: #218CBF; color:white">
            <tr>
                <th>Id</th>
                <th>Razón Social</th>
                <th>RFC</th>
                <th>Agregado</th>
                <th>Estatus?</th>
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($razones_sociales as $key => $razon)
            <tr id="razon-{{ $razon->id }}">
                <td style="width:10%;" valign="left">{{ $razon->id }}</td>
                <td style="width:35%;" valign="middle">{{ $razon->razon_social }}</td>
                <td style="width:17%;" valign="middle">{{ $razon->rfc }}</td>
                <td style="width:15%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($razon->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($razon->created_at)->format('d/m/Y') }}</td>
                <td style="width:8%;" align="center" valign="middle">
                    @if($razon->estatus == 1)
                        <label class="label label-success">Activa</label>
                    @elseif($razon->estatus == 0)
                        <label class="label label-danger">Inactiva</label>
                    @endif
                </td>
                <td style="width:20%;" align="center">
                    @if($razon->correo == null)
                        <a  title="Agregar correo de facturación" class="btn btn-default btn-xs" data-target="#" data-toggle="modal" data-tooltip="tooltip">
                            <i class="fa fa-envelope"></i>
                        </a>
                    @else
                        <a href="mailto: {{ $razon->correo }}" title="Enviar correo a: {{ $razon->correo }}" data-tooltip="tooltip" class="btn btn-info btn-xs">
                            <i class="fa fa-envelope"></i>
                        </a>
                    @endif

                    <a class="btn btn-xs btn-warning" data-tooltip="tooltip" title="Editar razon: {{ $razon->razon_social }}" onclick="EditarRazon({{ $razon->id }}, '{{ $razon->razon_social }}', '{{ $razon->rfc }}')">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>

                    @if($razon->estatus == 1)
                        <a class="btn btn-xs btn-danger" title="Inactivar {{ $razon->razon_social }}" data-tooltip="tooltip" onclick="InactivarRazon({{ $razon->id }})">
                            <i class="glyphicon glyphicon-eye-close"></i>
                        </a>  
                    @else
                        <a class="btn btn-xs btn-success" title="Activar {{ $razon->razon_social }}" data-tooltip="tooltip" onclick="ActivarRazon({{ $razon->id }})">
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<h4>No hay registros encontrados, inicie por crear una nueva.</h4>
@endif