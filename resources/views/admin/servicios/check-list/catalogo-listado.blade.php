<div class="row">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@if(count($requisitos) > 0)
		<table id="process-list" class="table display no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
		    <thead>
		        <tr>
		            <th hidden>ID</th>
		            <th>Orden</th>
		            <th>Área</th>
		            <th>Proceso</th>
		            <th class="centered">Venta</th>
		            <th class="centered">Operativa</th>
		            <th class="centered">Gestión</th>
		            <th class="centered">Registro</th>
		            <th colspan ="1">&nbsp;</th>
		            <th hidden>Venta</th>
		            <th hidden>Operativa</th>
		            <th hidden>Gestión</th>
		            <th hidden>Registro</th>
		            <th hidden>Idreq</th>
		            <th hidden>Idcat</th>
		        </tr>
		    </thead>
		    <tbody id="list" name="list">
		        @foreach($requisitos as $key => $requisito)
		        <tr id="requisito-{{ $requisito->id }}">
		        	<td hidden>{{ $requisito->id }}</td>
		        	<td style="width: 10%" align="center">{{ $requisito->orden }}</td>
		        	<td style="width: 20%">{{ $requisito->categoria }}</td>
		        	<td style="width: 30%">{{ $requisito->requisito }}</td>
		        	<td style="width: 8%" align="center">
		        		@if($requisito->libera_venta == 1)
		        			<label class="label label-success">Si</label>
		        		@endif
		        	</td>
		        	<td style="width: 8%" align="center">
		        		@if($requisito->libera_operativa == 1)
		        			<label class="label label-success">Si</label>
		        		@endif
		        	</td>
		        	<td style="width: 8%" align="center">
		        		@if($requisito->libera_gestion == 1)
		        			<label class="label label-success">Si</label>
		        		@endif
		        	</td>
		        	<td style="width: 8%" align="center">
		        		@if($requisito->registro == 1)
		        			<label class="label label-success"><i class="fas fa-check"></i></label>
		        		@endif
		        	</td>
		        	<td style="width: 8%" align="center" onclick="QuitarPaso({{ $requisito->id }})"><a class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a></td>
		        	<td hidden>{{ $requisito->libera_venta }}</td>
		        	<td hidden>{{ $requisito->libera_operativa }}</td>
		        	<td hidden>{{ $requisito->libera_gestion }}</td>
		        	<td hidden>{{ $requisito->id_requisitos }}</td>
		        	<td hidden>{{ $requisito->registro }}</td>
		        	<td hidden>{{ $requisito->id_catalogo_servicio }}</td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>
		@else
		    <h4>No hay registros encontrados con el criterio de búsqueda</h4>
		@endif
	</div>
	<input type="hidden" id="avance_total" value="{{ count($requisitos) }}">
</div>