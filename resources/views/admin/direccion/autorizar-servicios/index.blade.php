@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Servicios</title>
@endsection
@section('styles')

@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Servicios</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Autorizar Servicios sin pago</h1>
    <input type="hidden" id="url_listar" value="{{ $url_listar }}">
    <input type="hidden" id="url_buscar" value="{{ $url_buscar }}">
    <input type="hidden" id="url_exportar" value="{{ $url_exportar }}">
    <!-- end page-header -->
    <br>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
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
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado"></div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/autorizar-servicios.js') }}"></script>
<script>
    $('#liDireccion').addClass("treeview active");
    $('#subAutorizarServicios').addClass("active");
</script>
@endsection