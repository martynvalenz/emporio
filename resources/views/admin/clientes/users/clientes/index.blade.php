@extends('admin.app')

@section('title')
<title>Emporio Legal | Contactos</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables 
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
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

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contactos de cliente: {{ $cliente->nombre_comercial }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="{{ route('clientes.index') }}"><i class="fa fa-user"></i> Clientes</a></li>
        <li class="active">Contactos</li>
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
                  <a class="btn btn-azul" data-target="#users-create" data-toggle="modal" data-tooltip="tooltip" title="Agregar registro"><i class="fa fa-user-plus"></i> Agregar Contacto
                  </a>
                  @include('admin.clientes.users.clientes.create')
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
              @if(count($users) > 0)
                <div class="table-responsive">
                  <table id="example1" class="table table-striped table-bordered table-condensed table-hover <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                  <thead style="font-size: 15px">
                    <tr>
                      <th>Num</th>
                      <th>Puesto</th>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>Contraseña</th>
                      <th>Teléfono</th>
                      <th>Agregado</th>
                      <th>Estatus?</th>
                      <th colspan ="1">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody style="font-size: 15px" id="list" name="list">
                  @foreach($users as $key => $user)
                    <tr id="user{{ $user->id }}">
                      <td style="width:5%;" valign="left" title="Detalles" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">{{ $loop->index + 1 }}</td>
                      <td style="width:10%;" valign="middle" title="Detalles" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">{{ $user->titulo }}</td>
                      <td style="width:20%;" align="left" valign="middle" title="Detalles" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">{{ $user->nombre }}</td>
                      <td style="width:15%;" align="left" valign="middle" title="Enviar correo a: {{ $user->email }}"  data-tooltip="tooltip">
                        <a href="mailto: {{ $user->email }}">{{ $user->email }}</a>
                      </td>
                      @if($user->contra == null || $user->estatus == 0)
                        <td style="width:10%;" align="center" valign="middle" title="Sin acceso al sistema" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" data-tooltip="tooltip">{{ $user->contra }}</td>
                      @else
                        <td style="width:10%;" align="center" valign="middle" title="Con acceso al sistema" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" data-tooltip="tooltip">{{ $user->contra }}</td>
                      @endif
                      <td style="width:15%;" align="center" valign="middle" title="{{ $user->tipo }} {{ $user->telefono }} {{ $user->ext }}, {{ $user->tipo2 }} {{ $user->telefono2 }} {{ $user->ext2 }}, {{ $user->tipo3 }} {{ $user->telefono3 }} {{ $user->ext3 }}" data-tooltip="tooltip" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">{{ $user->telefono }} {{ $user->ext }}</td>
                      <td style="width:10%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">{{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                      <td style="width:5%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">
                        @if($user->estatus == 1)
                          <label class="label label-success">Activo</label>
                        @else
                          <label class="label label-danger">Inactivo</label>
                        @endif
                      </td>
                      <td style="width:10%;" align="center">
                        <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-editar-{{ $user->id }}" data-tooltip="tooltip" title="Editar usuario: {{ $user->nombre }}">
                          <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        @if($user->estatus == 1)
                          <a class="btn btn-xs btn-danger" data-target="#modal-inactivar-{{ $user->id }}" data-toggle="modal" title="Inactivar usuario: {{ $user->nombre }}" data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-eye-close"></i>
                          </a>
                        @else
                          <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $user->id }}" data-toggle="modal" title="Activar usuario: {{ $user->nombre }}" data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-eye-open"></i>
                          </a>
                        @endif
                        <a class="btn btn-xs btn-danger" data-target="#modal-eliminar-{{ $user->id }}" data-toggle="modal" title="Eliminar usuario: {{ $user->nombre }}" data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                      </td>
                    </tr>
                    @include('admin.clientes.users.clientes.detalles')
                    @include('admin.clientes.users.eliminar')
                    @include('admin.clientes.users.clientes.edit')
                    @include('admin.clientes.users.activar')
                    @include('admin.clientes.users.inactivar')
                  @endforeach
                  </tbody>
                </table>
                </div>
              @else
                <h4>No hay registros encontrados, inicie por crear uno registro nuevo.</h4>
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
  <!-- Datatables 
    <script src="{{ asset('admin/dataTable Bootstrap/datatables.js') }}"></script>-->
  <!-- Slimscroll -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- bootstrap color picker -->
  <script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

  <script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
  </script>

  <script>
    $('#liClientes').addClass("treeview active");
    $('#subClientes').addClass("active");
  </script>
  <script>
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });

    //Data Mask
    $("[data-mask]").inputmask();
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
  /*$(document).ready(function() 
  {
    $('#example1').DataTable( 
    {

      dom: 'Bfrtip',
        buttons: 
        [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,



      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) 
      {
          if(aData[6] == "Activo")
          {
              $('td:eq(6)', nRow).css("background-color", "#c6efce");
              $('td:eq(6)', nRow).css("color", "#006100");
          }
          else if (aData[6] == "Inactivo")
          {
              $('td:eq(6)', nRow).css("background-color", "#ffc7ce");
              $('td:eq(6)', nRow).css("color", "#9c0006");
          }
        }
    });
    
  });*/
  function cellStyle(value, row, index) {
    var classes = ['active', 'success', 'info', 'warning', 'danger'];
    if (index % 6 === 0 && index / 2 < classes.length) {
        return {
            //classes: classes[index / 2]
            css: {
                "background-color": "red",
            }
        };
    }
    return {};
}
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