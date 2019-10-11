@extends('admin.app')
@section('title')
  <title>Emporio Legal | Cuentas</title>
@endsection
@section('styles')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
@endsection
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cuentas
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="active">Cuentas</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div id="crud" class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{ route('cuentas.create') }}" class="btn btn-primary btn-flat" title="Agregar registro" data-tooltip="tooltip"><i class="fa fa-plus"></i> Agregar</a>
                    </div>
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
  <!-- Bootstrap 3.3.6 -->
  <!-- Datatables -->
  <!-- Slimscroll -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
  <script src="{{ asset('archivos/cuentas.js') }}"></script>
  <script>
      $('#liEstadosCuenta').addClass("treeview active");
      $('#liCuentas').addClass("active");
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





