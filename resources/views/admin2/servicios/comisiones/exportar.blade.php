@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Catálogo de Servicios</title>
@endsection
@section('styles')

@endsection
@section('main-content')
<div id="content" class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Exportar Catálogo</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Exportar catálogo de Servicios</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
    </div>
    <hr>
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/catalogo-servicios.js') }}"></script>
<script>
    $('#liServicios').addClass("treeview active");
    $('#liCatalogo').addClass("active");
</script>
@endsection