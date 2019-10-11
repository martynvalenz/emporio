@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Comisiones</title>
@endsection
@section('styles')

@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Comisiones</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Autorización de Comisiones</h1>
    
    <!-- end page-header -->
    <!-- begin row -->
    <input type="hidden" id="url_listar" value="{{ $url_listar }}">
    <input type="hidden" id="url_buscar" value="{{ $url_buscar }}">
    <input type="hidden" id="url_actualizar" value="{{ $url_actualizar }}">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Estatus</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                    <select name="estatus_select" id="estatus_select" class="form-control">
                        <option value="todos">Todos</option>
                        <option value="Liberada" selected>Liberadas</option>
                        <option value="Pendiente">Pendientes</option>
                        <option value="Pagada">Pagadas</option>
                        <option value="Cancelada">Canceladas</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Usuarios</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                    <select id="id_admin_filtro" class="form-control" title="Seleccionar un usuario para filtrar" data-tooltip="tooltip">
                        <option value="0">-Todos-</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                        @endforeach
                    </select>
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
                    <input type="text" name="buscar" id="buscar" placeholder="Buscar..." title="Buscar por servicio, cliente, catálogo, marca..." class="form-control">
                    <span class="input-group-btn">
                    <a id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-search" aria-hidden="true"></i> Buscar</a>
                    <a id="btn-borrar" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2 id="monto_total_comision"></h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado"></div>
        </div>
    </div>
    @include('admin.direccion.comisiones.comision')
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/comisiones-direccion.js') }}"></script>
<script>
    $('#liDireccion').addClass("active");
    $('#subDireccionComisiones').addClass("active");
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






