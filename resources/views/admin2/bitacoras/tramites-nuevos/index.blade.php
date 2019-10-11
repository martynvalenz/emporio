@extends('admin.app')
@section('title')
<title>Emporio Legal | Trámites Nuevos</title>
@endsection
@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
<!-- Light Gallery Plugin Css -->
<link href="{{ asset('admin/emporio/plugins/light-gallery/css/lightgallery.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/lightbox2.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
<!-- Chosen select -->
<link rel="stylesheet" href="{{ asset('css/chosen.min.css') }}">
<!-- Styled Checkboxes -->
<link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">
<!-- Date Range Picker -->
<link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">


<style type="text/css">
    .minusculas{
    text-transform:lowercase;
    } 
    .mayusculas{
    text-transform:uppercase;
    }
    .modal { 
    overflow: auto !important; 
    }
</style>
@endsection
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Bitácora de Trámites Nuevos <label id="label-estatus" class="label label-warning">Pendientes</label>
        </h1>
        <input type="hidden" id="variable_estatus" value="{{ $variable_estatus }}">
        <input type="hidden" id="tipo_vista" value="{{ $tipo_vista }}">
        <input type="hidden" name="id_sesion" id="id_sesion" value="{{ Auth::user()->id }}">
        <input type="hidden" name="url_listar" id="url_listar" value="{{ $url_listar }}">
        <input type="hidden" name="url_buscar" id="url_buscar" value="{{ $url_buscar }}">
        <input type="hidden" name="url_actualizar" id="url_actualizar" value="{{ $url_actualizar }}">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="active">Bitácora de Trámites Nuevos</li>
        </ol>
    </section>
    <section class="content">
        <div id="crud" class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="btn-group">
                            <a data-target="#agregar-cliente" data-toggle="modal" class="btn btn-info" title="Agregar cliente nuevo" data-tooltip="tooltip"><i class="fa fa-user-plus"></i> Agregar Cliente <i class="glyphicon glyphicon-circle-arrow-right"></i></a>
                            @include('admin.procesos.clientes')
                            <a id="btn-agregar-marca" data-target="#agregar-marca" data-toggle="modal" class="btn btn-info" title="Agregar marca, obra o nombre comercial (Es opcional para crear un Servicio)" data-tooltip="tooltip"><i class="fa fa-plus"></i> Agregar Trámite <i class="glyphicon glyphicon-circle-arrow-right"></i></a>
                            @include('admin.procesos.marcas')
                            <a class="btn btn-primary" data-toggle="modal" data-target="#agregar-servicio" data-tooltip="tooltip" title="Agregar servicio" id="btn-agregar-servicio"><i class="fa fa-plus"></i> Servicio Nuevo <i class="glyphicon glyphicon-copy"></i>
                            </a>
                            @include('admin.procesos.agregar-servicio')
                            <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
                            <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/9xYpITZRCk0?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Estatus en Bitácora</label>
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
                                                <li><a id="estatus_pagado" style="color: #339966">Terminado</a></li>
                                                <li><a id="estatus_no_registro" style="color: #ff6600">No Registro</a></li>
                                                <li><a id="estatus_cancelado" style="color: #cc3300">Cancelado</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <label>Búsqueda por Fechas</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control pull-right" id="reservation" value="{{ $fecha_inicio }}  -  {{ $fecha_fin }}" autocomplete="off">
                                    <input type="hidden" name="fecha_inicio_reset" id="fecha_inicio_reset" value="{{ $fecha_inicio }}">
                                    <input type="hidden" name="fecha_fin_reset" id="fecha_fin_reset" value="{{ $fecha_fin }}">
                                </div>
                                <span class="help-block">
                                    <strong id="reservation_error" style="color:red"></strong>
                                </span>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Buscar</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                                        <input type="text" name="buscar" id="buscar" placeholder="Buscar..." title="Buscar por Servicio, cliente, responsable, trámite o marca" class="form-control">
                                        <span class="input-group-btn">
                                        <a id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                                        <a id="btn-borrar" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="box-body">
                        <div id="listado"></div>
                    </div>
                    @include('admin.procesos.detalles-facturas')
                    @include('admin.procesos.cancelar')
                    @include('admin.procesos.menu')
                    @include('admin.procesos.comentarios')

                    <!-- Modales de Bitacora -->
                    @include('admin.bitacoras.tramites-nuevos.formato')
                    @include('admin.bitacoras.tramites-nuevos.recepcion')
                    @include('admin.bitacoras.tramites-nuevos.elaboracion-expediente')
                    @include('admin.bitacoras.tramites-nuevos.estatus')
                    @include('admin.bitacoras.modal.activar')
                    @include('admin.bitacoras.modal.cancel')
                    @include('admin.bitacoras.modal.enviar-estatus')
                    
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
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
<!-- bootstrap color picker -->
<script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script src="{{ asset('js/lightbox.js') }}"></script>
<!-- Light Gallery Plugin Js -->
<script src="{{ asset('admin/emporio/plugins/light-gallery/js/lightgallery-all.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('admin/emporio/js/pages/medias/image-gallery.js') }}"></script>
<!-- sticky headers -->
<script src="{{ asset('js/jquery.stickytableheaders.min.js') }}"></script>
<!-- Chosen Jquery select -->
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>

<!-- bootstrap datepicker -->
<script src="{{ asset('admin/plugins/daterangepicker/moment.js') }}"></script>
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>


<script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
</script>
<script>
    //Date range picker
    $('#reservation').daterangepicker();

    $('#reservation').on('change', function()
    {
        FechaRango = document.getElementById('reservation').value.split('  -  ');
        fecha_inicio = FechaRango[0];
        fecha_fin = FechaRango[1];
        //console.log(fecha_inicio);
        //console.log(fecha_fin);
    });
    


    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
      //format: 'dd-mm-yyyy'
    });
</script>
<script src="{{ asset('archivos/procesos.js') }}"></script>
<script src="{{ asset('archivos/servicios.js') }}"></script>
<script src="{{ asset('archivos/bitacoras.js') }}"></script>

<script>
    $('#liBitacoras').addClass("treeview active");
    $('#subTramitesNuevos').addClass("active");
</script>
<script>
    $(document).ready(function() {
        $('.actualizar').click(function() {
            // Recargo la página
            location.reload();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() 
    {
      $(".fancybox").fancybox();
    });
</script>
<script>
    $(document).ready(function() {
      $(".various").fancybox({
        maxWidth  : 1280,
        maxHeight : 1000,
        fitToView : true,
        width   : '100%',
        height    : '100%',
        autoSize  : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
      });
    });
</script>
@endsection







