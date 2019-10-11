@extends('admin.app')

@section('title')

	<title>Emporio Legal: Admin</title>

@endsection

@section('styles')

	
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

@endsection

@section('main-content')
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Dashboard
				<small>Indicadores Generales</small>
			</h1>
			<ol class="breadcrumb">
				<li><i class="fas fa-home"></i> Home</a></li>
			</ol>
		</section>



		<!-- Main content -->
		<section class="content">
		<!-- Small boxes (Stat box) -->
			<div class="row">
			    <div class="col-lg-3 col-xs-6">
			        <!-- small box -->
			        <div class="small-box bg-yellow">
			            <div class="inner">
			                <h3>{{ number_format(count($facturas_pendientes), 0) }}</h3>
			                <p>Servicios Pendientes de pagar</p>
			            </div>
			            <div class="icon">
			                <i class="far fa-file-pdf"></i>
			            </div>
			            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
			        </div>
			    </div>
			    <div class="col-lg-3 col-xs-6">
			        <!-- small box -->
			        <div class="small-box bg-green">
			            <div class="inner">
			                <h3>{{ number_format(count($facturas_pagadas), 0) }}</h3>
			                <p>Servicios Pagados</p>
			            </div>
			            <div class="icon">
			                <i class="far fa-file-pdf"></i>
			            </div>
			            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
			        </div>
			    </div>
			    <div class="col-lg-3 col-xs-6">
			        <!-- small box -->
			        <div class="small-box bg-yellow">
			            <div class="inner">
			                <h3>{{ number_format(count($servicios_pendientes), 0) }}</h3>
			                <p>Servicios Pendientes</p>
			            </div>
			            <div class="icon">
			                <i class="fas fa-book"></i>
			            </div>
			            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
			        </div>
			    </div>
			    <div class="col-lg-3 col-xs-6">
			        <!-- small box -->
			        <div class="small-box bg-green">
			            <div class="inner">
			                <h3>{{ number_format(count($servicios_terminados), 0) }}</h3>
			                <p>Servicios Terminados</p>
			            </div>
			            <div class="icon">
			                <i class="fas fa-book"></i>
			            </div>
			            <a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
			        </div>
			    </div>
			</div>
			<div class="row">
			    <div class="col-lg-6 col-md-6 col-xm-12 col-xs-12">
			        <div class="box box-primary">
			            <div class="box-header with-border">
			                <i class="fas fa-chart-pie"></i>
			                <h3 class="box-title">Servicios pagados vs Servicios pendientes</h3>
			                <input type="hidden" value="{{ count($facturas_pendientes) }}" id="fact_pendientes">
			                <input type="hidden" value="{{ count($facturas_pagadas) }}" id="fact_pagadas">
			                <div class="box-tools pull-right">
			                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			                    </button>
			                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			                </div>
			            </div>
			            <div class="box-body">
			                <div id="donut-chart" style="height: 300px;"></div>
			            </div>
			            <!-- /.box-body-->
			        </div>
			    </div>
			    <div class="col-lg-6 col-md-6 col-xm-12 col-xs-12">
			        <div class="box box-primary">
			            <div class="box-header with-border">
			                <i class="fas fa-chart-pie"></i>
			                <h3 class="box-title">Comparativo de Servicios</h3>
			                <input type="hidden" value="{{ count($servicios_pendientes) }}" id="serv_pendientes">
			                <input type="hidden" value="{{ count($servicios_terminados) }}" id="serv_terminados">
			                <div class="box-tools pull-right">
			                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			                    </button>
			                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			                </div>
			            </div>
			            <div class="box-body">
			                <div id="donut-chart2" style="height: 300px;"></div>
			            </div>
			            <!-- /.box-body-->
			        </div>
			    </div>

		</section>
		<!-- /.content -->
	</div>
@endsection

@section('scripts')

	
	<!-- Morris.js charts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>
	<!-- Sparkline -->
	<script src="{{ asset('admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
	<!-- jvectormap -->
	<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
	<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<!-- jQuery Knob Chart -->
	<script src="{{ asset('admin/plugins/knob/jquery.knob.js') }}"></script>
	<!-- daterangepicker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
	<!-- datepicker -->
	<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
	<!-- Slimscroll -->
	<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
	<!-- FLOT CHARTS -->
	<script src="{{ asset('admin/plugins/flot/jquery.flot.min.js') }}"></script>
	<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
	<script src="{{ asset('admin/plugins/flot/jquery.flot.pie.min.js') }}"></script>
	<script>
		$(document).ready(function()
		{
			var fact_pendientes;
			var fact_pagadas;

			fact_pendientes = $('#fact_pendientes').val();
			fact_pagadas = $('#fact_pagadas').val();

			var donutData = [
			  {label: "Pendientes", data: fact_pendientes, color: "#FE9800"},
			  {label: "Pagados", data: fact_pagadas, color: "#00B05B"}
			];
			$.plot("#donut-chart", donutData, {
			  series: 
			  {
				pie: 
				{
				  show: true,
				  radius: 1,
				  innerRadius: 0.4,
				  label: 
				  {
					show: true,
					radius: 2/3,
					formatter: labelFormatter,
					threshold: 0.1
				  }

				}
			  },
			  legend: {
				show: true
			  }
			});
		});

		function labelFormatter(label, series) 
		{
		  return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
			  + label
			  + "<br>"
			  + Math.round(series.percent) + "%</div>";
		}
	</script>
	<script>
		$(document).ready(function()
		{
			var serv_pendientes;
			var serv_terminados;

			serv_pendientes = $('#serv_pendientes').val();
			serv_terminados = $('#serv_terminados').val();

			var donutData = [
			  {label: "Pendientes", data: serv_pendientes, color: "#FE9800"},
			  {label: "Terminados", data: serv_terminados, color: "#00B05B"}
			];
			$.plot("#donut-chart2", donutData, {
			  series: 
			  {
				pie: 
				{
				  show: true,
				  radius: 1,
				  innerRadius: 0.4,
				  label: 
				  {
					show: true,
					radius: 2/3,
					formatter: labelFormatter,
					threshold: 0.1
				  }

				}
			  },
			  legend: {
				show: true
			  }
			});
		});

		function labelFormatter(label, series) 
		{
		  return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
			  + label
			  + "<br>"
			  + Math.round(series.percent) + "%</div>";
		}
	</script>
		

	
@endsection

















