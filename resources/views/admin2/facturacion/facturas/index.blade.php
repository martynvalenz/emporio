@extends('admin.app')
@section('title')
<title>Emporio Legal | Facturación</title>
@endsection
@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
<style type="text/css">
    .minusculas{
    text-transform:lowercase;
    } 
    .mayusculas{
    text-transform:uppercase;
    }
    .modal 
    { 
    overflow: auto !important; 
    }
</style>
@endsection
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Facturas <label id="label-estatus" class="label label-primary">Todas</label>
        </h1>
        <input type="hidden" id="variable_estatus" value="{{ $variable_estatus }}">
        <input type="hidden" id="tipo_vista" value="{{ $tipo_vista }}">
        <input type="hidden" name="id_sesion" id="id_sesion" value="{{ Auth::user()->id }}">
        <input type="hidden" name="url_listar" id="url_listar" value="{{ $url_listar }}">
        <input type="hidden" name="url_buscar" id="url_buscar" value="{{ $url_buscar }}">
        <input type="hidden" name="url_actualizar" id="url_actualizar" value="{{ $url_actualizar }}">
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="active">Facturas</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div id="crud" class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="btn-group">
                            <a class="btn btn-primary btn-flat" data-toggle="modal" data-target="#factura-modal" data-tooltip="tooltip" onclick="Create()" title="Agregar una nueva Factura"><i class="fa fa-plus"></i> Agregar Factura
                            </a>
                            @include('admin.facturacion.facturas.factura')
                            <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
                            <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/-gWUHa5kIlw?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Estatus Cobranza</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Seleccionar Estatus
                                            <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a id="estatus_todo">Todo</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a id="estatus_pendiente" style="color: #cc9900">Pendiente</a></li>
                                                <li><a id="estatus_pagado" style="color: #339966">Pagado</a></li>
                                                <li><a id="estatus_cancelado" style="color: #cc3300">Cancelado</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Buscar</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                                        <input type="text" name="buscar" id="buscar" placeholder="Buscar..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control" autocomplete="off">
                                        <span class="input-group-btn">
                                        <a id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                                        <a id="btn-borrar" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
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
                    @include('admin.facturacion.facturas.detalles')
                    <!-- /.box-body -->
                </div>
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
<!-- sticky headers -->
<script src="{{ asset('js/jquery.stickytableheaders.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
<script src="{{ asset('archivos/facturas.js') }}"></script>
<script>
    $(document).ready(function()
    {
        $('body').tooltip(
        {
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
        $(".fancybox").fancybox();
        $(".various").fancybox(
        {
            maxWidth: 1280,
            maxHeight: 1000,
            fitToView: true,
            width: '100%',
            height: '100%',
            autoSize: false,
            closeClick: false,
            openEffect: 'none',
            closeEffect: 'none'
        });
        $('.datepicker').datepicker(
        {
            autoclose: true,
            format: 'yyyy-mm-dd'
            //format: 'dd-mm-yyyy'
        });
    });
</script>
<script>
    $('#liFacturas').addClass("treeview active");
    $('#subFacturas').addClass("active");
</script>
<script>
    $(function()
    {
        $('input').iCheck(
        {
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@endsection