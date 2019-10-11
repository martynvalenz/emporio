
@extends('admin.app')

@section('title')
<title>Emporio Legal | Egresos</title>
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
        Egresos de Emporio Legal
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Egresos de Emprio Legal</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <div class="btn-group">
                  <a class="btn btn-azul" data-target="#agregar" data-toggle="modal" data-tooltip="tooltip" title="Agregar un nuevo Egreso"><i class="fa fa-plus"></i> Agregar Egreso
                  </a>
                  @include('admin.egresos.egresos.create')
                  <a class="btn btn-info" data-target="#agregar-categoria" data-toggle="modal" data-tooltip="tooltip" title="Agregar una categoría de egresos"><i class="fa fa-plus"></i> Agregar Categoría
                  </a>
                  @include('admin.egresos.egresos.categoria')
                </div>
              </div>

              <hr>

              <div class="container">
                <div class="row">
                  <div class="col-lg-6 div col-md-6 col-sm-12 col-xs-12">
                    {!! Form::open(array('url'=>'admin/egresos','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}" title="Buscar egreso por Nombre Comercial del Proveedor, tipo de egreso, categoría, usuario, cuenta, etc...">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                          <a href="{{ route('egresos.index') }}" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                        </span>
                      </div>
                    </div>

                    {{Form::close()}}
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                {{$egresos->render()}}
              @if(count($egresos) > 0)
                <div class="table-responsive">
                  <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                    <thead style="font-size: 15px">
                      <tr>
                        <th hidden>ID</th>
                        <th>Categoría</th>                        
                        <th>Proveedor</th>
                        <th>Cuenta</th>
                        <th>Factura?</th>
                        <th>Forma de Pago</th>
                        <th>Total</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Estatus?</th>
                        <th colspan ="1">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 15px" id="list" name="list">
                    @foreach($egresos as $key => $egreso)
                      <tr id="egreso{{ $egreso->id }}">
                        <td hidden>{{ $egreso->id }}</td>
                        <td style="width:15%;" valign="middle" align="left" title="{{ $egreso->concepto }}" data-tooltip="tooltip" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ $egreso->categoria }}</td>
                        <td style="width:17%;" valign="middle" align="left" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $egreso->razon_social }} |§ {{ $egreso->rfc }}">{{ $egreso->nombre_comercial }}</td>
                        <td style="width:10%;" align="left" valign="middle" title="{{ $egreso->banco }}" data-tooltip="tooltip" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ $egreso->alias }}</td>
                        <td style="width:5%;" valign="middle" align="center" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
                          @if($egreso->con_iva == 1)
                            <label for="con_iva" class="label label-success">SI</label>
                          @else
                            <label for="con_iva" class="label label-warning">NO</label>
                          @endif
                        </td>
                        <td style="width:10%;" align="center" valign="middle"  data-tooltip="tooltip" title="{{ $egreso->forma_pago }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ $egreso->codigo }}</td>
                        <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($egreso->subtotal,2) }} | IVA: {{ number_format($egreso->iva,2) }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">{{ number_format($egreso->total,2) }}</td>
                        <td style="width:5%;" align="center" valign="middle" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip" title="{{ $egreso->nombre }} {{ $egreso->apellido }}">{{ $egreso->iniciales }}</td>
                        <td style="width:10%;" align="center" valign="middle" title="{{ Carbon\Carbon::parse($egreso->fecha)->diffForHumans() }}" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal" data-tooltip="tooltip">{{ Carbon\Carbon::parse($egreso->fecha)->format('d/m/Y') }}</td>
                        <td style="width:8%;" align="center" valign="middle" title="Detalles" data-target="#modal-detalles-egreso-{{ $egreso->id }}" data-toggle="modal">
                          @if($egreso->estatus == 'Pagado')
                            <label class="label label-success">Pagado</label>
                          @elseif($egreso->estatus == 'Cancelado')
                            <label class="label label-danger" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($egreso->cancelado_at)->diffForHumans() }} | {{ Carbon\Carbon::parse($egreso->cancelado_at)->format('d/m/Y') }}">Cancelado</label>
                          @elseif($egreso->estatus == 'Pendiente')
                            <label class="label label-warning">Pendiente</label>
                          @endif
                        </td>
                        <td style="width:10%;" align="center">
                          <a class="btn btn-xs btn-info" href="{{ route('egresos.edit', $egreso->id) }}"  data-tooltip="tooltip" title="Editar egreso: {{ $egreso->concepto }}">
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-pendiente-{{ $egreso->id }}" data-tooltip="tooltip" title="Pasar egreso a estatus de 'Pendiente' de pago">
                            <i class="glyphicon glyphicon-minus"></i>
                          </a>
                          @if($egreso->estatus == 'Pagado' || $egreso->estatus == 'Pendiente')
                            <a class="btn btn-xs btn-danger" data-target="#modal-cancelar-{{ $egreso->id }}" data-toggle="modal" title="Cancelar egreso {{ $egreso->concepto }}" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-remove"></i>
                            </a>  
                          @else
                            <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $egreso->id }}" data-toggle="modal" title="Activar egreso" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-ok"></i>
                            </a>
                          @endif
                        </td>
                      </tr>
                      @include('admin.egresos.egresos.activar')
                      @include('admin.egresos.egresos.cancelar')
                      @include('admin.egresos.egresos.pendiente')
                      @include('admin.egresos.egresos.detalles')
                    @endforeach
                    </tbody>
                  </table>
                </div>
              {{$egresos->render()}}
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
    $('#subDespacho').addClass("active");
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
  $.ajaxSetup(
  {
     headers: 
     {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
  });
  $('#id_cliente').on('change', function(e)
  {
      console.log(e);

      var id_cliente = e.target.value;

      //ajax
      $.get('/admin/egresos/servicios/' + id_cliente, function(data)
      {
          console.log(data);

              $('#id_servicio').empty();
              $('#id_servicio').append('<option value ="">--Sin selección--</option>');

          $.each(data, function(index, subcatObj)
          {

              $('#id_servicio').append('<option value ="'+ subcatObj.id +'">'+subcatObj.clave+' '+subcatObj.servicio+' '+subcatObj.tramite+' '+subcatObj.clase+'</option>');

          });
      });
  });
</script>
<script>
  $.ajaxSetup(
  {
     headers: 
     {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
  });

  $('#id_cliente_edit').each('change', function(e)
  {
      console.log(e);

      var id_cliente_edit = e.target.value;

      //ajax
      $.get('/admin/egresos/servicios-edit/' + id_cliente_edit, function(data)
      {
          console.log(data);

              $('#id_servicio_edit').empty();
              $('#id_servicio_edit').append('<option value ="">-Sin selección-</option>');

          $.each(data, function(index, subcatObj)
          {

              $('#id_servicio_edit').append('<option value ="'+ subcatObj.id +'">'+subcatObj.clave+' '+subcatObj.servicio+' '+subcatObj.tramite+' '+subcatObj.clase+'</option>');

          });
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