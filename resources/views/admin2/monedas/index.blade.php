@extends('admin.app')

@section('title')
<title>Emporio Legal | Monedas</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
@endsection
@section('main-content')

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Monedas
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Monedas</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="box-header">
      <a href="{{ route('monedas.create') }}" class="btn btn-azul" title="Agregar registro" data-toggle="modal" data-target="#modal-create" data-tooltip="tooltip">
        <i class="fa fa-plus"></i> Agregar
      </a>
      @include('admin.monedas.create')
    </div>
    <div class="box-body">
      <div class="row">
        @foreach($monedas as $moneda)
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h5>Clave: {{ $moneda->clave }}</h5>
              <h5>Moneda: {{ $moneda->moneda }}</h5>
              <h4>Tipo de Cambio: {{ $moneda->conversion }}</h4>
            </div>
            <div class="icon">
            </div>
            <a data-target="#modal-editar-{{ $moneda->id }}" data-toggle="modal" class="small-box-footer" title="Editar tipo de cambio para {{ $moneda->moneda }}" data-tooltip="tooltip">Editar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          @include('admin.monedas.edit')
        @endforeach
      </div>
    </div>
  </section>
</div>


@endsection

@section('scripts')

<!-- Bootstrap 3.3.6 -->
<!-- bootstrap color picker -->
<script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('admin/js/toastr.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<script>
  $('#liAjustes').addClass("treeview active");
  $('#liMonedas').addClass("active");
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
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
</script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
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