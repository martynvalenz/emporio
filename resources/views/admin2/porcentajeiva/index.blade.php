@extends('admin.app')

@section('title')
<title>Emporio | Porcentaje IVA</title>
@endsection

@section('styles')
  <meta name="_token" content="{{ csrf_token() }}">
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
@endsection
@section('main-content')

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $porcentaje->porcentaje_iva }}</h3>

            <p>Porcentaje IVA</p>
          </div>
          <div class="icon">
            <i class="">%</i>
          </div>
          <a data-target="#modal-editar-{{ $porcentaje->id }}" data-toggle="modal" class="small-box-footer" title="Editar porcentaje de IVA" data-tooltip="tooltip">Editar <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    @include('admin.porcentajeiva.edit')
  </section>
</div>


@endsection

@section('scripts')
  <!-- Slimscroll -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/dist/js/app.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
  <script>
    $('#liAjustes').addClass("treeview active");
    $('#liPorcentajeIVA').addClass("active");
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
    @if(Session::has('message'))
      var type="{{ Session::get('alert-type', 'info') }}";
      switch(type)
      {
        case 'info':
          toastr.info("{{ Session::get('message') }}");
          break;

        case 'warning':
          toastr.warning("{{ Session::get('message') }}");
          break;

        case 'success':
          toastr.success("{{ Session::get('message') }}");
          break;

        case 'error':
          toastr.error("{{ Session::get('message') }}");
          break;

      }
    @endif
  </script>
  @endsection