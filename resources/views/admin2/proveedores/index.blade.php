@extends('admin.app')

@section('title')
<title>Emporio Legal | Proveedores</title>
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
        Catálogo de Proveedores
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Proveedores</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <div class="btn-group">
                  <a class="btn btn-azul" data-target="#agregar" data-toggle="modal" data-tooltip="tooltip" title="Agregar un nuevo Proveedor"><i class="fa fa-user-plus"></i> Agregar Proveedor
                  </a>
                  @include('admin.proveedores.create')
                </div>
              </div>

              <hr>

              <div class="container">
                <div class="row">
                  <div class="col-lg-6 div col-md-6 col-sm-12 col-xs-12">
                    {!! Form::open(array('url'=>'admin/proveedores','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}" title="Buscar proveedor por Nombre Comercial, Razon Social, RFC, datos de facturación, contacto, etc...">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                          <a href="{{ route('proveedores.index') }}" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                        </span>
                      </div>
                    </div>

                    {{Form::close()}}
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
              @if(count($proveedores) > 0)
                <div class="table-responsive">
                  <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                    <thead style="font-size: 15px">
                      <tr>
                        <th>Num</th>
                        <th>Proveedor</th>
                        <th>Egresos</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Agregó</th>
                        <th>Agregado</th>
                        <th>Estatus?</th>
                        <th colspan ="1">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 15px" id="list" name="list">
                    @foreach($proveedores as $key => $prov)
                      <tr id="prov{{ $prov->id }}">
                        <td style="width:10%;" valign="left" title="Detalles" data-target="#modal-detalles-prov-{{ $prov->id }}" data-toggle="modal">PROV-{{ $prov->id }}</td>
                        <td style="width:20%;" valign="middle" data-target="#modal-detalles-prov-{{ $prov->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $prov->razon_social }} {{ $prov->rfc }}">{{ $prov->nombre_comercial }}</td>
                        <td style="width:12%;" align="right" data-target="#modal-detalles-prov-{{ $prov->id }}" data-toggle="modal">{{ number_format($prov->retiros, 2) }}</td>
                        <td style="width:12%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-prov-{{ $prov->id }}" data-toggle="modal">{{ $prov->telefono }}</td>
                        <td style="width:16%;" align="left" valign="middle"  data-tooltip="tooltip" title="enviar correo a {{ $prov->contacto }}: {{ $prov->correo }}"><a href="mailto: {{ $prov->correo }}">{{ $prov->correo }}</a></td>
                        <td style="width:5%;" align="center" valign="middle" data-target="#modal-detalles-prov-{{ $prov->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $prov->nombre }} {{ $prov->apellido }}">{{ $prov->iniciales }}</td>
                        <td style="width:10%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-prov-{{ $prov->id }}" data-toggle="modal">{{ Carbon\Carbon::parse($prov->created_at)->format('d/m/Y') }}</td>
                        <td style="width:5%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-prov-{{ $prov->id }}" data-toggle="modal">
                          @if($prov->estatus == 1)
                            <label class="label label-success">Activo</label>
                          @elseif($prov->estatus == 0)
                            <label class="label label-danger">Inactivo</label>
                          @endif
                        </td>
                        <td style="width:10%;" align="center">
                          <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-editar-prov-{{ $prov->id }}" data-tooltip="tooltip" title="Editar prov: {{ $prov->nombre_comercial }}">
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          @if($prov->estatus == 1)
                            <a class="btn btn-xs btn-danger" data-target="#modal-inactivar-prov-{{ $prov->id }}" data-toggle="modal" title="Inactivar {{ $prov->nombre_comercial }}" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-eye-close"></i>
                            </a>  
                          @else
                            <a class="btn btn-xs btn-success" data-target="#modal-activar-prov-{{ $prov->id }}" data-toggle="modal" title="Activar {{ $prov->nombre_comercial }}" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                          @endif
                        </td>
                      </tr>
                      @include('admin.proveedores.edit')
                      @include('admin.proveedores.activar')
                      @include('admin.proveedores.inactivar')
                      @include('admin.proveedores.detalles')
                    @endforeach
                    </tbody>
                  </table>
                </div>
              {{$proveedores->render()}}
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
    $('#liEgresos').addClass("treeview active");
    $('#subProveedores').addClass("active");
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