@extends('admin.app')

@section('title')

	<title>Emporio Legal: Menú de Estatus</title>

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

@endsection

@section('main-content')
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Menú de Estatus
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
	      <li><i class="fa fa-user-secret"></i> Home</a></li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <!-- Small boxes (Stat box) -->
	   
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-aqua">
			        <div class="inner">
			            <h3>{{ number_format(count($registro_marcas), 0) }}</h3>
			            <p>Registro de Marcas</p>
			        </div>
			        <div class="icon">
			            <i class="far fa-registered"></i>
			        </div>
			        <a href="{{ route('registro-marcas.index') }}" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-gray">
			        <div class="inner">
			            <h3>{{ number_format(count($busqueda_tecnica), 0) }}</h3>
			            <p>Búsqueda Técnica</p>
			        </div>
			        <div class="icon">
			            <i class="fab fa-searchengin"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-red">
			        <div class="inner">
			            <h3>{{ number_format(count($patentes), 0) }}</h3>
			            <p>Patentes</p>
			        </div>
			        <div class="icon">
			            <i class="fab fa-accusoft"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-yellow">
			        <div class="inner">
			            <h3>{{ number_format(count($dictamen_previo), 0) }}</h3>
			            <p>Dictamen Previo</p>
			        </div>
			        <div class="icon">
			            <i class="fas fa-file-medical-alt"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-aqua">
			        <div class="inner">
			            <h3>{{ number_format(count($registro_marca_eu), 0) }}</h3>
			            <p>Registro de Marcas EU</p>
			        </div>
			        <div class="icon">
			            <i class="far fa-registered"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-green">
			        <div class="inner">
			            <h3>{{ number_format(count($codigo_barras), 0) }}</h3>
			            <p>Códigos de Barra</p>
			        </div>
			        <div class="icon">
			            <i class="fas fa-barcode"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-blue">
			        <div class="inner">
			            <h3>{{ number_format(count($registro_obras), 0) }}</h3>
			            <p>Registro de Obras</p>
			        </div>
			        <div class="icon">
			            <i class="fas fa-building"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-purple">
			        <div class="inner">
			            <h3>{{ number_format(count($reserva_derechos), 0) }}</h3>
			            <p>Reserva de derechos</p>
			        </div>
			        <div class="icon">
			            <i class="fas fa-balance-scale"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-orange">
			        <div class="inner">
			            <h3>{{ number_format(count($aviso_comercial), 0) }}</h3>
			            <p>Aviso Comercial</p>
			        </div>
			        <div class="icon">
			            <i class="fas fa-tv"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-teal">
			        <div class="inner">
			            <h3>{{ number_format(count($juicios), 0) }}</h3>
			            <p>Juicios</p>
			        </div>
			        <div class="icon">
			            <i class="fas fa-gavel"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-maroon">
			        <div class="inner">
			            <h3>{{ number_format(count($diseno_industrial), 0) }}</h3>
			            <p>Diseño Industrial</p>
			        </div>
			        <div class="icon">
			            <i class="fas fa-industry"></i>
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			    <!-- small box -->
			    <div class="small-box bg-navy">
			        <div class="inner">
			            <h3>{{ number_format(count($franquicias), 0) }}</h3>
			            <p>Franquicias</p>
			        </div>
			        <div class="icon">
			            
			        </div>
			        <a href="" target="_blank" class="small-box-footer">Ir a Bitácora <i class="fa fa-arrow-circle-right"></i></a>
			    </div>
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
	<!-- Slimscroll -->
	<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>

	<script>
	  $('#liEstatus').addClass("treeview active");
	  $('#subEstatus').addClass("active");
	</script>
	
@endsection