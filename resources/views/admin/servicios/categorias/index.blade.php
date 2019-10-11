@extends('admin.layouts.app')

@section('title')

    <title>Emporio Legal: Categoría de Servicios</title>

@endsection

@section('styles')

@endsection
@section('main-content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Categorías</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Categoría de Servicios</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a data-toggle="modal" data-target="#" class="btn btn-primary" title="Agregar registro" data-tooltip="tooltip" onclick=""><i class="fa fa-plus"></i> Agregar
            </a>
            @include('admin.servicios.categorias.create')
            <hr>
            <div class="panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <!--<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>-->
                    </div>
                    <h4 class="panel-title">Estrategias</h4>
                </div>
                <div class="panel-body">
                    <div id="listado"></div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('archivos/categoria-servicios.js') }}"></script>
<script>
    $('#liServicios').addClass("active");
    $('#liCategoriaServicios').addClass("active");
</script>
<script>
  $(document).ready(function() {
      $('body').tooltip({
          selector: "[data-tooltip=tooltip]",
          container: "body"
      });
  });
</script>

@endsection

