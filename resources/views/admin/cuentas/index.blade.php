@extends('admin.layouts.app')
@section('title')
  <title>Emporio Legal | Cuentas</title>
@endsection
@section('styles')
@endsection
@section('main-content')
<div class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Bancos</li>
    </ol>
    <h1 class="page-header">Cuentas Bancarias</h1>
    <a data-toggle="modal" data-target="#modal-cuenta" onclick="Create()" class="btn btn-primary btn-flat" title="Agregar registro" data-tooltip="tooltip"><i class="fa fa-plus"></i> Agregar</a>
    <hr>
    <!-- Main content -->
    <div id="crud" class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="listado"></div>
        </div>
        @include('admin.cuentas.cuenta')
    </div>
</div>
@endsection
@section('scripts')
  <!-- InputMask -->
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
  <script src="{{ asset('archivos/cuentas.js') }}"></script>
  <script>
      $('#liDireccion').addClass("treeview active");
      $('#liBancos').addClass("active");
  </script>
  <script>
      $(document).ready(function() {
          $('body').tooltip({
              selector: "[data-tooltip=tooltip]",
              container: "body"
          });
      });
  </script>
  <!-- page script -->
@endsection





