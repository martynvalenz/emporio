@extends('admin.app')

@section('title')
<title>Emporio Legal | Usuarios</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables -->
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

@endsection
@section('main-content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuarios del sistema
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-user"></i>Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                <a href="{{ route('usuarios.create') }}" class="btn btn-azul" title="Agregar usuario" data-tooltip="tooltip"><i class="fa fa-user-plus"></i> Agregar</a>
                <a data-target="#puestos" data-toggle="modal" class="btn btn-success" title="Agregar puesto" data-tooltip="tooltip"><i class="fa fa-plus"></i> Puesto</a>
                @include('admin.users.puestos')
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($users) > 0)
              <table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px">
                  <tr>
                    <th>Imagen</th>
                    <th>Iniciales</th>
                    <th>Puesto</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Agregado</th>
                    <th>Estatus?</th>
                    <th hidden>Id</th>
                    <th colspan ="1">&nbsp;</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                @foreach($users as $key => $user)
                  <tr id="user{{ $user->id }}">
                    <td style="width:10%;" valign="left" align="left" title="Detalles"><img style="max-height: 50px; width: auto" src="{{ asset('images/users/'.$user->imagen) }}" alt="Imagen"></td>
                    <td style="width:5%;" align="center" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" title="Detalles">{{ $user->iniciales }}</td>
                    <td style="width:15%;" valign="middle" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" title="Detalles">{{ $user->puestos->puesto }}</td>
                    <td style="width:15%;" valign="middle" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" title="Detalles">{{ $user->nombre }} {{ $user->apellido }}</td>
                    <td style="width:20%;" valign="middle" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" title="Detalles">{{ $user->email }}</td>
                    <td style="width:10%;" valign="middle" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" title="{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}" data-tooltip="tooltip">{{ $user->created_at->diffForHumans() }}</td>
                    <td style="width:10%;" align="center" valign="middle" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" title="Detalles">
                      @if($user->estatus == 1)
                        <label class="label label-success">Activo</label>
                      @elseif($user->estatus ==0)
                        <label class="label label-danger">Inactivo</label>
                      @endif
                    </td>
                    <td hidden>{{ $user->id }}</td>
                    <td style="width:15%;" align="center">
                      @if($user->contra == null)
                        <a data-target="#modal-contra-{{ $user->id }}" data-toggle="modal" class="btn btn-xs btn-danger" title="Agregar Contraseña" data-tooltip="tooltip">
                          <i class="fa fa-key"></i>
                        </a>
                      @else
                        <a data-target="#modal-contra-{{ $user->id }}" data-toggle="modal" class="btn btn-xs btn-default" title="Cambiar Contraseña" data-tooltip="tooltip">
                          <i class="fa fa-key"></i>
                        </a>
                      @endif
                      <a href="" class="btn btn-xs btn-info" title="Gestión de accesos y permisos para {{ $user->nombre }} {{ $user->apellido }}" data-tooltip="tooltip">
                        <i class="fa fa-unlock-alt"></i>
                      </a>
                      <a class="btn btn-xs btn-warning" href="{{ route('usuarios.edit', $user) }}" title="Editar usuario {{ $user->nombre }} {{ $user->apellido }}" data-tooltip="tooltip">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      @if($user->estatus == 1)
                        <a class="btn btn-xs btn-danger" data-target="#modal-inactivar-{{ $user->id }}" data-toggle="modal" title="Inactivar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-close"></i>
                        </a>
                      @else
                        <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $user->id }}" data-toggle="modal" title="Activar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                      @endif
                    </td>
                  </tr>
                @include('admin.users.inactivar')
                @include('admin.users.activar')
                @include('admin.users.detalles')
                @include('admin.users.contra')
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
    <!-- bootstrap color picker -->
    <script src="{{ asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
  <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <!-- CK Editor -->
  <script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
  <script src="{{ asset('js/jquery.stickytableheaders.min.js') }}"></script>
  <script>
    $('#liUsuarios').addClass("treeview active");
    $('#liAdmin').addClass("active");
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
    $(function() {
        $('#example1').stickyTableHeaders();
    });
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
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
  <script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });
  </script>

<!-- page script -->

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