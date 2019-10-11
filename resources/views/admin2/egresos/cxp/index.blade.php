@extends('admin.app')
@section('title')
<title>Emporio Legal | Cuentas por pagar</title>
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
            <span id="titulo-egresos">Cuentas por pagar </span> <label id="label-egreso" class="label label-info">{{ $tipo_egreso }}</label>
        </h1>
        <input type="hidden" id="tipo_egreso" value="{{ $tipo_egreso }}">
        <input type="hidden" name="id_sesion" id="id_sesion" value="{{ Auth::user()->id }}">
        <input type="hidden" name="url_listar" id="url_listar" value="{{ $url_listar }}">
        <input type="hidden" name="url_buscar" id="url_buscar" value="{{ $url_buscar }}">
        <input type="hidden" name="url_actualizar" id="url_actualizar" value="{{ $url_actualizar }}">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="active">Cuentas por pagar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div id="crud" class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="btn-group">
                            <a class="btn btn-primary" id="btn-agregar-egreso" data-target="#modal-cxp" data-toggle="modal" data-tooltip="tooltip" title="Agregar un nuevo Egreso"><i class="fa fa-plus"></i> Agregar Egreso
                            </a>
                            @include('admin.egresos.cxp.cxp')
                            <a id="btn-exportar-egresos" class="btn btn-default btn-flat"><i class="fas fa-file-excel"></i> Exportar</a>
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
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        //Date picker
        $('.datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
          //format: 'dd-mm-yyyy'
        });
    </script>
    <script src="{{ asset('archivos/cuentas-por-pagar.js') }}"></script>
    <script>
        $('#liEgresos').addClass("treeview active");
        $('#subCxP').addClass("active");
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
@endsection