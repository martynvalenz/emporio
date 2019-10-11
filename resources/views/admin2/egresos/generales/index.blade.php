@extends('admin.app')
@section('title')
<title>Emporio Legal | Egresos</title>
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
    .datepicker,
    .varo
    {
      text-align: center
    }
</style>
@endsection
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <span id="titulo-egresos">Egresos Generales </span> <label id="label-estatus" class="label label-success">Pagados</label>
        </h1>
        <input type="hidden" id="variable_estatus" value="{{ $variable_estatus }}">
        <input type="hidden" id="tipo_egreso" value="{{ $tipo_egreso }}">
        <input type="hidden" name="id_sesion" id="id_sesion" value="{{ Auth::user()->id }}">
        <input type="hidden" name="url_listar" id="url_listar" value="{{ $url_listar }}">
        <input type="hidden" name="url_buscar" id="url_buscar" value="{{ $url_buscar }}">
        <input type="hidden" name="url_actualizar" id="url_actualizar" value="{{ $url_actualizar }}">
        <input type="hidden" name="seccion" id="seccion" value="{{ $seccion }}">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="active">Egresos en General</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div id="crud" class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="btn-group">
                            <a class="btn btn-primary" id="btn-agregar-egreso" data-target="#egresos" data-toggle="modal" data-tooltip="tooltip" title="Agregar un nuevo Egreso"><i class="fa fa-plus"></i> Agregar Egreso
                            </a>
                            @include('admin.egresos.generales.egresos')
                            <a id="btn-tarjeta-credito" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-tarjeta-credito" onclick="CreateTarjeta()"><i class="fas fa-credit-card"></i> Tarjeta de Crédito</a>
                            @include('admin.egresos.generales.tarjeta-credito')
                            <a id="btn-exportar-egresos" class="btn btn-default btn-flat"><i class="fas fa-file-excel"></i> Exportar</a>
                            <!--<a class="btn btn-info" data-target="#agregar-categoria" data-toggle="modal" data-tooltip="tooltip" title="Agregar una categoría de egresos"><i class="fas fa-bookmark"></i> Agregar Categoría
                            </a>
                            <a class="btn btn-info" data-target="#agregar-categoria" data-toggle="modal" data-tooltip="tooltip" title="Agregar una categoría de egresos"><i class="fas fa-user-plus"></i> Agregar Proveedor
                            </a>
                            <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/9xYpITZRCk0?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>-->
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Tipo de Egreso</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            Seleccionar Tipo
                                            <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a id="tipo_todos">Todo</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a id="tipo_despacho" style="color: #00B8ED">Despacho</a></li>
                                                <li><a id="tipo_hogar" style="color: #009C50">Hogar</a></li>
                                                <li><a id="tipo_personal" style="color: #F19114">Personales</a></li>
                                                <li><a id="tipo_comision" style="color: gray">Comisiones</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Estatus de Pago</label>
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
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Cuenta</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-piggy-bank"></i></span>
                                        <select id="cuenta_select" class="form-control">
                                            <option value="todo">Todas</option>
                                            @foreach($cuentas as $cuenta)
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->alias }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Formas de Pago</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-credit-card"></i></span>
                                        <select id="formas_pago_select" class="form-control">
                                            <option value="todo">Todas</option>
                                            @foreach($formas_pago as $pago)
                                                <option value="{{ $pago->id }}">{{ $pago->codigo }} - {{ $pago->forma_pago }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <label>Búsqueda por Fechas</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control pull-right" id="reservation" value="{{ $fecha_inicio }}  -  {{ $fecha_fin }}" autocomplete="off" style="text-align: center">
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
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="listado"></div>

                    </div>
                    @include('admin.egresos.cxp.pagar')
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
    <script src="{{ asset('archivos/egresos.js') }}"></script>
    <script>
        $('#liEgresos').addClass("treeview active");
        $('#subEgresos').addClass("active");
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
    <script>
    $(function() {
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    });
    </script>
    <script>
        $(document).ready(function() {
            $('.actualizar').click(function() {
                // Recargo la página
                location.reload();
            });
        });
    </script>
    <script>
        $.ajaxSetup(
        {
           headers: 
           {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });
        $('#id_cliente').on('change', function(e)
        {
            console.log(e);
        
            var id_cliente = e.target.value;
        
            //ajax
            $.get('/admin/egresos/servicios/' + id_cliente, function(data)
            {
                console.log(data);
        
                    $('#id_servicio').empty();
                    $('#id_servicio').append('<option value ="">--Sin selección--</option>');
        
                $.each(data, function(index, subcatObj)
                {
        
                    $('#id_servicio').append('<option value ="'+ subcatObj.id +'">'+subcatObj.clave+' '+subcatObj.servicio+' '+subcatObj.tramite+' '+subcatObj.clase+'</option>');
        
                });
            });
        });
    </script>
@endsection