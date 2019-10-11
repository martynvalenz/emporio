@extends('admin.app')

@section('title')
<title>Emporio Legal | Control de marcas</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables -->
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
@endsection
@section('main-content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Marcas y nombres comerciales de: {{ $cliente->nombre_comercial }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="{{ route('clientes.index') }}"><i class="fa fa-user"></i> Clientes</a></li>
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
                <a href="{{ route('clientes.index') }}" data-tooltip="tooltip" title="Regresar al listado de clientes" class="btn btn-warning"><i class="glyphicon glyphicon-chevron-left"></i> Regresar</a>
                <a class="btn btn-azul" title="Agregar una Marca a partir de un cliente existente" data-tooltip="tooltip" data-target="#modal-create" data-toggle="modal"><i class="fa fa-plus"></i> Agregar Marca</a>
                @include('admin.clientes.marcas.create')
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($controles) > 0)
              <table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px">
                  <tr>
                    <th>ID</th>
                    <th>Marca</th>
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
                    <td style="width:60%;" valign="middle">{{ $control->nombre }}</td>
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
                    </td>
                  </tr>
                @include('admin.control.control.inactivar')
                @include('admin.control.control.activar')
                @include('admin.control.control.edit')
                @endforeach
                </tbody>
              </table>
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
  <!-- Datatables -->
  <script src="{{ asset('admin/dataTable Bootstrap/datatables.js') }}"></script>
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
    $('#subClientes').addClass("active");
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
  $(document).ready(function() 
  {
    $('#example1').DataTable( 
    {
      /*
      dom: 'Bfrtip',
        buttons: 
        [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        /*
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,



      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) 
      {
          if(aData[4] == "Activo")
          {
              $('td:eq(4)', nRow).css("background-color", "#c6efce");
              $('td:eq(4)', nRow).css("color", "#006100");
          }
          else if (aData[4] == "Inactivo")
          {
              $('td:eq(4)', nRow).css("background-color", "#ffc7ce");
              $('td:eq(4)', nRow).css("color", "#9c0006");
          }
        }*/
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