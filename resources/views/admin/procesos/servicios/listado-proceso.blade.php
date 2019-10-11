<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@if(count($requisitos) > 0)
		<table class="table display table-responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
		    <thead>
		        <tr>
		            <th>ID</th>
		            <th>Orden</th>
		            <th>Venta</th>
		            <th>Operativa</th>
		            <th>Gestión</th>
		            <th>Área</th>
		            <th>Requisito</th>
		            <th>Idreq</th>
		            <th>Idcat</th>
		        </tr>
		    </thead>
		    <tbody id="list" name="list">
		        @foreach($requisitos as $key => $requisito)
		        <tr id="requisito-{{ $requisito->id }}">
		        	<td>{{ $requisito->id }}</td>
		        	<td>{{ $requisito->orden }}</td>
		        	<td>{{ $requisito->libera_venta }}</td>
		        	<td>{{ $requisito->libera_operativa }}</td>
		        	<td>{{ $requisito->libera_gestion }}</td>
		        	<td>{{ $requisito->categoria }}</td>
		        	<td>{{ $requisito->requisito }}</td>
		        	<td>{{ $requisito->id_requisitos }}</td>
		        	<td>{{ $requisito->id_catalogo_servicio }}</td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>
		@else
		    <h4>No hay registros encontrados con el criterio de búsqueda</h4>
		@endif
	</div>
	
</div>