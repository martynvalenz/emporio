@if(count($contactos) > 0)

<div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr>
                <th hidden>ID</th>
                <th>Título</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                {{-- <th>Creado</th> --}}
                <th colspan ="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px">
            @foreach($contactos as $key => $contacto)
            <tr id="listado-contactos-{{ $contacto->id }}">
                <td hidden align="left">{{ $contacto->id }}</td>
                <td style="width:15%;">{{ $contacto->titulo }}</td>
                <td style="width:20%;">{{ $contacto->nombre }}</td>
                <td style="width:20%;" align="center">{{ $contacto->telefono }}</td>
                <td style="width:30%;">{{ $contacto->email }}</td>
                {{-- <td style="width:15%;" align="center" title="{{ Carbon\Carbon::parse($contacto->created_at)->diffForHumans() }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($contacto->created_at)->format('d-m-Y') }}</td> --}}
                <td style="width:15%;" align="center">
                    <div class="btn-group">
                        <a class="btn btn-info btn-sm" onclick="EditarContacto({{ $contacto->id }}, '{{ $contacto->nombre }}', '{{ $contacto->puesto }}', '{{ $contacto->titulo }}', '{{ $contacto->area }}', '{{ $contacto->telefono }}', '{{ $contacto->telefono2 }}', '{{ $contacto->telefono3 }}', '{{ $contacto->email }}', '{{ $contacto->email2 }}', '{{ $contacto->comentarios }}')"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" onclick="EliminarContacto({{ $contacto->id }})"><i class="fas fa-times"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<h4>No se encontraron registros.</h4>
@endif