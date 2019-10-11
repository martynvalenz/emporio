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
    <!-- bootstrap wysihtml5 - text editor 
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">-->
    <style type="text/css">
      .minusculas{
        text-transform:lowercase;
      } 
      .mayusculas{
        text-transform:uppercase;
      }
    </style>
    <style>
       #loader
       {
          visibility:hidden;
       }
    </style>

@endsection
@section('main-content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Clientes/Contactos
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                <a class="btn btn-azul" data-target="#users-create" data-toggle="modal" data-tooltip="tooltip" title="Agregar registro"><i class="fa fa-user-plus"></i> Agregar Usuario
                </a>
                  @include('admin.clientes.users.create-user')
                <a class="btn btn-default" title="Ayuda" data-tooltip="tooltip"><i class="fab fa-youtube"></i></a>
              </div>
            </div>

            <hr>
            <div class="container">
              <div class="row">
                <div class="col-lg-6 div col-md-6 col-sm-12 col-xs-12">
                  {!! Form::open(array('url'=>'admin/clientes-users','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}" title="Buscar cliente por nombre, área, Puesto, título, números de teléfono, empresa, RFC o razón social...">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                        <a href="{{ route('clientes-users.index') }}" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                      </span>
                    </div>
                  </div>

                  {{Form::close()}}
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {{$users->render()}}
            @if(count($users) > 0)
              <div class="table-responsive">
                <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                  <thead style="font-size: 15px">
                    <tr>
                      <th>Num</th>
                      <th>Nombre</th>
                      <th>Empresa</th>
                      <th>Email</th>
                      <th>Contraseña</th>
                      <th>Teléfono</th>
                      <th>Creado</th>
                      <th>Estatus?</th>
                      <th hidden>ID</th>
                      <th colspan ="1">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody style="font-size: 15px" id="list" name="list">
                  @foreach($users as $key => $user)
                    <tr id="user{{ $user->id }}">
                      <td style="width:5%;" valign="left" data-target="#modal-detalles-{{ $user->id }}" title="Detalles de {{ $user->id }}" data-toggle="modal">{{ $loop->index + 1 }}</td>
                      <td style="width:15%;" valign="middle" title="Detalles de {{ $user->nombre }}" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">{{ $user->nombre }}</td>
                      <td style="width:15%;" valign="middle" title="Detalles de {{ $user->nombre }}" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">{{ $user->nombre_comercial }}</td>
                      <td style="width:15%;" valign="middle" title="Detalles de {{ $user->nombre }}"><a href="mailto: {{ $user->email }}">{{ $user->email }}</a></td>
                      <td style="width:10%;" valign="middle" title="Detalles de {{ $user->nombre }}" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">{{ $user->contra }}</td>
                      <td style="width:10%;" valign="middle" title="Detalles de {{ $user->nombre }}" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">{{ $user->telefono }}</td>
                      <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                      <td style="width:5%;" align="center" valign="middle" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal">
                        @if($user->estatus == '1')
                          <label class="label label-success">Activo</label>
                        @else
                          <label class="label label-danger">Inactivo</label>
                        @endif    
                      </td>
                      <td hidden>{{ $user->id }}</td>
                      <td style="width:10%;" align="center">
                        <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-editar-{{ $user->id }}" data-tooltip="tooltip" title="Editar usuario: {{ $user->nombre }}">
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
                        <a class="btn btn-xs btn-danger" data-target="#modal-eliminar-{{ $user->id }}" data-toggle="modal" title="Eliminar usuario: {{ $user->nombre }}" data-tooltip="tooltip">
                            <i class="glyphicon glyphicon-trash"></i>
                          </a>
                      </td>
                    </tr>
                    @include('admin.clientes.users.detalles-user')
                    @include('admin.clientes.users.eliminar')
                    @include('admin.clientes.users.edit-user')
                    @include('admin.clientes.users.activar')
                    @include('admin.clientes.users.inactivar')
                  @endforeach
                  </tbody>
                </table>
              </div>
              {{$users->render()}}
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
  <!-- Bootstrap WYSIHTML5 
  <script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>-->
  <!-- CK Editor 
  <script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>
  <script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });
  </script>-->

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
    $('#liClientesUsers').addClass("active");
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
<!--<script>
   $("#idcli").change(function(event)
   {
      $.get("/clientes/razones/usuarios/" + event.target.value + "", function(response, cliente)
        {
            $("#idraz").empty();
            for(i=0; i<response.length; i++)
            {
                $("#idraz").append("<option value='" + response[i].id + "'>" + response[i].razon_social + "|" + response[i].rfc + "</option>");
            }
        });
   });
</script>
<script>
  $("#id_cliente").change(function(event)
    {
      $.get("clientes/razones/usuarios/" + event.target.value + "", function(response, id_cliente)
      {
        $("#id_razon_social").empty();
        //console.log(response);
        for(i=0; i<response.length; i++)
        {
          $("#id_razon_social").append("<option value='" + response[i].id + "'>" + response[i].name + "</option>");
        }
      });
    });
</script>
    $(document).ready(function() {

    $('select[name="id_cliente"]').on('change', function()
    {
        var clienteId = $(this).val();
        if(clienteId) 
        {
            $.ajax({
                url: '/clientes/razones/usuarios/'+clienteId,
                type:"GET",
                dataType:"json",
                beforeSend: function()
                {
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) 
                {

                    $('select[name="id_razon_social"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="id_razon_social"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="id_razon_social"]').empty();
        }

    });

});
</script>-->

@endsection








