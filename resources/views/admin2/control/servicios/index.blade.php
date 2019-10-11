@extends('admin.app')

@section('title')
<title>Emporio Legal | Control de Servicios</title>
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
        Control de Servicios
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Control de Servicios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                <a class="btn btn-success" title="Agregar nuevo servicio" data-tooltip="tooltip" data-target="#modal-create" data-toggle="modal"><i class="fa fa-plus"></i> Servicio</a>
                <a data-target="#agregar-cliente" data-toggle="modal" class="btn btn-info" title="Agregar cliente"  data-tooltip="tooltip"><i class="fa fa-user-plus"></i> Cliente</a>
                <a data-target="#agregar-marca" data-toggle="modal" class="btn btn-info" title="Agregar marca, nombre comercial o slogan"  data-tooltip="tooltip"><i class="fa fa-plus"></i> Marca o Título</a>
                @include('admin.control.servicios.clientes')
                @include('admin.control.servicios.marcas')
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($servicios) > 0)
              <table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px">
                  <tr>
                    <th>Servicio</th>
                    <th>Trámite</th>
                    <th>Marca</th>
                    <th>Cliente</th>
                    <th>Costo</th>
                    <th>Creado</th>
                    <th>Cobranza</th>
                    <th hidden>ID</th>
                    <th colspan ="1">&nbsp;</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                @foreach($servicios as $key => $servicio)
                  <tr v-for="registro in registros">
                    <td style="width:10%;" align="center" title="{{ $servicio->CatalogoServicios->servicio }}">{{ $servicio->CatalogoServicios->clave }}</td>
                    <td style="width:20%;" valign="middle">{{ $servicio->tramite }}</td>
                    <td style="width:20%;" valign="middle">{{ $servicio->Control->nombre }}</td>
                    <td style="width:30%;" valign="middle">{{ $servicio->Cliente->nombre_comercial }}</td>
                    <td style="width:30%;" valign="middle">{{ $servicio->costo }}</td>
                    <td style="width:30%;" valign="middle">{{ $servicio->created_at }}</td>
                    <td style="width:10%;" align="center" valign="middle">{{ $servicio->estatus_cobranza }}</td>
                    <td hidden>{{ $servicio->id }}</td>
                    <td style="width:10%;" align="center">
                      <a class="btn btn-xs btn-warning" data-target="#modal-editar-{{ $servicio->id }}" data-toggle="modal" title="Editar {{ $servicio->tramite }}" data-tooltip="tooltip">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      @if($servicio->estatus_cobranza == 1)
                        <a class="btn btn-xs btn-danger" data-target="#modal-inactivar-{{ $servicio->id }}" data-toggle="modal" title="Cancelar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-close"></i>
                        </a>
                      @else
                        <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $servicio->id }}" data-toggle="modal" title="Activar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                      @endif
                    </td>
                  </tr>
                  @include('admin.control.servicios.inactivar')
                  @include('admin.control.servicios.activar')
                  @include('admin.control.servicios.edit')
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
    $('#liControl_Servicios').addClass("treeview active");
    $('#subControl_Servicios').addClass("active");
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



      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) 
      {
          if(aData[6] == "Pagado")
          {
              $('td:eq(6)', nRow).css("background-color", "#c6efce");
              $('td:eq(6)', nRow).css("color", "#006100");
          }
          else if (aData[6] == "Pendiente")
          {
              $('td:eq(6)', nRow).css("background-color", "#ffc7ce");
              $('td:eq(6)', nRow).css("color", "#9c0006");
          }
        }
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