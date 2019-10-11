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
    <h1 class="page-header">Comisiones</h1>
    <br>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a class="btn btn-primary" onclick="CargarComisionesPendientes()" data-target="#modal-gestionar" data-toggle="modal" title="Preselecciona comisiones para su pago" data-tooltip="tooltip"><i class="fas fa-plus"></i> Gestionar Comisiones</a>
            @include('admin.comisiones.gestionar-comision')
            <a class="various fancybox.iframe btn btn-default" rel="group" href="https://www.youtube.com/embed/eAwCmuTAXpk?autoplay=1" title="Video-tutorial" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <hr>
    
    <!-- end page-header -->
    <!-- begin row -->
    <ul class="nav nav-pills">
        <li class="nav-items">
            <a href="#comisiones" data-toggle="tab" class="nav-link active" onclick="ListadoComis()">
                <span class="d-sm-none">Comisiones</span>
                <span class="d-sm-block d-none">Comisiones</span>
            </a>
        </li>
        <li class="nav-items">
            <a href="#asignacion" data-toggle="tab" class="nav-link" onclick="ListadoPendientes()">
                <span class="d-sm-none">Asignación</span>
                <span class="d-sm-block d-none">Asignación</span>
            </a>
        </li>
    </ul>
    
    <div class="tab-content">
        <div class="tab-pane fade show active" id="comisiones">
            <input type="hidden" id="url_listar" value="{{ $url_listar }}">
            <input type="hidden" id="url_buscar" value="{{ $url_buscar }}">
            <input type="hidden" id="url_actualizar" value="{{ $url_actualizar }}">
            <br>
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Estatus de Comisión</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                            <select name="estatus_select" id="estatus_select" class="form-control">
                                <option value="todos">Todos</option>
                                <option value="Liberada" selected>Liberadas</option>
                                <option value="Pendiente">Pendientes</option>
                                <option value="Pagado">Pagadas</option>
                                <option value="Cancelada">Canceladas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!--<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Estatus de Servicio</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fab fa-font-awesome-flag"></i></span>
                            <select name="estatus_cobranza_select" id="estatus_cobranza_select" class="form-control">
                                <option value="todos">Todos</option>
                                <option value="Pendiente">Pendientes</option>
                                <option value="Pagado" selected>Pagados</option>
                            </select>
                        </div>
                    </div>
                </div>-->

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Usuario</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <select id="id_admin_filtro" class="form-control" title="Seleccionar un usuario para filtrar" data-tooltip="tooltip">
                                @if(Auth::user()->Role->Role->id == 1 || Auth::user()->Role->Role->id == 2 || Auth::user()->Role->Role->id == 3)
                                    <option value="0">-Todos-</option>
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->iniciales }} - {{ $admin->nombre }} {{ $admin->apellido }}</option>
                                    @endforeach
                                @else
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->iniciales }} - {{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-8 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Buscar</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-search"></i></span>
                            <input type="text" name="buscar" id="buscar" placeholder="Buscar..." title="Buscar por servicio, cliente, catálogo, marca..." class="form-control">
                            <span class="input-group-btn">
                            <a id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-check" aria-hidden="true"></i> Buscar</a>
                            <a id="btn-borrar" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="listado"></div>
            
        </div>
        <div class="tab-pane fade" id="asignacion">
            <div class="row">
                <div class="col-lg-5 col-md-8 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Buscar</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-search"></i></span>
                            <input type="text" name="buscar-asignacion" id="buscar-asignacion" placeholder="Buscar..." title="Buscar por servicio, cliente, catálogo, marca..." class="form-control">
                            <span class="input-group-btn">
                            <a id="btn-buscar-asignacion" class="btn btn-default" data-tooltip="tooltip" title="Iniciar búsqueda"><i class="fas fa-check" aria-hidden="true"></i> Buscar</a>
                            <a id="btn-borrar-asignacion" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="listado-asignacion"></div>
            
        </div>
    </div>
    @include('admin.comisiones.comision')
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/comisiones.js') }}"></script>
<script>
    $('#li-Comisiones').addClass("active");
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






