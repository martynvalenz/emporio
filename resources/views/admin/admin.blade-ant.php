@extends('admin.layouts.app')

@section('title')

	<title>Emporio Legal: Admin</title>

@endsection

@section('styles')

@endsection

@section('main-content')
	<div id="content" class="content">
		<h1 class="page-header"><i class="fas fa-tachometer-alt"></i> Dashboard{{-- <small> Indicadores generales</small> --}}</h1>
		<input type="hidden" id="facturas_pagadas_val" value="{{ count($facturas_pagadas) }}">
		<input type="hidden" id="facturas_pendientes_val" value="{{ count($facturas_pendientes) }}">
		<input type="hidden" id="servicios_pendientes_val" value="{{ count($servicios_pendientes) }}">
		<input type="hidden" id="servicios_terminados_val" value="{{ count($servicios_terminados) }}">
		<!-- end page-header -->
		<!-- begin row -->
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<h2>Servicios pendientes en Bitácoras</h2>
			</div>
		</div>
		<div class="row">
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-orange">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title"><b>TRÁMITES NUEVOS</b></div>
						<div class="stats-number">{{ number_format(count($facturas_pendientes), 0) }}</div>
						<div class="stats-progress progress">
							<div class="progress-bar facturas_pendientes"></div>
						</div>
						<div class="stats-desc porcentaje_pagado" style="font-weight: bold"></div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-green">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title"><b>ESTUDIOS DE FACTIBILIDAD</b></div>
						<div class="stats-number">{{ number_format(count($facturas_pagadas), 0) }}</div>
						<div class="stats-progress progress">
							<div class="progress-bar facturas_pendientes"></div>
						</div>
						<div class="stats-desc porcentaje_pagado" style="font-weight: bold"></div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-orange">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title"><b>TÍTULOS Y CERTIFICADOS</b></div>
						<div class="stats-number">{{ number_format(count($servicios_pendientes), 0) }}</div>
						<div class="stats-progress progress">
							<div class="progress-bar servicios_terminados"></div>
						</div>
						<div class="stats-desc porcentaje_terminado" style="font-weight: bold"></div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-green">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title"><b>REQUISITOS Y OBJECIONES</b></div>
						<div class="stats-number">{{ number_format(count($servicios_terminados), 0) }}</div>
						<div class="stats-progress progress">
							<div class="progress-bar servicios_terminados"></div>
						</div>
						<div class="stats-desc porcentaje_terminado" style="font-weight: bold"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-green">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title"><b>NEGATIVAS</b></div>
						<div class="stats-number">{{ number_format(count($servicios_terminados), 0) }}</div>
						<div class="stats-progress progress">
							<div class="progress-bar servicios_terminados"></div>
						</div>
						<div class="stats-desc porcentaje_terminado" style="font-weight: bold"></div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
		</div>

		<div class="row">
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-orange">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title"><b>SERVICIOS PENDIENTES DE PAGAR</b></div>
						<div class="stats-number">{{ number_format(count($facturas_pendientes), 0) }}</div>
						<div class="stats-progress progress">
							<div class="progress-bar facturas_pendientes"></div>
						</div>
						<div class="stats-desc porcentaje_pagado" style="font-weight: bold"></div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-green">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title"><b>SERVICIOS PAGADOS</b></div>
						<div class="stats-number">{{ number_format(count($facturas_pagadas), 0) }}</div>
						<div class="stats-progress progress">
							<div class="progress-bar facturas_pendientes"></div>
						</div>
						<div class="stats-desc porcentaje_pagado" style="font-weight: bold"></div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-orange">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title"><b>SERVICIOS PENDIENTES</b></div>
						<div class="stats-number">{{ number_format(count($servicios_pendientes), 0) }}</div>
						<div class="stats-progress progress">
							<div class="progress-bar servicios_terminados"></div>
						</div>
						<div class="stats-desc porcentaje_terminado" style="font-weight: bold"></div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-green">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title"><b>SERVICIOS TERMINADOS</b></div>
						<div class="stats-number">{{ number_format(count($servicios_terminados), 0) }}</div>
						<div class="stats-progress progress">
							<div class="progress-bar servicios_terminados"></div>
						</div>
						<div class="stats-desc porcentaje_terminado" style="font-weight: bold"></div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
		</div>

		<hr>

		<div class="row">
		    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6" style="font-size: 16px">
		        <div class="form-group">
		            <label for="">Seleccionar Año</label>
		            <div class="input-group">
		                <span class="input-group-addon"><i>#</i></span>
		                <select name="anio" id="anio" class="form-control">
		                    @foreach($metas as $meta)
		                        <option value="{{ $meta->anio }}">{{ $meta->anio }}</option>
		                    @endforeach
		                </select>
		                <input type="hidden" id="anio_actual" value="{{ $anio_actual }}">
		            </div>
		        </div>
		    </div>
		</div>
		<br>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-inverse" data-sortable-id="index-1">
				    <div class="panel-heading">
				        <div class="panel-heading-btn">
				            {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> --}}
				            <a onclick="ServiciosMetas()" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				        </div>
				        <h4 class="panel-title">Servicios</h4>
				    </div>
				    <div class="panel-body">
				        <div id="servicios-chart" class="height-sm"></div>
				    </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-inverse" data-sortable-id="index-1">
				    <div class="panel-heading">
				        <div class="panel-heading-btn">
				            {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> --}}
				            <a onclick="VentasMetas()" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				        </div>
				        <h4 class="panel-title">Ventas mensuales ($)</h4>
				    </div>
				    <div class="panel-body">
				        <div id="ventas-chart" class="height-sm"></div>
				    </div>
				</div>
			</div>
		</div>
		@if(Auth::user()->Role->Role->id == 1 || Auth::user()->Role->Role->id == 2)
		<div class="row">
		    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
		        <div class="panel panel-inverse" data-sortable-id="index-1">
		            <div class="panel-heading">
		                <div class="panel-heading-btn">
		                    {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> --}}
		                    <a onclick="getEstadosCuenta()" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
		                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
		                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
		                </div>
		                <h4 class="panel-title">Ingresos vs Egresos</h4>
		            </div>
		            <div class="panel-body">
		                <div id="interactive-chart" class="height-sm"></div>
		            </div>
		        </div>
		    </div>
		</div>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-inverse" data-sortable-id="index-1">
				    <div class="panel-heading">
				        <div class="panel-heading-btn">
				            {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> --}}
				            <a onclick="getEgresos()" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				        </div>
				        <h4 class="panel-title">Egresos ($)</h4>
				    </div>
				    <div class="panel-body">
				        <div id="get-egresos-chart" class="height-sm"></div>
				    </div>
				</div>
			</div>
		</div>
		@endif

	</div>
@endsection

@section('scripts')

	<script src="{{ asset('admin/plugins/flot/jquery.flot.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/flot/jquery.flot.time.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/flot/jquery.flot.resize.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/flot/jquery.flot.pie.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/sparkline/jquery.sparkline.js') }}"></script>
	<script src="{{ asset('admin/plugins/jquery-jvectormap/jquery-jvectormap.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<script src="{{ asset('admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('admin/js/demo/dashboard.min.js') }}"></script>
	
	<script>
	    $('#Dashboard').addClass("active");

	    $(document).ready(function() 
	    {
	    	calcularServicios();
	    	getEstadosCuenta();	
	    	ServiciosMetas();
	    	VentasMetas();
	    	getEgresos();
	    });

	    function calcularServicios()
	    {
	    	facturas_pagadas = $('#facturas_pagadas_val').val();
	    	facturas_pendientes = $('#facturas_pendientes_val').val();
	    	facturas_pendientes = facturas_pendientes * 1;
	    	facturas_pagadas = facturas_pagadas * 1;

	    	servicios_terminados = $('#servicios_terminados_val').val();
	    	servicios_pendientes = $('#servicios_pendientes_val').val();
	    	servicios_pendientes = servicios_pendientes * 1;
	    	servicios_terminados = servicios_terminados * 1;

	    	if(facturas_pendientes == 0 && facturas_pagadas > 0)
	    	{
	    		porcentaje_pagado = 100;
	    	}
	    	else if(facturas_pendientes > 0 && facturas_pagadas == 0)
	    	{
	    		porcentaje_pagado = 0;
	    	}
	    	else if(facturas_pendientes == 0 && facturas_pagadas == 0)
	    	{
	    		porcentaje_pagado = 0;
	    	}
	    	else
	    	{
	    		
	    		total = (facturas_pagadas) + (facturas_pendientes);
	    		porcentaje_pagado = facturas_pagadas / total * 100;
	    		porcentaje_pagado = porcentaje_pagado.toFixed(2);
	    	}

	    	if(servicios_pendientes == 0 && servicios_terminados > 0)
	    	{
	    		porcentaje_terminado = 100;
	    	}
	    	else if(servicios_pendientes > 0 && servicios_terminados == 0)
	    	{
	    		porcentaje_terminado = 0;
	    	}
	    	else if(servicios_pendientes == 0 && servicios_terminados == 0)
	    	{
	    		porcentaje_terminado = 0;
	    	}
	    	else
	    	{
	    		
	    		total_avance = (servicios_terminados) + (servicios_pendientes);
	    		porcentaje_terminado = servicios_terminados / total_avance * 100;
	    		porcentaje_terminado = porcentaje_terminado.toFixed(2);
	    	}

	    	$('.facturas_pendientes').css('width', porcentaje_pagado + '%');
	    	$('.porcentaje_pagado').html('Avance: ' + porcentaje_pagado + '%');

	    	$('.servicios_terminados').css('width', porcentaje_terminado + '%');
	    	$('.porcentaje_terminado').html('Avance: ' + porcentaje_terminado + '%');
	    }

	    function getEstadosCuenta()
	    {
	        anio = $('#anio').val();

	        route = '/admin/indicadores/estados-cuenta/' + anio;

	        $.get(route, function(data)
	        {
	            //console.log(data);

	            enero = data.enero * 1;
	            febrero = data.febrero * 1;
	            marzo = data.marzo * 1;
	            abril = data.abril * 1;
	            mayo = data.mayo * 1;
	            junio = data.junio * 1;
	            julio = data.julio * 1;
	            agosto = data.agosto * 1;
	            septiembre = data.septiembre * 1;
	            octubre = data.octubre * 1;
	            noviembre = data.noviembre * 1;
	            diciembre = data.diciembre * 1;

	            enero_egresos = data.enero_egresos * 1;
	            febrero_egresos = data.febrero_egresos * 1;
	            marzo_egresos = data.marzo_egresos * 1;
	            abril_egresos = data.abril_egresos * 1;
	            mayo_egresos = data.mayo_egresos * 1;
	            junio_egresos = data.junio_egresos * 1;
	            julio_egresos = data.julio_egresos * 1;
	            agosto_egresos = data.agosto_egresos * 1;
	            septiembre_egresos = data.septiembre_egresos * 1;
	            octubre_egresos = data.octubre_egresos * 1;
	            noviembre_egresos = data.noviembre_egresos * 1;
	            diciembre_egresos = data.diciembre_egresos * 1;

	            formData =[enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre, enero_egresos, febrero_egresos, marzo_egresos, abril_egresos, mayo_egresos, junio_egresos, julio_egresos, agosto_egresos, septiembre_egresos, octubre_egresos, noviembre_egresos, diciembre_egresos]

	            max = Math.max.apply(Math,formData);

	            max = (max * 1) + 1;

	            //console.log(max);

	            "use strict";
	            function showTooltip(x, y, contents) {
	                $('<div id="tooltip" class="flot-tooltip">' + contents + '</div>').css( {
	                    top: y - 45,
	                    left: x - 55
	                }).appendTo("body").fadeIn(200);
	            }
	            if ($('#interactive-chart').length !== 0) {
	            
	                var data1 = [[1, enero], [2, febrero], [3, marzo], [4, abril], [5, mayo], [6, junio], [7, julio], [8, agosto], [9, septiembre], [10, octubre], [11, noviembre], [12, diciembre]];
	                var data2 = [[1, enero_egresos], [2, febrero_egresos], [3, marzo_egresos], [4, abril_egresos], [5, mayo_egresos], [6, junio_egresos], [7, julio_egresos], [8, agosto_egresos], [9, septiembre_egresos], [10, octubre_egresos], [11, noviembre_egresos], [12, diciembre_egresos]];
	                var xLabel = [
	                    [1, 'Enero'],[2, 'Febrero'],[3, 'Marzo'],[4, 'Abril'],[5, 'Mayo'],[6, 'Junio'],[7, 'Julio'],[8, 'Agosto'],[9, 'Septiembre'],[10, 'Octubre'],[11, 'Noviembre'],[12, 'Diciembre'],
	                ];
	                $.plot($("#interactive-chart"), [{
	                        data: data1, 
	                        label: "Ingresos", 
	                        color: COLOR_BLUE,
	                        lines: { show: true, fill:false, lineWidth: 2 },
	                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
	                        shadowSize: 0
	                    }, {
	                        data: data2,
	                        label: 'Egresos',
	                        color: COLOR_RED,
	                        lines: { show: true, fill:false, lineWidth: 2 },
	                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
	                        shadowSize: 0
	                    }], {
	                        xaxis: {  ticks:xLabel, tickDecimals: 0, tickColor: COLOR_BLACK_TRANSPARENT_2 },
	                        yaxis: {  ticks: 10, tickColor: COLOR_BLACK_TRANSPARENT_2, min: 0, max: max },
	                        grid: { 
	                        hoverable: true, 
	                        clickable: true,
	                        tickColor: COLOR_BLACK_TRANSPARENT_2,
	                        borderWidth: 1,
	                        backgroundColor: 'transparent',
	                        borderColor: COLOR_BLACK_TRANSPARENT_2
	                    },
	                    legend: {
	                        labelBoxBorderColor: COLOR_BLACK_TRANSPARENT_2,
	                        margin: 10,
	                        noColumns: 1,
	                        show: true
	                    }
	                });
	                var previousPoint = null;
	                $("#interactive-chart").bind("plothover", function (event, pos, item) {
	                    $("#x").text(pos.x.toFixed(0));
	                    $("#y").text(pos.y.toFixed(2));
	                    if (item) {
	                        if (previousPoint !== item.dataIndex) {
	                            previousPoint = item.dataIndex;
	                            $("#tooltip").remove();
	                            var y = parseFloat(item.datapoint[1], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();

	                            var content = item.series.label + " " + y;
	                            showTooltip(item.pageX, item.pageY, content);
	                        }
	                    } else {
	                        $("#tooltip").remove();
	                        previousPoint = null;            
	                    }
	                    event.preventDefault();
	                });
	            }
	        }); 
	    }

	    function ServiciosMetas()
	    {
	        anio = $('#anio').val();

	        route = '/admin/indicadores/servicios-metas/' + anio;

	        $.get(route, function(data)
	        {
	            //console.log(data);

	            enero = data.enero * 1;
	            febrero = data.febrero * 1;
	            marzo = data.marzo * 1;
	            abril = data.abril * 1;
	            mayo = data.mayo * 1;
	            junio = data.junio * 1;
	            julio = data.julio * 1;
	            agosto = data.agosto * 1;
	            septiembre = data.septiembre * 1;
	            octubre = data.octubre * 1;
	            noviembre = data.noviembre * 1;
	            diciembre = data.diciembre * 1;
	            meta_mensual = data.meta_mensual * 1;

	            formData =[enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre, meta_mensual]

	            //console.log(formData)

	            max = Math.max.apply(Math,formData);

	            max = (max * 1) + 1;

	            //console.log(max);

	            "use strict";
	            function showTooltip(x, y, contents) {
	                $('<div id="tooltip" class="flot-tooltip">' + contents + '</div>').css( {
	                    top: y - 45,
	                    left: x - 55
	                }).appendTo("body").fadeIn(200);
	            }
	            if ($('#servicios-chart').length !== 0) {
	            
	                var data1 = [[1, enero], [2, febrero], [3, marzo], [4, abril], [5, mayo], [6, junio], [7, julio], [8, agosto], [9, septiembre], [10, octubre], [11, noviembre], [12, diciembre]];
	                var data2 = [[1, meta_mensual], [2, meta_mensual], [3, meta_mensual], [4, meta_mensual], [5, meta_mensual], [6, meta_mensual], [7, meta_mensual], [8, meta_mensual], [9, meta_mensual], [10, meta_mensual], [11, meta_mensual], [12, meta_mensual]];
	                var xLabel = [
	                    [1, 'Enero'],[2, 'Febrero'],[3, 'Marzo'],[4, 'Abril'],[5, 'Mayo'],[6, 'Junio'],[7, 'Julio'],[8, 'Agosto'],[9, 'Septiembre'],[10, 'Octubre'],[11, 'Noviembre'],[12, 'Diciembre'],
	                ];
	                $.plot($("#servicios-chart"), [{
	                        data: data1, 
	                        label: "Servicios", 
	                        color: COLOR_BLUE,
	                        lines: { show: true, fill:false, lineWidth: 2 },
	                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
	                        shadowSize: 0
	                    }, {
	                        data: data2,
	                        label: 'Meta',
	                        color: COLOR_RED,
	                        lines: { show: true, fill:false, lineWidth: 2 },
	                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
	                        shadowSize: 0
	                    }], {
	                        xaxis: {  ticks:xLabel, tickDecimals: 0, tickColor: COLOR_BLACK_TRANSPARENT_2 },
	                        yaxis: {  ticks: 10, tickColor: COLOR_BLACK_TRANSPARENT_2, min: 0, max: max },
	                        grid: { 
	                        hoverable: true, 
	                        clickable: true,
	                        tickColor: COLOR_BLACK_TRANSPARENT_2,
	                        borderWidth: 1,
	                        backgroundColor: 'transparent',
	                        borderColor: COLOR_BLACK_TRANSPARENT_2
	                    },
	                    legend: {
	                        labelBoxBorderColor: COLOR_BLACK_TRANSPARENT_2,
	                        margin: 10,
	                        noColumns: 1,
	                        show: true
	                    }
	                });
	                var previousPoint = null;
	                $("#servicios-chart").bind("plothover", function (event, pos, item) {
	                    $("#x").text(pos.x.toFixed(0));
	                    $("#y").text(pos.y.toFixed(0));
	                    if (item) {
	                        if (previousPoint !== item.dataIndex) {
	                            previousPoint = item.dataIndex;
	                            $("#tooltip").remove();
	                            var y = item.datapoint[1].toFixed(0);

	                            var content = item.series.label + " " + y;
	                            showTooltip(item.pageX, item.pageY, content);
	                        }
	                    } else {
	                        $("#tooltip").remove();
	                        previousPoint = null;            
	                    }
	                    event.preventDefault();
	                });
	            }
	        }); 
	    }

	    function VentasMetas()
	    {
	        anio = $('#anio').val();

	        route = '/admin/indicadores/ventas-metas/' + anio;

	        $.get(route, function(data)
	        {
	            //console.log(data);

	            enero = data.enero * 1;
	            febrero = data.febrero * 1;
	            marzo = data.marzo * 1;
	            abril = data.abril * 1;
	            mayo = data.mayo * 1;
	            junio = data.junio * 1;
	            julio = data.julio * 1;
	            agosto = data.agosto * 1;
	            septiembre = data.septiembre * 1;
	            octubre = data.octubre * 1;
	            noviembre = data.noviembre * 1;
	            diciembre = data.diciembre * 1;
				meta_mensual = data.meta_mensual * 1;

	            formData =[enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre, meta_mensual]

	            max = Math.max.apply(Math,formData);

	            max = (max * 1) + 1;

	            //console.log(max);

	            "use strict";
	            function showTooltip(x, y, contents) {
	                $('<div id="tooltip" class="flot-tooltip">' + contents + '</div>').css( {
	                    top: y - 45,
	                    left: x - 55
	                }).appendTo("body").fadeIn(200);
	            }
	            if ($('#ventas-chart').length !== 0) {
	            
	                var data1 = [[1, enero], [2, febrero], [3, marzo], [4, abril], [5, mayo], [6, junio], [7, julio], [8, agosto], [9, septiembre], [10, octubre], [11, noviembre], [12, diciembre]];
	               	var data2 = [[1, meta_mensual], [2, meta_mensual], [3, meta_mensual], [4, meta_mensual], [5, meta_mensual], [6, meta_mensual], [7, meta_mensual], [8, meta_mensual], [9, meta_mensual], [10, meta_mensual], [11, meta_mensual], [12, meta_mensual]];
	                var xLabel = [
	                    [1, 'Enero'],[2, 'Febrero'],[3, 'Marzo'],[4, 'Abril'],[5, 'Mayo'],[6, 'Junio'],[7, 'Julio'],[8, 'Agosto'],[9, 'Septiembre'],[10, 'Octubre'],[11, 'Noviembre'],[12, 'Diciembre'],
	                ];
	                $.plot($("#ventas-chart"), [{
	                        data: data1, 
	                        label: "Ventas", 
	                        color: COLOR_BLUE,
	                        lines: { show: true, fill:false, lineWidth: 2 },
	                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
	                        shadowSize: 0
	                    }, {
	                        data: data2,
	                        label: 'Meta',
	                        color: COLOR_RED,
	                        lines: { show: true, fill:false, lineWidth: 2 },
	                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
	                        shadowSize: 0
	                    }], {
	                        xaxis: {  ticks:xLabel, tickDecimals: 0, tickColor: COLOR_BLACK_TRANSPARENT_2 },
	                        yaxis: {  ticks: 10, tickColor: COLOR_BLACK_TRANSPARENT_2, min: 0, max: max },
	                        grid: { 
	                        hoverable: true, 
	                        clickable: true,
	                        tickColor: COLOR_BLACK_TRANSPARENT_2,
	                        borderWidth: 1,
	                        backgroundColor: 'transparent',
	                        borderColor: COLOR_BLACK_TRANSPARENT_2
	                    },
	                    legend: {
	                        labelBoxBorderColor: COLOR_BLACK_TRANSPARENT_2,
	                        margin: 10,
	                        noColumns: 1,
	                        show: true
	                    }
	                });
	                var previousPoint = null;
	                $("#ventas-chart").bind("plothover", function (event, pos, item) {
	                    $("#x").text(pos.x.toFixed(0));
	                    $("#y").text(pos.y.toFixed(2));
	                    if (item) {
	                        if (previousPoint !== item.dataIndex) {
	                            previousPoint = item.dataIndex;
	                            $("#tooltip").remove();
	                            var y = parseFloat(item.datapoint[1], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();

	                            var content = item.series.label + " " + y;
	                            showTooltip(item.pageX, item.pageY, content);
	                        }
	                    } else {
	                        $("#tooltip").remove();
	                        previousPoint = null;            
	                    }
	                    event.preventDefault();
	                });
	            }
	        }); 
	    }

	    function getEgresos()
	    {
	        anio = $('#anio').val();

	        route = '/admin/indicadores/get-egresos/' + anio;

	        $.get(route, function(data)
	        {
	            //console.log(data);

	            enero_despacho = data.enero_despacho * 1;
	            febrero_despacho = data.febrero_despacho * 1;
	            marzo_despacho = data.marzo_despacho * 1;
	            abril_despacho = data.abril_despacho * 1;
	            mayo_despacho = data.mayo_despacho * 1;
	            junio_despacho = data.junio_despacho * 1;
	            julio_despacho = data.julio_despacho * 1;
	            agosto_despacho = data.agosto_despacho * 1;
	            septiembre_despacho = data.septiembre_despacho * 1;
	            octubre_despacho = data.octubre_despacho * 1;
	            noviembre_despacho = data.noviembre_despacho * 1;
	            diciembre_despacho = data.diciembre_despacho * 1;

	            enero_hogar = data.enero_hogar * 1;
	            febrero_hogar = data.febrero_hogar * 1;
	            marzo_hogar = data.marzo_hogar * 1;
	            abril_hogar = data.abril_hogar * 1;
	            mayo_hogar = data.mayo_hogar * 1;
	            junio_hogar = data.junio_hogar * 1;
	            julio_hogar = data.julio_hogar * 1;
	            agosto_hogar = data.agosto_hogar * 1;
	            septiembre_hogar = data.septiembre_hogar * 1;
	            octubre_hogar = data.octubre_hogar * 1;
	            noviembre_hogar = data.noviembre_hogar * 1;
	            diciembre_hogar = data.diciembre_hogar * 1;

	            enero_nomina = data.enero_nomina * 1;
	            febrero_nomina = data.febrero_nomina * 1;
	            marzo_nomina = data.marzo_nomina * 1;
	            abril_nomina = data.abril_nomina * 1;
	            mayo_nomina = data.mayo_nomina * 1;
	            junio_nomina = data.junio_nomina * 1;
	            julio_nomina = data.julio_nomina * 1;
	            agosto_nomina = data.agosto_nomina * 1;
	            septiembre_nomina = data.septiembre_nomina * 1;
	            octubre_nomina = data.octubre_nomina * 1;
	            noviembre_nomina = data.noviembre_nomina * 1;
	            diciembre_nomina = data.diciembre_nomina * 1;

	            enero_personal = data.enero_personal * 1;
	            febrero_personal = data.febrero_personal * 1;
	            marzo_personal = data.marzo_personal * 1;
	            abril_personal = data.abril_personal * 1;
	            mayo_personal = data.mayo_personal * 1;
	            junio_personal = data.junio_personal * 1;
	            julio_personal = data.julio_personal * 1;
	            agosto_personal = data.agosto_personal * 1;
	            septiembre_personal = data.septiembre_personal * 1;
	            octubre_personal = data.octubre_personal * 1;
	            noviembre_personal = data.noviembre_personal * 1;
	            diciembre_personal = data.diciembre_personal * 1;

	            enero_comision = data.enero_comision * 1;
	            febrero_comision = data.febrero_comision * 1;
	            marzo_comision = data.marzo_comision * 1;
	            abril_comision = data.abril_comision * 1;
	            mayo_comision = data.mayo_comision * 1;
	            junio_comision = data.junio_comision * 1;
	            julio_comision = data.julio_comision * 1;
	            agosto_comision = data.agosto_comision * 1;
	            septiembre_comision = data.septiembre_comision * 1;
	            octubre_comision = data.octubre_comision * 1;
	            noviembre_comision = data.noviembre_comision * 1;
	            diciembre_comision = data.diciembre_comision * 1;

	            formData =[enero_despacho, febrero_despacho, marzo_despacho, abril_despacho, mayo_despacho, junio_despacho, julio_despacho, agosto_despacho, septiembre_despacho, octubre_despacho, noviembre_despacho, diciembre_despacho, enero_hogar, febrero_hogar, marzo_hogar, abril_hogar, mayo_hogar, junio_hogar, julio_hogar, agosto_hogar, septiembre_hogar, octubre_hogar, noviembre_hogar, diciembre_hogar, enero_nomina, febrero_nomina, marzo_nomina, abril_nomina, mayo_nomina, junio_nomina, julio_nomina, agosto_nomina, septiembre_nomina, octubre_nomina, noviembre_nomina, diciembre_nomina, enero_despacho, febrero_personal, marzo_personal, abril_personal, mayo_personal, junio_personal, julio_personal, agosto_personal, septiembre_personal, octubre_personal, noviembre_personal, diciembre_personal, enero_comision, febrero_comision, marzo_comision, abril_comision, mayo_comision, junio_comision, julio_comision, agosto_comision, septiembre_comision, octubre_comision, noviembre_comision, diciembre_comision]

	            max = Math.max.apply(Math,formData);

	            max = (max * 1) + 1;

	            //console.log(max);

	            "use strict";
	            function showTooltip(x, y, contents) {
	                $('<div id="tooltip" class="flot-tooltip">' + contents + '</div>').css( {
	                    top: y - 45,
	                    left: x - 55
	                }).appendTo("body").fadeIn(200);
	            }
	            if ($('#get-egresos-chart').length !== 0) {
	            
	                var data1 = [[1, enero_despacho], [2, febrero_despacho], [3, marzo_despacho], [4, abril_despacho], [5, mayo_despacho], [6, junio_despacho], [7, julio_despacho], [8, agosto_despacho], [9, septiembre_despacho], [10, octubre_despacho], [11, noviembre_despacho], [12, diciembre_despacho]];
	               	var data2 = [[1, enero_hogar], [2, febrero_hogar], [3, marzo_hogar], [4, abril_hogar], [5, mayo_hogar], [6, junio_hogar], [7, julio_hogar], [8, agosto_hogar], [9, septiembre_hogar], [10, octubre_hogar], [11, noviembre_hogar], [12, diciembre_hogar]];
	               	var data3 = [[1, enero_nomina], [2, febrero_nomina], [3, marzo_nomina], [4, abril_nomina], [5, mayo_nomina], [6, junio_nomina], [7, julio_nomina], [8, agosto_nomina], [9, septiembre_nomina], [10, octubre_nomina], [11, noviembre_nomina], [12, diciembre_nomina]];
	               	var data4 = [[1, enero_personal], [2, febrero_personal], [3, marzo_personal], [4, abril_personal], [5, mayo_personal], [6, junio_personal], [7, julio_personal], [8, agosto_personal], [9, septiembre_personal], [10, octubre_personal], [11, noviembre_personal], [12, diciembre_personal]];
	               	var data5 = [[1, enero_comision], [2, febrero_comision], [3, marzo_comision], [4, abril_comision], [5, mayo_comision], [6, junio_comision], [7, julio_comision], [8, agosto_comision], [9, septiembre_comision], [10, octubre_comision], [11, noviembre_comision], [12, diciembre_comision]];
	                var xLabel = [
	                    [1, 'Enero'],[2, 'Febrero'],[3, 'Marzo'],[4, 'Abril'],[5, 'Mayo'],[6, 'Junio'],[7, 'Julio'],[8, 'Agosto'],[9, 'Septiembre'],[10, 'Octubre'],[11, 'Noviembre'],[12, 'Diciembre'],
	                ];
	                $.plot($("#get-egresos-chart"), 
	                	[
		                	{
		                        data: data1, 
		                        label: "Despacho", 
		                        color: COLOR_BLUE,
		                        lines: { show: true, fill:false, lineWidth: 2 },
		                        points: { show: true, radius: 5, fillColor: COLOR_WHITE },
		                        shadowSize: 0
		                    }, 
		                    {
		                        data: data2,
		                        label: 'Hogar',
		                        color: COLOR_RED,
		                        lines: { show: true, fill:false, lineWidth: 2 },
		                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
		                        shadowSize: 0
		                    },
		                    {
		                        data: data3,
		                        label: 'Nómina',
		                        color: COLOR_GREEN,
		                        lines: { show: true, fill:false, lineWidth: 2 },
		                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
		                        shadowSize: 0
		                    },
		                    {
		                        data: data4,
		                        label: 'Personales',
		                        color: COLOR_ORANGE,
		                        lines: { show: true, fill:false, lineWidth: 2 },
		                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
		                        shadowSize: 0
		                    },
		                    {
		                        data: data5,
		                        label: 'Comisiones',
		                        color: COLOR_YELLOW,
		                        lines: { show: true, fill:false, lineWidth: 2 },
		                        points: { show: true, radius: 3, fillColor: COLOR_WHITE },
		                        shadowSize: 0
		                    }
		                ], 
		                {
	                        xaxis: {  ticks:xLabel, tickDecimals: 0, tickColor: COLOR_BLACK_TRANSPARENT_2 },
	                        yaxis: {  ticks: 10, tickColor: COLOR_BLACK_TRANSPARENT_2, min: 0, max: max },
	                        grid: { 
	                        hoverable: true, 
	                        clickable: true,
	                        tickColor: COLOR_BLACK_TRANSPARENT_2,
	                        borderWidth: 1,
	                        backgroundColor: 'transparent',
	                        borderColor: COLOR_BLACK_TRANSPARENT_2
	                    },
	                    legend: {
	                        labelBoxBorderColor: COLOR_BLACK_TRANSPARENT_2,
	                        margin: 10,
	                        noColumns: 1,
	                        show: true
	                    }
	                });
	                var previousPoint = null;
	                $("#get-egresos-chart").bind("plothover", function (event, pos, item) {
	                    $("#x").text(pos.x.toFixed(0));
	                    $("#y").text(pos.y.toFixed(2));
	                    if (item) {
	                        if (previousPoint !== item.dataIndex) {
	                            previousPoint = item.dataIndex;
	                            $("#tooltip").remove();
	                            var y = parseFloat(item.datapoint[1], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();

	                            var content = item.series.label + " " + y;
	                            showTooltip(item.pageX, item.pageY, content);
	                        }
	                    } else {
	                        $("#tooltip").remove();
	                        previousPoint = null;            
	                    }
	                    event.preventDefault();
	                });
	            }
	        }); 
	    }
	</script>
@endsection










