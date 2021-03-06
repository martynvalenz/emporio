@extends('admin.app')

@section('title')
<title>Emporio Legal | Categoría de Egresos</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables -->
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
@endsection
@section('main-content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categoría de Egresos
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Categoría</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a data-target="#modal-create" data-toggle="modal" class="btn btn-azul" title="Agregar registro" data-tooltip="tooltip"><i class="fa fa-plus"></i> Agregar</a>
              @include('admin.egresos.categorias.create')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($categorias) > 0)
              <table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px">
                  <tr>
                    <th hidden>ID</th>
                    <!--<th>Cuenta</th>
                    <th>Subcuenta</th>-->
                    <th>Categoría</th>
                    <th>Tipo</th>
                    <th>Egresos</th>
                    <th>Descripción</th>
                    <th>Estatus?</th>
                    <th colspan ="1">&nbsp;</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                @foreach($categorias as $key => $categoria)
                  <tr id="categoria{{ $categoria->id }}">
                    <td hidden align="left">{{ $categoria->id }}</td>
                    <td style="width:20%;" valign="middle">{{ $categoria->categoria }}</td>
                    <td style="width:10%;" valign="middle" align="center">
                      @if($categoria->clasificacion == 'Despacho')
                        <label class="label label-info">Despacho</label>
                      @elseif($categoria->clasificacion == 'Hogar')
                        <label class="label label-success">Hogar</label>
                      @elseif($categoria->clasificacion == 'Personal')
                        <label class="label label-warning">Personal</label>
                      @endif
                    </td>
                    <td style="width:10%;" align="right">{{ number_format($categoria->retiros, 2) }}</td>
                    <td style="width:40%;" valign="middle">{{ $categoria->descripcion }}</td>
                    <td style="width:10%;" align="center" valign="middle">
                      @if($categoria->estatus == 1)
                        <label class="label label-success">Activo</label>
                      @else
                        <label class="label label-danger">Inactivo</label>
                      @endif
                    </td>
                    <td style="width:10%;" align="center">
                      <a class="btn btn-xs btn-warning" data-target="#modal-edit-{{ $categoria->id }}" data-toggle="modal" title="Editar" data-tooltip="tooltip">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      @if($categoria->estatus == 1)
                        <a class="btn btn-xs btn-danger" data-target="#modal-inactivar-{{ $categoria->id }}" data-toggle="modal" title="Inactivar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-close"></i>
                        </a>
                      @else
                        <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $categoria->id }}" data-toggle="modal" title="Activar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                      @endif
                    </td>
                  </tr>
                @include('admin.egresos.categorias.edit')
                @include('admin.egresos.categorias.inactivar')
                @include('admin.egresos.categorias.activar')
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
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>

  <script>
    $('#liEgresos').addClass("treeview active");
    $('#subEgresosCategorias').addClass("active");
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
        "autoWidth": false,*/

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