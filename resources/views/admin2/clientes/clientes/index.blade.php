@extends('admin.app')
@section('title')
<title>Emporio Legal | Clientes</title>
@endsection
@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
<style type="text/css">
    .minusculas{
    text-transform:lowercase;
    } 
    .mayusculas{
    text-transform:uppercase;
    }
</style>
@endsection
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clientes
        </h1>
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="active">Clientes</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div id="crud" class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="btn-group">
                            <a class="btn btn-primary btn-flat" data-tooltip="tooltip" title="Agregar registro" onclick="Create()" data-target="#modal-cliente" data-toggle="modal"><i class="fa fa-plus"></i> Agregar Cliente
                            </a>
                            @include('admin.clientes.clientes.cliente')
                            <a data-target="#modal-estrategia" data-toggle="modal" class="btn btn-info btn-flat" title="Agregar estrategia de captación" data-tooltip="tooltip"><i class="fas fa-chart-line"></i> Agregar Estrategia</a>
                            @include('admin.clientes.estrategias.estrategia')
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 div col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="buscar" placeholder="Buscar..." title="Buscar cliente por Nombre Comercial, estrategia, usuario, logo, carpeta, ..." data-tooltip="tooltip">
                                        <span class="input-group-btn">
                                        <button id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                                        <a class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda" id="btn-borrar"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="listado"></div>
                    </div>
                    
                    <!-- /.box-body -->
                </div>
                @include('admin.clientes.clientes.edit')
                @include('admin.clientes.clientes.carpeta')
                @include('admin.clientes.clientes.razones-sociales')
                @include('admin.clientes.clientes.marcas')
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('scripts')
<!-- Bootstrap 3.3.6 -->
<!-- Slimscroll -->
<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('admin/js/toastr.js') }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script src="{{ asset('js/jquery.stickytableheaders.min.js') }}"></script>
<script src="{{ asset('archivos/clientes.js') }}"></script>
<script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
</script>
<script>
    $('#liClientes').addClass("treeview active");
    $('#subClientes').addClass("active");
</script>
<script>
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    
    //Data Mask
    $("[data-mask]").inputmask();
</script>
<script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
</script>
@endsection