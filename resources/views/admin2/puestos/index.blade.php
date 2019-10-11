@extends('admin.app')

@section('title')
<title>Emporio Legal | Puestos</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables -->
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
@endsection
@section('main-content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Puestos
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Puestos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                <a href="{{ route('puestos.create') }}" class="btn btn-azul" title="Agregar registro" data-tooltip="tooltip"><i class="fa fa-plus"></i> Agregar Puesto</a>
                <a href="{{ route('usuarios.index') }}" class="btn btn-success" title="Agregar Usuario" data-tooltip="tooltip"><i class="fa fa-user-plus"></i>Agregar Usuario</a>
                <a href="" class="btn btn-default" title="Ayuda" data-tooltip="tooltip">?</a>
              </div>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($puestos) > 0)
              <table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px">
                  <tr>
                    <th>Código</th>
                    <th>Puesto</th>
                    <th>Último Cambio</th>
                    <th>Estatus?</th>
                    <th hidden>Id</th>
                    <th colspan ="1">&nbsp;</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                @foreach($puestos as $key => $puesto)
                  <tr id="puesto{{ $puesto->id }}">
                    <td style="width:15%;" align="center" data-target="#modal-detalles-{{ $puesto->id }}" data-toggle="modal" title="Detalles">Puesto-{{ $puesto->id }}</td>
                    <td style="width:45%;" valign="middle" data-target="#modal-detalles-{{ $puesto->id }}" data-toggle="modal" title="Detalles">{{ $puesto->puesto }}</td>
                    <td style="width:20%;" valign="middle" data-target="#modal-detalles-{{ $puesto->id }}" data-toggle="modal" title="Detalles">{{ $puesto->updated_at->diffForHumans() }}</td>
                    <td style="width:10%;" align="center" valign="middle" data-target="#modal-detalles-{{ $puesto->id }}" data-toggle="modal" title="Detalles">
                      @if($puesto->estatus == 1)
                        <label class="label label-success">Activo</label>
                      @elseif($puesto->estatus ==0)
                        <label class="label label-danger">Inactivo</label>
                      @endif
                    </td>
                    <td hidden>{{ $puesto->id }}</td>
                    <td style="width:10%;" align="center">
                      <a class="btn btn-xs btn-warning" href="{{ route('puestos.edit', $puesto) }}" title="Editar" data-tooltip="tooltip">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      @if($puesto->estatus == 1)
                        <a class="btn btn-xs btn-danger" data-target="#modal-inactivar-{{ $puesto->id }}" data-toggle="modal" title="Inactivar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-close"></i>
                        </a>
                      @else
                        <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $puesto->id }}" data-toggle="modal" title="Activar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                      @endif
                    </td>
                  </tr>
                @include('admin.puestos.inactivar')
                @include('admin.puestos.activar')
                @include('admin.puestos.detalles')
                @endforeach
                </tbody>
              </table>
            @else
              <h4>No hay registros encontrados, inicie por crear uno <a data-toggle="modal" id="add" value="add">registro nuevo</a>.</h4>
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
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <script>
    $('#liUsuarios').addClass("treeview active");
    $('#liPuestos').addClass("active");
  </script>
<!-- page script -->
<script>
  $(document).ready(function() {
      $('body').tooltip({
          selector: "[data-tooltip=tooltip]",
          container: "body"
      });
  });
</script>

<script>
  $(document).ready(function() 
  {
    $('#example1').DataTable( 
    {
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
          if(aData[3] == "Activo")
          {
              $('td:eq(3)', nRow).css("background-color", "#c6efce");
              $('td:eq(3)', nRow).css("color", "#006100");
          }
          else if (aData[3] == "Inactivo")
          {
              $('td:eq(3)', nRow).css("background-color", "#ffc7ce");
              $('td:eq(3)', nRow).css("color", "#9c0006");
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