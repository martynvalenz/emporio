@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal | Clientes</title>
@endsection
@section('styles')

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
<div class="content">
    <div class="page-header-fixed" id="header"></div>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Clientes</li>
    </ol>

    <h1 class="page-header">Clientes</h1>

    <div class="btn-group">
        <a class="btn btn-primary btn-flat" data-tooltip="tooltip" title="Agregar registro" onclick="Create()" data-target="#modal-cliente" data-toggle="modal"><i class="fa fa-plus"></i> Agregar Cliente
        </a>
        @include('admin.clientes.clientes.cliente')
        <a data-target="#modal-estrategia" data-toggle="modal" class="btn btn-info btn-flat" title="Agregar estrategia de captación" data-tooltip="tooltip"><i class="fas fa-chart-line"></i> Agregar Estrategia</a>
        @include('admin.clientes.estrategias.estrategia')
    </div>
    <hr>

    <div class="row">
        <div class="col-lg-6 div col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="buscar" placeholder="Buscar..." title="Buscar cliente por Nombre Comercial, estrategia, usuario, logo, carpeta, ..." data-tooltip="tooltip">
                    <span class="input-group-btn">
                    <button id="btn-buscar" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                    <a class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda" id="btn-borrar"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado"></div>
        </div>
        @include('admin.clientes.clientes.edit')
        @include('admin.clientes.clientes.carpeta')
        @include('admin.clientes.clientes.razones-sociales')
        @include('admin.clientes.clientes.marcas')
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('archivos/clientes.js') }}"></script>
<script>
    $('#liClientes').addClass("treeview active");
    $('#subClientes').addClass("active");
</script>
@endsection