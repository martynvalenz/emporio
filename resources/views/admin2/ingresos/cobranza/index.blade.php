
@extends('admin.app')

@section('title')
<title>Emporio Legal | Cobranza</title>
@endsection

@section('styles')
    <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('admin/css/toastr.css') }}">
  <!-- Datatables 
  <link href="{{ asset('admin/dataTable Bootstrap/datatables.css') }}" rel="stylesheet">-->
    <link rel="stylesheet" href="{{ asset('admin/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/iCheck/square/blue.css') }}">
    <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
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
        Cobranza
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.emporio') }}"><i class="fas fa-home"></i> Home</a></li>
        <li class="active">Cobranza</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div id="crud" class="row">
        <div class="col-xs-12">
          <div class="box">
              <div class="box-header">
                <div class="btn-group">
                  <a class="btn btn-azul" data-target="#agregar" data-toggle="modal" data-tooltip="tooltip" title="Agregar un nuevo Egreso"><i class="fa fa-plus"></i> Agregar Ingreso
                  </a>
                  @include('admin.ingresos.cobranza.create')
                </div>
              </div>

              <hr>

              <div class="container">
                <div class="row">
                  <div class="col-lg-6 div col-md-6 col-sm-12 col-xs-12">
                    {!! Form::open(array('url'=>'admin/cobranza','method'=>'GET','autocomplete'=>'on','role'=>'search')) !!}
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}" title="Buscar Ingreso por Nombre Comercial del Cliente, usuario, cuenta, etc...">
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-default" data-tooltip="tooltip" title="Dar clic para iniciar búsqueda..."><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                          <a href="{{ route('cobranza.index') }}" class="btn btn-danger" data-tooltip="tooltip" title="Limpiar búsqueda"><i class="fas fa-eraser" aria-hidden="true"></i> Borrar</a>
                        </span>
                      </div>
                    </div>

                    {{Form::close()}}
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                {{$ingresos->render()}}
              @if(count($ingresos) > 0)
                <div class="table-responsive">
                  <table id="example1" class="table table-striped table-bordered table-condensed table-hover display table-responsive no-wrap cell-border" cellspacing="0" width="100%">
                    <thead style="font-size: 15px">
                      <tr>
                        <th hidden>ID</th>                     
                        <th>Cliente</th>
                        <th>Cuenta</th>
                        <th>Forma de Pago</th>
                        <th>Movimiento</th>
                        <th>Cheque</th>
                        <th>Total</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Estatus?</th>
                        <th colspan ="1">&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody style="font-size: 15px" id="list" name="list">
                    @foreach($ingresos as $key => $ingreso)
                      <tr id="ingreso{{ $ingreso->id }}">
                        <td hidden>{{ $ingreso->id }}</td>
                        <td style="width:19%;" valign="middle" align="left" title="{{ $ingreso->razon_social }} | {{ $ingreso->rfc }}" data-tooltip="tooltip" data-target="#detalles-{{ $ingreso->id }}" data-toggle="modal">
                          @if($ingreso->id_cliente == '')
                            <label class="label label-warning">Ingreso no Identificado</label>
                          @else
                            {{ $ingreso->nombre_comercial }}
                          @endif
                        </td>
                        <td style="width:10%;" align="left" valign="middle" title="{{ $ingreso->banco }}" data-tooltip="tooltip" data-target="#detalles-{{ $ingreso->id }}" data-toggle="modal">{{ $ingreso->alias }}</td>
                        <td style="width:10%;" align="center" valign="middle"  data-tooltip="tooltip" title="{{ $ingreso->forma_pago }}" data-target="#detalles-{{ $ingreso->id }}" data-toggle="modal">{{ $ingreso->codigo }}</td>
                        <td style="width:6%;" align="center" valign="middle" data-target="#detalles-{{ $ingreso->id }}" data-toggle="modal">{{ $ingreso->movimiento }}</td>
                        <td style="width:6%;" align="center" valign="middle" data-target="#detalles-{{ $ingreso->id }}" data-toggle="modal">{{ $ingreso->cheque }}</td>
                        <td style="width:10%;" align="right" valign="middle" data-tooltip="tooltip" title="Subtotal: {{ number_format($ingreso->subtotal,2) }} | IVA: {{ number_format($ingreso->iva,2) }}" data-target="#detalles-{{ $ingreso->id }}" data-toggle="modal">{{ number_format($ingreso->total,2) }}</td>
                        <td style="width:6%;" align="center" valign="middle" data-tooltip="tooltip" title="{{ $ingreso->nombre }} {{ $ingreso->apellido }}" data-target="#detalles-{{ $ingreso->id }}" data-toggle="modal">{{ $ingreso->iniciales }}</td>
                        <td style="width:10%;" align="center" valign="middle" title="Agregado {{ Carbon\Carbon::parse($ingreso->created_at)->diffForHumans() }}" data-tooltip="tooltip" data-target="#detalles-{{ $ingreso->id }}" data-toggle="modal">{{ Carbon\Carbon::parse($ingreso->fecha)->format('d/m/Y') }}</td>
                        <td style="width:8%;" align="center" valign="middle" title="Detalles" data-target="#detalles-{{ $ingreso->id }}" data-toggle="modal">
                          @if($ingreso->estatus == 'Pagado')
                            <label class="label label-success">Pagado</label>
                          @elseif($ingreso->estatus == 'Cancelado')
                            <label class="label label-danger" data-tooltip="tooltip" title="{{ Carbon\Carbon::parse($ingreso->cancelado_at)->diffForHumans() }} | {{ Carbon\Carbon::parse($ingreso->cancelado_at)->format('d/m/Y') }}">Cancelado</label>
                          @elseif($ingreso->estatus == 'Pendiente')
                            <label class="label label-warning">Pendiente</label>
                          @endif
                        </td>
                        <td style="width:15%;" align="center">
                          <a class="btn btn-xs btn-info" data-tooltip="tooltip" title="Ver facturas y/o recibos pagados: {{ $ingreso->detalles }}">
                            <i class="fa fa-list"></i>
                            @if($ingreso->detalles == 0)
                              <span class="label label-danger">{{ $ingreso->detalles }}</span>
                            @else
                              <span class="label label-default">{{ $ingreso->detalles }}</span>
                            @endif
                          </a>
                          <a class="btn btn-xs btn-warning" href="{{ route('cobranza.edit', $ingreso->id) }}"  data-tooltip="tooltip" title="Editar ingreso: {{ $ingreso->concepto }}">
                            <i class="glyphicon glyphicon-edit"></i>
                          </a>
                          <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-pendiente-{{ $ingreso->id }}" data-tooltip="tooltip" title="Pasar ingreso a estatus de 'Pendiente' de pago">
                            <i class="glyphicon glyphicon-minus"></i>
                          </a>
                          @if($ingreso->estatus == 'Pagado' || $ingreso->estatus == 'Pendiente')
                            <a class="btn btn-xs btn-danger" data-target="#modal-cancelar-{{ $ingreso->id }}" data-toggle="modal" title="Cancelar ingreso {{ $ingreso->concepto }}" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-remove"></i>
                            </a>  
                          @else
                            <a class="btn btn-xs btn-success" data-target="#modal-activar-{{ $ingreso->id }}" data-toggle="modal" title="Activar ingreso" data-tooltip="tooltip">
                              <i class="glyphicon glyphicon-ok"></i>
                            </a>
                          @endif
                        </td>
                      </tr>
                      @include('admin.ingresos.cobranza.activar')
                      @include('admin.ingresos.cobranza.cancelar')
                      @include('admin.ingresos.cobranza.detalles')
                    @endforeach
                    </tbody>
                  </table>
                </div>
              {{$ingresos->render()}}
              @else
                <h4>No hay registros encontrados, inicie por crear uno nuevo.</h4>
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
  <!-- bootstrap datepicker -->
  <script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('admin/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>

  <script>
    $(document).ready(function() {
        $('body').tooltip({
            selector: "[data-tooltip=tooltip]",
            container: "body"
        });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() 
    {
      $(".fancybox").fancybox();
    });
  </script>
  <script>
    $(document).ready(function() {
      $(".various").fancybox({
        maxWidth  : 1280,
        maxHeight : 1000,
        fitToView : true,
        width   : '100%',
        height    : '100%',
        autoSize  : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none'
      });
    });
  </script>
  <script>
    $('#liFacturas').addClass("treeview active");
    $('#subCobranza').addClass("active");
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
  //Date picker
  $('.datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
    //format: 'dd-mm-yyyy'
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
      $.get('/admin/facturas/razones/' + id_cliente, function(data)
      {
          //console.log(data);

              $('#id_razon_social').empty();

          $.each(data, function(index, subcatObj)
          {

              $('#id_razon_social').append('<option value ="'+ subcatObj.id +'">'+subcatObj.razon_social+' | '+ subcatObj.rfc +'</option>');

          });
      });
  });
</script>
<script>
  $(document).ready(function()
  {
    $("#btn_agregar_razon").on('click', function()
      {
        var id_cliente_razon="";

        id_cliente_razon = $('select[name=id_cliente]').val();

        if(id_cliente_razon == '')
        {
          id_cliente_razon = $('input[name=id_cliente]').val();
        }

        $("#id_cliente_razon").val(id_cliente_razon);
        id_cliente_razon = '';

      });

    $("#btn_razon").on('click', function(e)
    {
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

      e.preventDefault(); 

      id_cliente_razon = $("#id_cliente_razon").val();

      if(id_cliente_razon == '')
      {
        toastr.error('No hay cliente seleccionado, cierre la ventana y seleccione un cliente para poder asignarle una razón social.');
      }
      else
      {
        razon = $("#razon_social_razon").val();
        rfc = $("#rfc_razon").val();
        

        if(razon == '')
        {
          toastr.error('Anote una razón social');
        }
        else if (rfc == '')
        {
          toastr.error('Anote un RFC.');
        }
        else
        {
          Agregar();
        }
      }
    });
  });

  function Agregar()
  {
    var formData = 
    {
      '_token': $('input[name=_token]').val(),
      razon_social: $('input[name=razon_social_razon]').val(),
      rfc: $('input[name=rfc_razon]').val(),
      id_admin: $('input[name=id_admin_razon]').val(),
      id_cliente: $('input[name=id_cliente_razon]').val(),
      estatus: $('input[name=estatus_razon]').val()
    }    

    $.ajax(
    {
        type: 'POST',
        dataType: 'json',
        url: '/admin/clientes/insertar-razon',
        data: formData,
        success: function(data) 
        {
          toastr.success('Se insertó de forma correcta la razón social.'); 

          id_cliente = $("#id_cliente_razon").val();      

          //ajax
          $.get('/admin/facturas/razones/' + id_cliente, function(data)
          {
              console.log(data);

                  $('#id_razon_social').empty();

              $.each(data, function(index, razObj)
              {

                  $('#id_razon_social').append('<option value ="'+ razObj.id +'">'+razObj.razon_social+' | '+ razObj.rfc +'</option>');

              });
          });

          var nada='';
          $('#razon_social_razon').val(nada);
          $('#rfc_razon').val(nada);

          $('#agregar_razon').modal('toggle'); 


          
        },
        error: function (data) 
        {
            console.log('Error:', data);
        }
    });
  }
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