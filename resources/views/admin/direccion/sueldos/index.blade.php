@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Sueldos y Salarios</title>
@endsection
@section('styles')

@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Sueldos</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Sueldos y Salarios</h1>
    
    <!-- end page-header -->
    <!-- begin row -->
    <input type="hidden" id="url_listar" value="{{ $url_listar }}">
    <input type="hidden" id="url_actualizar" value="{{ $url_actualizar }}">
    <div class="row">

        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Filtrar por Estatus</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                    <select id="estatus_select" class="form-control">
                        <option value="todos">-Todos-</option>
                        <option value="1" selected>Activos</option>
                        <option value="0">Inactivos</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado"></div>
        </div>
    </div>
    @include('admin.direccion.sueldos.empleado')
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/sueldos.js') }}"></script>
<script>
    $('#liDireccion').addClass("active");
    $('#subSueldos').addClass("active");
</script>
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






