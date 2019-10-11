@extends('admin.app')

@section('title')
<title>Emporio Legal | Colores de Estatus</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables -->
  <link href="{{ asset('admin/dataTables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
    
@endsection
@section('main-content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Colores de Estatus
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Colores de Estatus</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                <a data-target="#modal-create" data-toggle="modal" class="btn btn-primary btn-flat" title="Agregar nuevo color" data-tooltip="tooltip"><i class="fas fa-plus"></i> Agregar</a>
                @include('admin.colores.create')
                <a href="" class="btn btn-default" title="Ayuda">?</a>
                <!--<input type="color" name="favcolor" value="#ff0000" class="form-control">-->
              </div>
                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($listado) > 0)
              <table id="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                <thead style="font-size: 15px">
                  <tr>
                    <th hidden>Id</th>
                    <th>Estatus</th>
                    <th>Categoría</th>
                    <th>Color</th>
                    <th>Texto</th>
                    <th>Agregado</th>
                    <th>Activo?</th>
                    <th colspan ="1">&nbsp;</th>
                  </tr>
                  {{ csrf_field() }}
                </thead>
                <tbody style="font-size: 15px" id="list" name="list">
                @foreach($listado as $key => $lista)
                  <tr id="lista{{ $lista->id }}">
                    <td hidden>{{ $lista->id }}</td>
                    <td style="width:15%;" valign="left"><label class="label" style="background-color: {{ $lista->color }}; color: {{ $lista->texto }}; font-size: 14px">{{ $lista->estatus }}</label></td>
                    <td style="width:20%;" valign="left">
                      {{ $lista->bitacora }}
                    </td>
                    <td style="width:10%;" align="center">{{ $lista->color }} <i class="fas fa-square" style="color: {{ $lista->color }}"></i></td>
                    <td style="width:10%;" align="center">{{ $lista->texto }} <i class="fas fa-square" style="color: {{ $lista->texto }}"></i></td>
                    <td style="width:10%;" align="center">{{ Carbon\Carbon::parse($lista->created_at)->format('d-m-Y') }}</td>
                    <td style="width:5%;" align="center" valign="middle">
                      @if($lista->activo == 1)
                        <label class="label label-success">Activo</label>
                      @elseif($lista->activo == 0)
                        <label class="label label-danger">Inactivo</label>
                      @endif
                    </td>
                    <td style="width:10%;" align="center">
                      <a class="btn btn-xs btn-warning btn-flat" data-tooltip="tooltip">
                        <i class="glyphicon glyphicon-edit"></i>
                      </a>
                      @if($lista->activo == 1)
                        <a class="btn btn-xs btn-danger btn-flat" data-target="#modal-inactivar-{{ $lista->id }}" data-toggle="modal" title="Inactivar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-close"></i>
                        </a>
                      @else
                        <a class="btn btn-xs btn-success btn-flat" data-target="#modal-activar-{{ $lista->id }}" data-toggle="modal" title="Activar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-open"></i>
                        </a>
                      @endif
                    </td>
                  </tr>
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

@section('scripts')i
  <!-- Bootstrap 3.3.6 -->
  <!-- Datatables -->
    <script src="{{ asset('admin/dataTables/js/jquery.dataTables.min.js') }}"></script>
  <!-- Slimscroll -->
  <script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('admin/js/toastr.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
  <!-- iCheck 1.0.1 -->
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('jquery-validation/dist/jquery.validate.js') }}"></script>
<script src="{{ asset('jquery-validation/dist/localization/messages_es.js') }}"></script>
  <script>
    $('#liAjustes').addClass("treeview active");
    $('#subColores').addClass("active");
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
<script>
  $("#btn_agregar").click(function()
  {
    var token = $("input[name=_token]").val();
    var formData = 
    {
      estatus: $('input[name=estatus]').val(),
      id_bitacoras_estatus: $('select[name=id_bitacoras_estatus]').val(),
      color: $('input[name=color]').val(),
      texto: $('input[name=texto]').val(),
      activo: $('select[name=activo]').val()
    }
    console.log(formData);

    $.ajax(
    {
      type: 'POST',
      headers: {'X-CSRF-TOKEN': token},
      dataType: 'json',
      url: '/admin/colores',
      data: formData,
      success: function(data)
      {
        toastr.success('Se insertó el registro existosamente.');
        $("#modal-create").modal('toggle');

        if(data.status == 422)
        {
          console.clear();
        }
      },
      error: function(data)
      {
        console.log(data);
        $("#error_estatus").html(data.responseJSON.errors.estatus);
        $("#error_estatus").fadeIn();
        toastr.error('No se pudo ingresar el registro, revise los errores en el formulario.');

        if(data.status == 422)
        {
          console.clear();
        }
      }
    });
  });

  //Limpiar error cuando se cierra ventana modal
  $("#modal-create").on("hidden.bs.modal", function()
  {
    $("#error_estatus").fadeOut();
  });
</script>



@endsection











