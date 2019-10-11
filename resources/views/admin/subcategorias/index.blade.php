@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Subcategorías</title>
@endsection
@section('styles')

@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Subcategorías</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Subcategorías</h1>
    <input type="hidden" id="url_listar" value="{{ $url_listar }}">
    <input type="hidden" id="url_buscar" value="{{ $url_buscar }}">
    <input type="hidden" id="url_actualizar" value="{{ $url_actualizar }}">
    <input type="hidden" id="url_exportar" value="{{ $url_exportar }}">
    <!-- end page-header -->
    <br>
    <a class="btn btn-primary" data-toggle="modal" data-target="#modal-subcategoria" onclick="Create()"><b><i class="fas fa-plus"></i></b> Agregar</a>
    @include('admin.subcategorias.subcategoria')
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado"></div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/subcategorias.js') }}"></script>
<script>
    $('#liServicios').addClass("treeview active");
    $('#liSubcategoria').addClass("active");
</script>
@endsection