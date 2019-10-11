@extends('admin.app')

@section('title')
<title>Emporio Legal | Control de marcas</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables -->
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
@endsection
@section('main-content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Control de Marcas
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Control de Marcas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                <a class="btn btn-success" title="Agregar una Marca a partir de un cliente existente" data-tooltip="tooltip" data-target="#modal-create" data-toggle="modal"><i class="fa fa-plus"></i> Agregar Marca</a>
                <a data-target="#agregar-cliente" data-toggle="modal" class="btn btn-info" title="Agregar cliente nuevo" data-tooltip="tooltip"><i class="fa fa-user-plus"></i> Agregar Cliente</a>
                @include('admin.control.control.create')
                @include('admin.control.control.cliente')
              </div>
            </div>

            <hr>
            <div class="container">
              <div class="row">
                <div class="col-lg-6 div col-md-6 col-sm-12 col-xs-12">
                  {!! Form::open(array('url'=>'admin/control','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}" title="Buscar cliente por Nombre Comercial, estrategia, usuario, logo, carpeta, ...">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                        <a href="{{ route('control.index') }}" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                      </span>
                    </div>
                  </div>

                  {{Form::close()}}
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {{$controles->render()}}
            @if(count($controles) > 0)
              <table class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px">
                  <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Cliente</th>
                    <th>Agregó</th>
                    <th>Agregado</th>
                    <th>Estatus?</th>
                    <th colspan ="1">&nbsp;</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                @foreach($controles as $key => $control)
                  <tr id="control{{ $control->id }}">
                    <td style="width:10%;" align="left">{{ $control->id }}</td>
                    <td style="width:30%;" valign="middle">{{ $control->nombre }}</td>
                    <td style="width:30%;" valign="middle">{{ $control->nombre_comercial }}</td>
                    <td style="width:5%;" valign="middle" align="center" data-tooltip="tooltip" title={{ $control->user }} {{ $control->apellido }}>{{ $control->iniciales }}</td>
                    <td style="width:10%;" valign="middle" align="center">{{ Carbon\Carbon::parse($control->created_at)->format('d/m/Y') }}</td>
                    <td style="width:5%;" align="center" valign="middle">
                      @if($control->estatus == 1)
                        <label class="label label-success">Activo</label>
                      @elseif($control->estatus == 0)
                        <label class="label label-danger">Inactivo</label>
                      @endif
                    </td>
                    <td style="width:10%;" align="center">
                      <a class="btn btn-xs btn-warning" data-target="#modal-editar-{{ $control->id }}" data-toggle="modal" title="Editar marca {{ $control->nombre }}" data-tooltip="tooltip">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      @if($control->estatus == 1)
                        <a class="btn btn-xs btn-danger" data-target="#modal-inactivar-{{ $control->id }}" data-toggle="modal" title="Inactivar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-close"></i>
                        </a>
                      @else
                        <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $control->id }}" data-toggle="modal" title="Activar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                      @endif
                      <a class="btn btn-xs btn-info" href="{{ route('create_servicio', $control->id) }}" title="Agregar Servicio" data-tooltip="tooltip" target="_blank">
                        <i class="far fa-hand-point-right"></i>
                      </a>
                    </td>
                  </tr>
                @include('admin.control.control.inactivar')
                @include('admin.control.control.activar')
                @include('admin.control.control.edit')
                @endforeach
                </tbody>
              </table>
              {{$controles->render()}}
            @else
              <h4>No hay registros encontrados, inicie por crear uno <a data-toggle="modal" data-target="#modal-create">registro nuevo</a>.</h4>
            @endif
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
  <!-- Slimscroll -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <!-- Vue y Axios -->
  <script src="{{ asset('js/vue.js') }}"></script>
  <script src="{{ asset('js/axios.js') }}"></script>
  
  <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
  <!-- iCheck 1.0.1 -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>

  <script>
    $('#liClientes').addClass("treeview active");
    $('#liMarcas').addClass("active");
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