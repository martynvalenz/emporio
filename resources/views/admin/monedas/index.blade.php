@extends('admin.layouts.app')
@section('title')
<title>Emporio Legal: Tipos de cambio</title>
@endsection
@section('styles')
@endsection
@section('main-content')
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.emporio') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Tipos de cambio</li>
    </ol>
    <h1 class="page-header">Tipos de cambio</h1>
    <hr>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <a href="{{ route('monedas.create') }}" class="btn btn-primary" title="Agregar registro" data-toggle="modal" data-target="#modal-create" data-tooltip="tooltip">
            <i class="fa fa-plus"></i> Agregar
            </a>
            @include('admin.monedas.create')
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($monedas as $moneda)
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <div class="panel panel-success" data-sortable-id="ui-widget-11">
                  <div class="panel-heading">
                      <h4 class="panel-title">Clave: {{ $moneda->clave }}</h4>
                  </div>
                  <div class="panel-body">
                      <p>Moneda: {{ $moneda->moneda }}</p>
                  </div>
                  <div class="hljs-wrapper">
                      <h4>Tipo de Cambio: {{ $moneda->conversion }}</h4>
                  </div>
                  <a data-target="#modal-editar-{{ $moneda->id }}" data-toggle="modal" class="btn btn-success" title="Editar tipo de cambio para {{ $moneda->moneda }}" data-tooltip="tooltip">Editar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
          </div>
          @include('admin.monedas.edit')
        @endforeach
    </div>
</div>
@endsection
@section('scripts')
<!-- iCheck 1.0.1 -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $('#liAjustes').addClass("treeview active");
    $('#liMonedas').addClass("active");
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