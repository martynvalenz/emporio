<div class="table-responsive">
    <table id="listado-empleados-nomina-edit-table" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
        <thead style="font-size: 15px; color:white; background-color:#218CBF">
            <tr>
                <th hidden>IDEgreso</th>
                <th hidden>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Sueldo Diario</th>
                <th>Monto</th>
                <th>Creado</th>
                <th colspan="1">&nbsp;</th>
            </tr>
        </thead>
        <tbody style="font-size: 15px" id="list" name="list">
            @foreach($empleados as $key => $empleado)
            <tr id="empleado-nomina-{{ $empleado->id_egresos }}">
                <td hidden>{{ $empleado->id_egresos }}</td>
                <td hidden>{{ $empleado->id_admin }}</td>
                <td style="width: 10%"><img src="{{ asset('images/users/'.$empleado->imagen) }}" alt="Imagen" style="height: 50px; width: 50px; border-radius: 100%"></td>
                <td style="width:21%;" align="left">{{ $empleado->iniciales }} - {{ $empleado->nombre }} {{ $empleado->apellido }}</td>
                <td style="width:12%;" align="left">{{ $empleado->puesto }}</td>
                <td style="width:13%;" align="right" valign="middle">$ {{ $empleado->sueldo_diario }}</td>
                <td style="width:13%; font-weight: bold" align="right" valign="middle" contenteditable onchange="ModificarTotalesNomina()" class="nomina_monto_edit">{{ $empleado->monto }}</td>
                <td style="width:15%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($empleado->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ Carbon\Carbon::parse($empleado->created_at)->diffForHumans() }}</td>
                <td style="width:10%" align="center">
                    <div class="btn-group">
                        <a onclick="GuardarEmpleadoNomina({{ $empleado->id }})" class="btn btn-success btn-sm"><i class="fas fa-save"></i></a>
                        <a onclick="QuitarEmpleado({{ $empleado->id }})" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan ="3">&nbsp;</th>
                <th><a id="btn-calcular-total-nomina-edit" class="btn btn-info btn-sm" onclick="CalcularTotalNomina()">Calcular Total:</a></th>
                <th style="font-weight: bold; text-align: right; font-size: 15px" align="right" id="nomina_total_th-edit"></th>
                <th colspan ="1" hidden>&nbsp;</th>
            </tr>
        </tfoot>
    </table>
</div>