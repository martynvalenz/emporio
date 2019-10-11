@extends('admin.app')

@section('title')
<title>Emporio Legal | Formas de pago</title>
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
        Formas de Pago
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Formas de Pago</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="{{ route('formaspago.create') }}" class="btn btn-azul" title="Agregar registro" data-tooltip="tooltip"><i class="fa fa-plus"></i> Agregar</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($formas_pago) > 0)
              <table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px">
                  <tr>
                    <th>Código</th>
                    <th>Forma de Pago</th>
                    <th>Descripción</th>
                    <th>Estatus?</th>
                    <th hidden>Id</th>
                    <th colspan ="1">&nbsp;</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                @foreach($formas_pago as $key => $forma_pago)
                  <tr id="forma_pago{{ $forma_pago->id }}">
                    <td style="width:10%;" align="center">{{ $forma_pago->codigo }}</td>
                    <td style="width:25%;" valign="middle">{{ $forma_pago->forma_pago }}</td>
                    <td style="width:45%;" valign="middle">{{ $forma_pago->descripcion }}</td>
                    <td style="width:10%;" align="center" valign="middle">
                      @if($forma_pago->estatus == 1)
                        <label class="label label-success">Activa</label>
                      @elseif($forma_pago->estatus ==0)
                        <label class="label label-danger">Inactiva</label>
                      @endif
                    </td>
                    <td hidden>{{ $forma_pago->id }}</td>
                    <td style="width:10%;" align="center">
                      <a class="btn btn-xs btn-warning" href="{{ route('formaspago.edit', $forma_pago) }}" title="Editar" data-tooltip="tooltip">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      @if($forma_pago->estatus == 1)
                        <a class="btn btn-xs btn-danger" data-target="#modal-inactivar-{{ $forma_pago->id }}" data-toggle="modal" title="Inactivar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-close"></i>
                        </a>
                      @else
                        <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $forma_pago->id }}" data-toggle="modal" title="Activar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                      @endif
                    </td>
                  </tr>
                @include('admin.formaspago.inactivar')
                @include('admin.formaspago.activar')
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
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>

  <script>
    $('#liAjustes').addClass("treeview active");
    $('#liFormasPago').addClass("active");
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