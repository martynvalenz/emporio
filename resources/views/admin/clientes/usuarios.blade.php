@extends('admin.app')

@section('title')
<title>Emporio Legal | Contactos de Clientes</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables 
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
    <!-- Datatables -->
    <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">
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
        Usuarios de cliente: {{ $cliente->nombre_comercial }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('clientes.index') }}"><i class="fa fa-user"></i> Clientes</a></li>
        <li class="active">Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="btn-group">
                <a class="btn btn-azul" data-toggle="modal" data-target="#create" data-tooltip="tooltip" title="Agregar registro"><i class="fa fa-plus"></i> Agregar Usuario
                </a>
                @include('admin.clientes.usuarios-crear')
                <a href="btn btn-warning" href="{{ route('clientes.index') }}"><i class="fa fa-arrow-left"></i> Regresar</a>
              </div>
            </div>

            <hr>
            <!-- /.box-header -->
            <div class="box-body">
            @if(count($users) > 0)
              <div clasid="example1" class="table display responsive no-wrap table-bordered table-striped table-hover cell-border" cellspacing="0" width="100%">
                  <thead style="font-size: 15px">
                    <tr>
                      <th>Puesto</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Contraseña</th>
                      <th>Celular</th>
                      <th>Creado</th>
                      <th>Estatus?</th>
                      <th hidden>ID</th>
                      <th colspan ="1">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody style="font-size: 15px" id="list" name="list">
                  @foreach($users as $key => $user)
                    <tr v-for="dato in datos">
                      <td style="width:10%;" valign="left" data-target="#modal-detalles-@{{ dato.id }}" title="Detalles de @{{ dato.nombre }}" data-toggle="modal">@{{ dato.puesto }}</td>
                      <td style="width:15%;" valign="middle" title="Detalles de @{{ dato.nombre }}" data-target="#modal-detalles-@{{ dato.id }}" data-toggle="modal">@{{ dato.nombre }}</td>
                      <td style="width:17%;" valign="middle" title="Detalles de @{{ dato.nombre }}" data-target="#modal-detalles-@{{ dato.id }}" data-toggle="modal">@{{ $user->nombre_comercial }}</td>
                      <td style="width:15%;" valign="middle" title="Detalles de @{{ dato.nombre }}" data-target="#modal-detalles-@{{ dato.id }}" data-toggle="modal">@{{ dato.email }}</td>
                      <td style="width:10%;" valign="middle" title="Detalles de @{{ dato.nombre }}" data-target="#modal-detalles-@{{ dato.id }}" data-toggle="modal">@{{ dato.celular }}</td>
                      <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse(@{{ dato.created_at }})->format('d-m-Y') }}" data-target="#modal-detalles-{{ $user->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse(@{{ dato.created_at }})->diffForHumans() }}</td>
                      <td style="width:5%;" align="center" valign="middle" data-target="#modal-detalles-@{{ dato.nombre }}" data-toggle="modal" data-tooltip="tooltip">@{{ dato.estatus }}</td>
                      <td hidden>{{ $user->id }}</td>
                      <td style="width:8%;" align="center">
                        <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-editar-{{ $user->id }}" data-tooltip="tooltip" title="Editar usuario: @{{ dato.nombre }}">
                          <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a class="btn btn-xs btn-danger" data-target="#modal-activar-{{ $user->id }}" data-toggle="modal" title="Activar" data-tooltip="tooltip">
                          <i class="glyphicon glyphicon-eye-close"></i>
                        </a>
                      </td>
                    </tr>
                    @include('admin.clientes.usuarios-editar')
                    @include('admin.clientes.usuarios-detalles')
                    @include('admin.clientes.usuarios-eliminar')
                  @endforeach
                  </tbody>
                </table>
              </div>
              {{$users->render()}}
            @else
              <h4>No hay registros encontrados, inicie por crear uns registro nuevo.</h4>
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
  <script src="{{ asset('js/axios.js') }}"></script>
  <script src="{{ asset('js/vue.js') }}"></script>

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
  $(document).ready(function() 
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
    
  });
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
<script>
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

new Vue(
{
  el: '#crud',
  created: function()
  {
    this.get();
  },

  data: 
  {
    datos: [], 
    nPuesto: '',
    nTitulo: '',
    nArea: '',
    nNombre: '',
    nEmail: '',
    nPassword: '',
    nTelefono: '',
    nCelular: '',
    nOficina: '',
    nEstatus: '',
    nId_cliente: '',
    fillKeep: {'id': '', 'puesto': '', 'titulo':'', 'area': '', 'nombre':'', 'email':'', 'email':'', 'password':'', 'telefono':'', 'celular':'', 'oficina':'', 'estatus':'', 'id_cliente':'',},
    errors: []
  },

  methods:
  {
    get: function()
    {
      var urlDatos = '/admin/clientes/cliente/usuarios/' + id;
      axios.get(urlDatos).then(response =>
      {
        this.datos = response.data
      });
    }, 

    delete: function(keep)
    {
      var url = '/admin/clientes/cliente/usuarios/' + dato.id;
      axios.delete(url).then(response => //eliminamos
      {
        this.getKeeps(); //Listamos
        toastr.success('Eliminado correctamente'); //mensaje
      });
    },

    create: function()
    {
      var url = 'tasks';
      axios.post(url,
      {
        task: this.newTask,
        descripcion: this.newDesc,
        monto: this.newMonto

      }).then(response =>
      {
        this.getKeeps();
        this.newTask = '';
        this.newDesc = '';
        this.newMonto = '';
        this.errors = [];
        $('#create').modal('hide');
        toastr.success('Nueva tarea creada con éxito');
      }).catch(error =>
      {
        this.errors = error.response.data
      });
    },

    edit: function(keep)
    {
      this.fillKeep.id = keep.id;
      this.fillKeep.task = keep.task;
      this.fillKeep.descripcion = keep.descripcion;
      this.fillKeep.monto = keep.monto;
      $('#edit').modal('show');
    },

    update: function(id)
    {
      var url = 'tasks/' + id;
      axios.put(url, this.fillKeep).then(response =>
        {
          this.getKeeps();
          this.fillKeep = {'id': '', 'task': '', 'descripcion':'', 'monto': ''};
          this.errors = [];
          $('#edit').modal('hide');
          toastr.success('Tarea actualizada exitosamente');

        }).catch(error =>
        {
          this.errors = error.response.data
        });
    }
  }
});
</script>
@endsection