@extends('admin.app')
@section('title')
<title>Emporio Legal | Registro de Marcas</title>
@endsection
@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
<!-- Light Gallery Plugin Css -->
<link href="{{ asset('admin/emporio/plugins/light-gallery/css/lightgallery.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/lightbox2.css') }}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
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
            Registro de Marcas
        </h1>
        <input type="hidden" name="id_sesion" id="id_sesion" value="{{ Auth::user()->id }}">
        <input type="hidden" name="url_listar" id="url_listar" value="{{ $url_listar }}">
        <input type="hidden" name="url_buscar" id="url_buscar" value="{{ $url_buscar }}">
        <input type="hidden" name="url_actualizar" id="url_actualizar" value="{{ $url_actualizar }}">
        <input type="hidden" id="_token" value="{{ csrf_token() }}">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="active">Registro de Marcas</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div id="crud" class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="btn-group">
                            <a class="fancybox btn btn-default" rel="group" href="{{ asset('images/institucional/diagrama.png') }}" title="Ver diagrama de procesos" data-tooltip="tooltip"><i class="fa fa-sitemap"></i></a>
                            <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/-gWUHa5kIlw?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Filtrar por Estatus</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                                        <select id="filtro_estatus" class="form-control">
                                            <option value="todos">-Todos-</option>
                                            @foreach($estatus as $estatus)
                                                <option value="{{ $estatus->id }}" style="color: {{ $estatus->color }}">{{ $estatus->estatus }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                        {{Form::close()}}
                    </div>
                    <hr>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="listado"></div>
                    </div>
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
<script src="{{ asset('js/lightbox.js') }}"></script>
<!-- Light Gallery Plugin Js -->
<script src="{{ asset('admin/emporio/plugins/light-gallery/js/lightgallery-all.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('admin/emporio/js/pages/medias/image-gallery.js') }}"></script>
<!-- sticky headers -->
<script src="{{ asset('js/jquery.stickytableheaders.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('archivos/estatus.js') }}"></script>
<script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
</script>
<script>
    $(function() {
        $('#example1').stickyTableHeaders();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() 
    {
      $(".fancybox").fancybox();
    });
</script>
<script>
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd'
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
    $('#liEstatus').addClass("treeview active");
    $('#subRegistroMarca').addClass("active");
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
<script>
    $(document).ready(function() {
        $('.actualizar').click(function() {
            // Recargo la página
            location.reload();
        });
    });
</script>
@endsection